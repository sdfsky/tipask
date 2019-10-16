<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2017/2/21
 * Time: 上午11:36
 */

namespace App\Services;


use App\Models\Answer;
use App\Models\Question;
use App\Models\Tag;
use App\Models\UserTag;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionService
{

    /*创建问题*/
    public static function create(array $data){
        $question = Question::create($data);
        if($question){
            /*添加标签*/
            $tagString = trim($data['tags']);
            Tag::multiSave($tagString,$question);
            $question->userData->increment('questions');
            UserTag::multiIncrement($question->user_id,$question->tags()->get(),'questions');
        }
        return $question;
    }

    /*添加回答*/
    public static function addAnswer(array $data){
        $question = Question::find($data['question_id']);
        $answer = Answer::create($data);
        if($answer){

            /*用户回答数+1*/
            $answer->userData->increment('answers');

            /*问题回答数+1*/
            $question->increment('answers');

            UserTag::multiIncrement($answer->user_id,$question->tags()->get(),'answers');
        }

        return $answer;

    }


    /*采纳回答*/
    public static function adoptAnswer($answerId){
        $answer = Answer::find($answerId);
        if(!$answer){
            return false;
        }

        if($answer->adopted_at){
            return false;
        }

        DB::beginTransaction();
        try{

            $answer->adopted_at = Carbon::now();
            $answer->save();

            $answer->question->status = 2;
            $answer->question->save();

            $answer->user->userData->increment('adoptions');

            /*悬赏处理*/
            $percent = Setting()->get('best_answer_percent',100) / 100;
            $earning = ceil($answer->question->price * $percent) + Setting()->get('coins_adopted',0);
            CreditService::create($answer->user_id,'answer_adopted',$earning,Setting()->get('credits_adopted'),$answer->question->id,$answer->question->title);

            UserTag::multiIncrement($answer->user->id,$answer->question->tags()->get(),'adoptions');
            NotificationService::notify($answer->question->user_id,$answer->user_id,'adopt_answer',$answer->question_title,$answer->question_id);
            DB::commit();
            /*发送邮件通知*/
            if($answer->user->allowedEmailNotify('adopt_answer')){
                $emailSubject = '您对于问题「'.$answer->question_title.'」的回答被采纳了！';
                $emailContent = "您对于问题「".$answer->question_title."」的回答被采纳了！<br /> 点击此链接查看详情  →  ".route('ask.question.detail',['question_id'=>$answer->question_id]);
                NotificationService::sendEmail($answer->user->email,$emailSubject,$emailContent);
            }
            return true;
        }catch (\Exception $e) {
            Log::error("adopt_answer_error:".$e->getMessage());
            DB::rollBack();
            return false;
        }




    }

}