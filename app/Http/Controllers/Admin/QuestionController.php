<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use Illuminate\Http\Request;

use App\Http\Requests;

class QuestionController extends AdminController
{
    /**
     * 问题列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter =  $request->all();

        $query = Question::query();

        /*提问人过滤*/
        if( isset($filter['user_id']) &&  $filter['user_id'] > 0 ){
            $query->where('user_id','=',$filter['user_id']);
        }

        /*问题标题过滤*/
        if( isset($filter['word']) && $filter['word'] ){
            $query->where('title','like', '%'.$filter['word'].'%');
        }

        /*提问时间过滤*/
        if( isset($filter['date_range']) && $filter['date_range'] ){
            $query->whereBetween('created_at',explode(" - ",$filter['date_range']));
        }

        /*问题状态过滤*/
        if( isset($filter['status']) && $filter['status'] > -1 ){
            $query->where('status','=',$filter['status']);
        }

        $questions = $query->orderBy('created_at','desc')->paginate(20);
        return view("admin.question.index")->with('questions',$questions)->with('filter',$filter);
    }


    /**
     * 显示问题编辑页面
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


    /*问题审核*/
    public function verify(Request $request)
    {
        $questionIds = $request->input('id');
        Question::whereIn('id',$questionIds)->update(['status'=>1]);
        return $this->success(route('admin.question.index').'?status=0','问题审核成功');

    }

    /**
     * 删除问题
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $questionIds = $request->input('id');
        Question::destroy($questionIds);
        return $this->success(route('admin.question.index'),'问题删除成功');
    }
}
