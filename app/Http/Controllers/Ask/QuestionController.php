<?php

namespace App\Http\Controllers\Ask;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Jenssegers\Date\Date;

class QuestionController extends Controller
{

    /*问题创建校验*/
    protected $validateRules = [
        'title' => 'required|max:255',
        'description' => 'sometimes|max:65535',
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

        $question->user = User::findFromCache($question['user_id']);

        /*问题查看数+1*/
        $question->increment('views');



        if($request->input('sort','default') == 'created_at'){
            $answers = $question->answers()->orderBy('created_at','DESC')->paginate(5);
        }else{
            $answers = $question->answers()->orderBy('supports','DESC')->orderBy('created_at','ASC')->paginate(5);
        }




        $answers->map(function($answer){
            $answer->user = User::findFromCache($answer['user_id']);
        });

        /*设置通知为已读*/
        $this->readNotifications($question->id,'question');

        /*相关问题*/
        $relatedQuestions = Question::correlations($question->tags()->lists('tag_id'));
        return view("theme::question.detail")->with('question',$question)
                                             ->with('answers',$answers)
                                             ->with('relatedQuestions',$relatedQuestions);
    }


    /**
     * 问题添加页面显示
     */
    public function create()
    {
        return view("theme::question.create");
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
            'description'  => $request->input('description'),
            'hide'         => intval($request->input('hide')),
            'status'       => 1,
        ];


        $question = Question::create($data);
        /*判断问题是否添加成功*/
        if($question){

            /*添加标签*/
            $tagString = trim($request->input('tags'));
            Tag::multiSave($tagString,$question);

            //记录动态
            $this->doing($question->user_id,'ask',$question->id,$question->title,$question->description);

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
    public function edit($id)
    {
        $question = Question::find($id);

        if(!$question){
            abort(404);
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

        $request->flash();
        $this->validate($request,$this->validateRules);

        $question->title = trim($request->input('title'));
        $question->description = $request->input('description');
        $question->hide = intval($request->input('hide'));

        $question->save();
        $tagString = trim($request->input('tags'));

        /*更新标签*/
        Tag::multiSave($tagString,$question);

        return $this->success(route('ask.question.detail',['question_id'=>$question->id]),"问题编辑成功");


    }

}
