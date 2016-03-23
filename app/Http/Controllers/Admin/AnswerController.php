<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use Illuminate\Http\Request;

use App\Http\Requests;

class AnswerController extends AdminController
{
    /**
     * 回答列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::orderBy('created_at','desc')->paginate(20);
        return view("admin.answer.index")->with('answers',$answers)->with('word','');
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
        //
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
    public function destroy(Request $request)
    {
        Answer::destroy($request->input('id'));
        return $this->success(route('admin.answer.index'),'回答删除成功');
    }
}
