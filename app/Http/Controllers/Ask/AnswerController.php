<?php

namespace App\Http\Controllers\Ask;

use App\Models\Answer;
use App\Models\Attention;
use App\Models\Question;
use App\Models\QuestionInvitation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{

    /*问题创建校验*/
    protected $validateRules = [
        'content' => 'min:15|max:65535',
    ];


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->user()->status === 0){
            return $this->error(route('website.index'),'操作失败！您的邮箱还未验证，验证后才能进行该操作！');
        }
        
        $question_id = $request->input('question_id');
        $question = Question::find($question_id);

        if(empty($question)){
            abort(404);
        }
        $loginUser = $request->user();
        $request->flash();
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
        $answer = Answer::find($id);

        if(!$answer){
            abort(404);
        }

        if($answer->user_id !== $request->user()->id && !$request->user()->is('admin')){
            abort(403);
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

        if($answer->user_id !== $request->user()->id && !$request->user()->is('admin')){
            abort(403);
        }

        $request->flash();
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

        if(($request->user()->id !== $answer->question->user_id) && !$request->user()->is('admin')  ){
            abort(403);
        }


        DB::beginTransaction();
        try{

            $answer->adopted_at = Carbon::now();
            $answer->save();

            $answer->question->status = 2;
            $answer->question->save();

            $answer->user->userData()->increment('adoptions');

            /*悬赏处理*/
            $this->credit($answer->user_id,'answer_adopted',($answer->question->price+Setting()->get('coins_adopted',0)),Setting()->get('credits_adopted'),$answer->question->id,$answer->question->title);


            DB::commit();

            $this->notify($request->user()->id,$answer->user_id,'adopt_answer',$answer->question_title,$answer->question_id);
            $this->sendEmail($answer->user_id,' ','恭喜！你对于问题['.$answer->question_title.']的回答被采纳了！',$answer);
            return $this->success(route('ask.question.detail',['question_id'=>$answer->question_id]),"回答采纳成功!".get_credit_message(Setting()->get('credits_adopted'),Setting()->get('coins_adopted')));

        }catch (\Exception $e) {
            DB::rollBack();
        }

        return $this->error(route('ask.question.detail',['question_id'=>$answer->question_id]),"回答采纳失败，请稍后再试！");


    }


    /**
     * 回答详情查看
     */
    public function detail($question_id,$id,Request $request)
    {

        $question = Question::find($question_id);

        if(empty($question)){
            abort(404);
        }


        /*问题查看数+1*/
        $question->increment('views');

        $answer = $question->answers()->find($id);

        /*设置通知为已读*/
        if($request->user()){
            $this->readNotifications($answer->id,'answer');
        }

        /*相关问题*/
        $relatedQuestions = Question::correlations($question->tags()->lists('tag_id'));
        return view("theme::answer.detail")->with('question',$question)
            ->with('answer',$answer)
            ->with('relatedQuestions',$relatedQuestions);
    }



}
