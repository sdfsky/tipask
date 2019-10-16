<?php

namespace App\Http\Controllers\Ask;

use App\Models\Answer;
use App\Models\Attention;
use App\Models\Question;
use App\Models\QuestionInvitation;
use App\Models\UserTag;
use App\Services\CaptchaService;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AnswerController extends Controller
{

    /*问题创建校验*/
    protected $validateRules = [
        'content' => 'required|min:15|max:65535',
    ];


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,CaptchaService $captchaService)
    {
        $loginUser = $request->user();
        if($loginUser->status === 0){
            return $this->error(route('website.index'),'操作失败！您的邮箱还未验证，验证后才能进行该操作！');
        }

        /*防灌水检查*/
        if( Setting()->get('answer_limit_num') > 0 ){
            $questionCount = $this->counter('answer_num_'. $loginUser->id);
            if( $questionCount > Setting()->get('answer_limit_num')){
                return $this->showErrorMsg(route('website.index'),'你已超过每小时回答限制数'.Setting()->get('answer_limit_num').'，请稍后再进行该操作，如有疑问请联系管理员!');
            }
        }


        $question_id = $request->input('question_id');
        $question = Question::find($question_id);

        if(empty($question)){
            abort(404);
        }
        $request->flash();

        /*防止重复回答*/
        if($loginUser->isAnswered($question->id)){
            return $this->showErrorMsg(route('ask.question.detail',['id'=>$question->id]),'您已经回答过该问题了，不能重复回答！');
        }

        /*普通用户修改需要输入验证码*/
        if( Setting()->get('code_create_answer') ){
            $captchaService->setValidateRules('code_create_answer',$this->validateRules);
        }
        $this->validate($request,$this->validateRules);
        $answerContent = clean($request->input('content'));
        $data = [
            'user_id'      => $loginUser->id,
            'question_id'      => $question_id,
            'question_title'        => $question->title,
            'content'  => $answerContent,
            'status'   => 1,
        ];
        $answer = Answer::create($data);
        if($answer){

            /*用户回答数+1*/
            $loginUser->userData()->increment('answers');

            /*问题回答数+1*/
            $question->increment('answers');

            UserTag::multiIncrement($loginUser->id,$question->tags()->get(),'answers');

            /*记录动态*/
            $this->doing($answer->user_id,'answer',get_class($question),$question->id,$question->title,$answer->content);

            /*记录通知*/
            $this->notify($answer->user_id,$question->user_id,'answer',$question->title,$question->id,$answer->content);
            
            /*回答后通知关注问题*/
            if(intval($request->input('followed'))){
                $attention = Attention::where("user_id",'=',$request->user()->id)->where('source_type','=',get_class($question))->where('source_id','=',$question->id)->count();
                if($attention===0){
                    $data = [
                        'user_id'     => $request->user()->id,
                        'source_id'   => $question->id,
                        'source_type' => get_class($question),
                        'subject'  => $question->title,
                    ];
                    Attention::create($data);

                    $question->increment('followers');
                }
            }


            /*修改问题邀请表的回答状态*/
            QuestionInvitation::where('question_id','=',$question->id)->where('user_id','=',$request->user()->id)->update(['status'=>1]);

            $this->counter( 'answer_num_'. $answer->user_id , 1 , 60 );

            /*记录积分*/
            if($answer->status ==1 && $this->credit($request->user()->id,'answer',Setting()->get('coins_answer'),Setting()->get('credits_answer'),$question->id,$question->title)){
                $message = '回答成功! '.get_credit_message(Setting()->get('credits_answer'),Setting()->get('coins_answer'));
                return $this->success(route('ask.question.detail',['question_id'=>$answer->question_id]),$message);
            }
        }

        return redirect(route('ask.question.detail',['id'=>$question_id]));
    }


    public function edit($id,Request $request)
    {
        $answer = Answer::findOrFail($id);

        $this->authorize('update', $answer);

        /*编辑回答时效控制*/
        if(!Gate::allows('updateInTime',$answer)){
            return $this->showErrorMsg(route('ask.question.detail',['id'=>$answer->question_id]),'你已超过回答可编辑的最大时长，不能进行编辑了。如有疑问请联系管理员!');
        }

        return view("theme::question.edit_answer")->with('answer',$answer);
    }


    /*修改问题内容*/
    public function update($id,Request $request)
    {
        $answer = Answer::find($id);
        if(!$answer){
            abort(404);
        }

        $this->authorize('update', $answer);

        $request->flash();
        /*普通用户修改需要输入验证码*/
        if( Setting()->get('code_create_answer') ){
            $this->validateRules['captcha'] = 'required|captcha';
        }

        $this->validate($request,$this->validateRules);

        $answer->content = clean($request->input('content'));
        $answer->status = 1;

        $answer->save();

        return $this->success(route('ask.answer.detail',['question_id'=>$answer->question_id,'id'=>$answer->id]),"回答编辑成功");

    }


    public function adopt($id,Request $request)
    {
        $answer = Answer::find($id);
        if(!$answer){
            abort(404);
        }

        $this->authorize('adopt',$answer);

        $question = $answer->question;
        if(!$question){
            abort(404);
        }
        if( $question->status <= 0 ){
            return $this->error(route('ask.question.detail',['question_id'=>$answer->question_id]),'问题未通过审核，不能采纳答案！');
        }

        /*防止重复采纳*/
        if($answer->adopted_at){
           return $this->error(route('ask.question.detail',['question_id'=>$answer->question_id]),'该回答已被采纳，不能重复采纳');
        }

        $result = QuestionService::adoptAnswer($answer->id);
        /*悬赏处理*/
        $percent = Setting()->get('best_answer_percent',100) / 100;
        $earning = ceil($answer->question->price * $percent) + Setting()->get('coins_adopted',0);
        if($result){
            return $this->success(route('ask.question.detail',['question_id'=>$answer->question_id]),"回答采纳成功!".get_credit_message(Setting()->get('credits_adopted'),$earning));
        }

        return $this->error(route('ask.question.detail',['question_id'=>$answer->question_id]),"回答采纳失败，请稍后再试！");


    }


    /**
     * 回答详情查看
     */
    public function detail($question_id,$id,Request $request)
    {

        $question = Question::findOrFail($question_id);

        /*问题查看数+1*/
        $question->increment('views');

        $answer = $question->answers()->find($id);

        /*设置通知为已读*/
        if($request->user()){
            $this->readNotifications($answer->id,'answer');
        }

        /*相关问题*/
        $relatedQuestions = Question::correlations($question->tags()->pluck('tag_id'));
        return view("theme::answer.detail")->with('question',$question)
            ->with('answer',$answer)
            ->with('relatedQuestions',$relatedQuestions);
    }



}
