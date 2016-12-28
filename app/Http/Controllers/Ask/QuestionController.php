<?php

namespace App\Http\Controllers\Ask;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionInvitation;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserTag;
use App\Models\XsSearch;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    /*问题创建校验*/
    protected $validateRules = [
        'title' => 'required|max:255',
        'description' => 'sometimes|max:65535',
        'price'=> 'sometimes|digits_between:0,100',
        'tags' => 'sometimes|max:128',
        'category_id' => 'sometimes|numeric'
    ];



    /**
     * 问题详情查看
     */
    public function detail($id,Request $request)
    {



        $question = Question::find($id);

        if(empty($question)){
            abort(404);
        }

        /*问题查看数+1*/
        $question->increment('views');

        /*已解决问题*/
        $bestAnswer = [];
        if($question->status === 2 ){
            $bestAnswer = $question->answers()->where('adopted_at','>',0)->first();
        }

        if($request->input('sort','default') === 'created_at'){
            $answers = $question->answers()->whereNull('adopted_at')->orderBy('created_at','DESC')->paginate(10);
        }else{
            $answers = $question->answers()->whereNull('adopted_at')->orderBy('supports','DESC')->orderBy('created_at','ASC')->paginate(10);
        }


        /*设置通知为已读*/
        if($request->user()){
            $this->readNotifications($question->id,'question');
        }

        /*相关问题*/
        $relatedQuestions = Question::correlations($question->tags()->lists('tag_id'));
        return view("theme::question.detail")->with('question',$question)
                                             ->with('answers',$answers)->with('bestAnswer',$bestAnswer)
                                             ->with('relatedQuestions',$relatedQuestions);
    }


    /**
     * 问题添加页面显示
     */
    public function create(Request $request)
    {
        $to_user_id =  $request->query('to_user_id',0);
        $toUser = User::find($to_user_id);
        return view("theme::question.create")->with(compact('toUser','to_user_id'));
    }


    /*创建提问*/
    public function store(Request $request)
    {
        $loginUser = $request->user();
        if($request->user()->status === 0){
            return $this->error(route('website.index'),'操作失败！您的邮箱还未验证，验证后才能进行该操作！');
        }

        /*防灌水检查*/
        if( Setting()->get('question_limit_num') > 0 ){
            $questionCount = $this->counter('question_num_'. $loginUser->id);
            if( $questionCount > Setting()->get('question_limit_num')){
                return $this->showErrorMsg(route('website.index'),'你已超过每小时最大提问数'.Setting()->get('question_limit_num').'，如有疑问请联系管理员!');
            }
        }

        $request->flash();
        /*如果开启验证码则需要输入验证码*/
        if( Setting()->get('code_create_question') ){
            $this->validateRules['captcha'] = 'required|captcha';
        }

        $this->validate($request,$this->validateRules);
        $price = abs($request->input('price'));

        if($price > 0 && $request->user()->userData->coins < $price){
            return $this->error(route('ask.question.create'),'操作失败！您的金币数不足！');
        }

        $data = [
            'user_id'      => $loginUser->id,
            'category_id'      => $request->input('category_id',0),
            'title'        => trim($request->input('title')),
            'description'  => clean($request->input('description')),
            'price'        => $price,
            'hide'         => intval($request->input('hide')),
            'status'       => 1,
        ];

        $question = Question::create($data);
        /*判断问题是否添加成功*/
        if($question){


            /*悬赏提问*/
            if($question->price > 0){
                $this->credit($question->user_id,'ask',-$question->price,0,$question->id,$question->title);
            }

            /*添加标签*/
            $tagString = trim($request->input('tags'));
            Tag::multiSave($tagString,$question);


            //记录动态
            $this->doing($question->user_id,'ask',get_class($question),$question->id,$question->title,$question->description);


            /*邀请作答逻辑处理*/
            $to_user_id = $request->input('to_user_id',0);
            $this->notify($question->user_id,$to_user_id,'invite_answer',$question->title,$question->id);

            $this->invite($question->id,$to_user_id,$request);

            /*用户提问数+1*/
            $loginUser->userData()->increment('questions');
            UserTag::multiIncrement($loginUser->id,$question->tags()->get(),'questions');
            $this->credit($request->user()->id,'ask',Setting()->get('coins_ask'),Setting()->get('credits_ask'),$question->id,$question->title);
            if($question->status == 1 ){
                $message = '发起提问成功! '.get_credit_message(Setting()->get('credits_ask'),Setting()->get('coins_ask'));
            }else{
                $message = '问题发布成功！为了确保问答的质量，我们会对您的提问内容进行审核。请耐心等待......';
            }

            $this->counter( 'question_num_'. $question->user_id , 1 , 3600 );

            return $this->success(route('ask.question.detail',['question_id'=>$question->id]),$message);


        }

       return  $this->error(route('website.index'),"问题创建失败，请稍后再试");

    }


    /*显示问题编辑页面*/
    public function edit($id,Request $request)
    {
        $question = Question::find($id);

        if(!$question){
            abort(404);
        }

        if($question->user_id !== $request->user()->id && !$request->user()->is('admin')){
            abort(403);
        }

        /*编辑问题时效控制*/
        if( !$request->user()->is('admin') && Setting()->get('edit_question_timeout') ){
            if( $question->created_at->diffInMinutes() > Setting()->get('edit_question_timeout') ){
                return $this->showErrorMsg(route('website.index'),'你已超过问题可编辑的最大时长，不能进行编辑了。如有疑问请联系管理员!');
            }

        }

        return view("theme::question.edit")->with(compact('question'));
    }


    /*问题内容编辑*/
    public function update(Request $request)
    {
        $question_id = $request->input('id');
        $question = Question::find($question_id);
        if(!$question){
            abort(404);
        }

        if($question->user_id !== $request->user()->id && !$request->user()->is('admin')){
            abort(403);
        }

        $request->flash();

        /*普通用户修改需要输入验证码*/
        if( Setting()->get('code_create_question') ){
            $this->validateRules['captcha'] = 'required|captcha';
        }

        $this->validate($request,$this->validateRules);
        $question->title = trim($request->input('title'));
        $question->description = clean($request->input('description'));
        $question->hide = intval($request->input('hide'));
        $question->category_id = $request->input('category_id',0);

        $question->save();
        $tagString = trim($request->input('tags'));

        /*更新标签*/
        Tag::multiSave($tagString,$question);

        return $this->success(route('ask.question.detail',['question_id'=>$question->id]),"问题编辑成功");

    }

    /*追加悬赏*/
    public function appendReward($id,Request $request)
    {
        $question = Question::find($id);
        if(!$question){
            abort(404);
        }

        if($question->user_id !== $request->user()->id){
            abort(401);
        }

        $validateRules = [
            'coins' => 'required|digits_between:1,'.$request->user()->userData->coins
        ];

        $this->validate($request,$validateRules);

        DB::beginTransaction();
        try{
            $this->credit($question->user_id,'append_reward',-abs($request->input('coins')),0,$question->id,$question->title);
            $question->increment('price',$request->input('coins'));

            DB::commit();
            $this->doing($question->user_id,'append_reward',get_class($question),$question->id,$question->title,"追加了 ".$request->input('coins')." 个金币");
            return $this->success(route('ask.question.detail',['question_id'=>$id]),"追加悬赏成功");

        }catch (\Exception $e) {
            DB::rollBack();
            return $this->error(route('ask.question.detail',['question_id'=>$id]),"追加悬赏失败，请稍后再试");
        }

    }

    /*问题建议*/
    public function suggest(Request $request){

        $validateRules = [
            'word' => 'required|min:2|max:255',
        ];
        $this->validate($request,$validateRules);

        if( Setting()->get('xunsearch_open',0) != 1 ){
            return response('');
        }
        $word = $request->input('word');

        $xsSearch = XsSearch::getSearch();
        $model =  App::make('App\Models\\Question');
        $docs = $xsSearch->model($model)->addQuery('subject:'.$word)->setLimit(10,0)->search();
        $suggestList = '';
        foreach($docs as $doc){
            $question = Question::find($doc->id);
            if( !$question ){
                continue;
            }
            $suggestList .= '<li>';

            if($question->status === 2){
                $suggestList .= '<span class="label label-success pull-left mr-5">解决</span>';
            }
            $suggestList .= '<a href="'.route('ask.question.detail',['id'=>$doc->id]).'" target="_blank" class="mr-10">'.XsSearch::getSearch()->highlight($doc->subject).'</a>';
            $suggestList .= '<small class="text-muted">'.$question->answers.' 回答</small>';
            $suggestList .= '</li>';
        }
        return response($suggestList);

    }


    /*邀请回答*/
    public function invite($question_id,$to_user_id,Request $request){

        $loginUser = $request->user();

        if($loginUser->id == $to_user_id){
            return $this->ajaxError(50009,'不用邀请自己，您可以直接回答 ：）');
        }

        $question = Question::find($question_id);
        if(!$question){
           return $this->ajaxError(50001,'notFound');
        }

        if( $this->counter('question_invite_num_'.$loginUser->id) > config('tipask.user_invite_limit') ){
            return $this->ajaxError(50007,'超出每天最大邀请次数');
        }


        $toUser = User::find(intval($to_user_id));
        if(!$toUser){
            return $this->ajaxError(50005,'被邀请用户不存在');
        }

        if(!$toUser->allowedEmailNotify('invite_answer')){
            return $this->ajaxError(50006,'邀请人设置为不允许被邀请回答');
        }

        /*是否已邀请，不能重复邀请*/
        if($question->isInvited($toUser->email,$loginUser->id)){
            return $this->ajaxError(50008,'该用户已被邀请，不能重复邀请');
        }

        $invitation = QuestionInvitation::create([
            'from_user_id'=> $loginUser->id,
            'question_id'=> $question->id,
            'user_id'=> $toUser->id,
            'send_to'=> $toUser->email
        ]);

        if($invitation){
            $this->counter('question_invite_num_'.$loginUser->id);
            $subject = $loginUser->name."在「".Setting()->get('website_name')."」向您发起了回答邀请";
            $message = "我在 ".Setting()->get('website_name')." 上遇到了问题「".$question->title."」 → ".route("ask.question.detail",['question_id'=>$question->id])."，希望您能帮我解答 ";
            $this->sendEmail($invitation->send_to,$subject,$message);
            return $this->ajaxSuccess('success');
        }

        return $this->ajaxError(10008,'邀请失败，请稍后再试');
    }


    public function inviteEmail($question_id,Request $request){

        $loginUser = $request->user();

        if( $this->counter('question_invite_num_'.$loginUser->id) > config('tipask.user_invite_limit') ){
            return $this->ajaxError(50007,'超出每天最大邀请次数');
        }

        $question = Question::find($question_id);
        if(!$question){
            return $this->ajaxError(50001,'question not fund');
        }

        $validator = Validator::make($request->all(), [
            'sendTo' =>  'required|email|max:255',
            'message' =>'required|min:10|max:10000',
        ]);

        if($validator->fails()){
            $this->ajaxError(50011,'字段校验失败');
        }

        $loginUser = $request->user();
        $email    = $request->input('sendTo');
        $content = $request->input('message');
        /*是否已邀请，不能重复邀请*/
        if($question->isInvited($email,$loginUser->id)){
            return $this->ajaxError(50008,'该用户已被邀请，不能重复邀请');
        }

        $invitation = QuestionInvitation::create([
            'from_user_id'=> $loginUser->id,
            'question_id'=> $question->id,
            'user_id'=> 0,
            'send_to'=> $email
        ]);

        if($invitation){
            $this->counter('question_invite_num_'.$loginUser->id,1);
            $subject = $loginUser->name."在「".Setting()->get('website_name')."」向您发起了回答邀请";
            $message = $content;
            $this->sendEmail($invitation->send_to,$subject,$message);
            return $this->ajaxSuccess('success');
        }

        return $this->ajaxError(10008,'邀请失败，请稍后再试');
    }

    public function invitations($question_id,$type){
        $question = Question::find($question_id);
        if(!$question){
            return $this->ajaxError(50001,'question not fund');
        }

        $showRows = ($type=='part') ? 3:100;

        $invitations = $question->invitations()->where("user_id",">",0)->orderBy('created_at','desc')->groupBy('user_id')->take($showRows);

        $invitedUsers = [];
        foreach( $invitations->get() as $invitation ){
            if($invitation->user()){
                $invitedUsers[] = '<a target="_blank" href="'.route('auth.space.index',['user_id'=>$invitation->user->id]).'">'.$invitation->user->name.'</a>';
            }
        }

        $invitedHtml = implode(",&nbsp;",$invitedUsers);

        $totalInvitedNum = $invitations->count();
        if( $type == 'part' &&  $totalInvitedNum > $showRows ){
            $invitedHtml .= '等 <a id="showAllInvitedUsers" href="javascript:void(0);">'.$totalInvitedNum.'</a> 人';
        }
        if( $totalInvitedNum > 0 ){
            $invitedHtml .= '&nbsp;已被邀请';
        }

        return response($invitedHtml);

    }



}
