<?php

namespace App\Http\Controllers\Ask;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionInvitation;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Date\Date;

class QuestionController extends Controller
{

    /*问题创建校验*/
    protected $validateRules = [
        'title' => 'required|max:255',
        'description' => 'sometimes|max:65535',
        'price'=> 'digits_between:0,1000',
        'tags' => 'sometimes|max:128',
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
            $answers = $question->answers()->whereNull('adopted_at')->orderBy('created_at','DESC')->paginate(5);
        }else{
            $answers = $question->answers()->whereNull('adopted_at')->orderBy('supports','DESC')->orderBy('created_at','ASC')->paginate(5);
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
        return view("theme::question.create")->with('toUser',$toUser)->with('to_user_id',$to_user_id);
    }


    /*创建提问*/
    public function store(Request $request)
    {
        $loginUser = $request->user();
        $request->flash();
        $this->validate($request,$this->validateRules);
        $data = [
            'user_id'      => $loginUser->id,
            'title'        => trim($request->input('title')),
            'description'  => clean($request->input('description')),
            'price'        => $request->input('price'),
            'hide'         => intval($request->input('hide')),
            'status'       => 1,
        ];

        $question = Question::create($data);
        /*判断问题是否添加成功*/
        if($question){


            /*悬赏提问*/
            if($question->price > 0){
                $this->credit($question->user_id,'ask',-$request->input('coins'),$question->id,$question->title);
            }

            /*添加标签*/
            $tagString = trim($request->input('tags'));
            Tag::multiSave($tagString,$question);

            //记录动态
            $this->doing($question->user_id,'ask',get_class($question),$question->id,$question->title,$question->description);


            /*邀请作答逻辑处理*/
            $to_user_id = $request->input('to_user_id',0);
            $toUser = User::find($to_user_id);
            if($toUser){
                if(QuestionInvitation::create(['question_id'=>$question->id,'user_id'=>$to_user_id])){
                    $emailData = [
                            'email' => $toUser['email'],
                            'name' => Setting()->get('website_name'),
                            'action' => 'inviteToAnswer',
                            'question_id' => $question->id,
                            'subject' => '问题求助：'.$question->title
                        ];
                    Mail::queue('emails.'.$emailData['action'], $emailData, function($message) use ($emailData)
                    {
                        $message->to($emailData['email'],$emailData['name'])->subject($emailData['subject']);
                    });

                }
            }


            /*用户提问数+1*/
            $loginUser->userData()->increment('questions');
            if($question->status ==1 && $this->credit($request->user()->id,'ask',Setting()->get('coins_ask'),Setting()->get('credits_ask'),$question->id,$question->title)){
                $message = '发起提问成功! 经验 '.integer_string(Setting()->get('credits_ask')) .' , 金币 '.integer_string(Setting()->get('coins_ask'));
                return $this->success(route('ask.question.detail',['question_id'=>$question->id]),$message);
            }



        }

       return  $this->error("问题创建失败，请稍后再试",route('website.index'));

    }


    /*显示问题编辑页面*/
    public function edit($id,Request $request)
    {
        $question = Question::find($id);

        if(!$question){
            abort(404);
        }

        if($question->user_id !== $request->user()->id){
            abort(401);
        }

        return view("theme::question.edit")->with('question',$question);
    }


    /*问题内容编辑*/
    public function update(Request $request)
    {
        $question_id = $request->input('id');
        $question = Question::find($question_id);
        if(!$question){
            abort(404);
        }

        if($question->user_id !== $request->user()->id){
            abort(401);
        }
        $request->flash();
        $this->validate($request,$this->validateRules);

        $question->title = trim($request->input('title'));
        $question->description = clean($request->input('description'));
        $question->hide = intval($request->input('hide'));

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
            $this->credit($question->user_id,'append_reward',-$request->input('coins'),$question->id,$question->title);
            $question->increment('price',$request->input('coins'));

            DB::commit();
            $this->doing($question->user_id,'append_reward',get_class($question),$question->id,$question->title,"追加了 ".$request->input('coins')." 个金币");
            return $this->success(route('ask.question.detail',['question_id'=>$id]),"追加悬赏成功");

        }catch (\Exception $e) {
            DB::rollBack();
            return $this->error(route('ask.question.detail',['question_id'=>$id]),"追加悬赏失败，请稍后再试");
        }

    }

}
