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
    public function detail($id)
    {

        $question = Question::find($id);
        timestamp_format($question->created_at);

        if(empty($question)){
            abort(404);
        }
        $question->user = User::findFromCache($question['user_id']);

        /*问题查看数+1*/
        $question->increment('views');



        $answers = $question->answers()->orderBy('created_at','ASC')->paginate(10);
        $answers->map(function($answer){
            $answer->user = User::findFromCache($answer['user_id']);
        });

        /*相关问题*/
        $relatedQuestions = Question::correlations(Tag::getIds($question->tags()));
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
            'tags'         => trim($request->input('tags')),
            'hide'         => intval($request->input('hide')),
            'status'       => 1,
        ];


        $question = Question::create($data);
        /*判断问题是否添加成功*/
        if($question){

            /*添加标签*/
            if($data['tags']){
                Tag::addAll($data['tags'],$question->id);
            }

            //记录动态
            $this->doing($question->user_id,'ask',$question->id,$question->title,$question->description);

            /*用户提问数+1*/
            $loginUser->userData()->increment('questions');
            if($question->status ==1 && $this->credit($request->user()->id,'ask',Setting()->get('coins_ask'),Setting()->get('credits_ask'),$question->id,$question->title)){
                $message = '发起提问成功! 经验 '.integer_string(Setting()->get('credits_ask')) .' , 金币 '.integer_string(Setting()->get('coins_ask'));
                return $this->success(route('ask.question.detail',['question_id'=>$question->id]),$message);
            }



        }

        return redirect(route('website.index'));

    }

}
