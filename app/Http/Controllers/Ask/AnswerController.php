<?php

namespace App\Http\Controllers\Ask;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{

    /*问题创建校验*/
    protected $validateRules = [
        'content' => 'min:15|max:65535',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question_id = $request->input('question_id');
        $question = Question::findOrNew($question_id);

        if(empty($question)){
            abort(404);
        }
        $login_user = $request->user();
        $request->flash();
        $this->validate($request,$this->validateRules);
        $data = [
            'user_id'      => $login_user->id,
            'question_id'      => $question_id,
            'question_title'        => $question->title,
            'content'  => $request->input('content'),
        ];
        Answer::create($data);

        return redirect(route('ask.question.detail',['id'=>$question_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
