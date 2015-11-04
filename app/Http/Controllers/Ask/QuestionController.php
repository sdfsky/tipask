<?php

namespace App\Http\Controllers\Ask;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jenssegers\Date\Date;

class QuestionController extends Controller
{

    /*问题创建校验*/
    protected $validateRules = [
        'title' => 'required|max:255',
        'description' => 'sometimes|max:65535',
    ];

    /**
     * 问题详情查看
     */
    public function detail($id)
    {
        $question = Question::find($id);
        if(empty($question)){
            abort(404);
        }


        /*问题查看数+1*/
        $question->increment('views');

        $answers = Answer::where('question_id','=',$id)->paginate(10);

        return view("theme::question.detail")->with('question',$question)->with('answers',$answers);
    }


    /**
     * 问题添加页面显示
     */
    public function create(){

        return view("theme::question.create");

    }


    /*创建提问*/
    public function store(Request $request){
        $login_user = $request->user();
        $request->flash();
        $this->validate($request,$this->validateRules);
        $data = [
            'user_id'      => $login_user->id,
            'title'        => $request->input('title'),
            'description'  => $request->input('description'),
        ];
        Question::create($data);
        return redirect(route('website.index'));

    }

}
