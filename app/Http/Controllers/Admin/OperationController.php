<?php

namespace App\Http\Controllers\Admin;

use App\Models\OperationLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OperationController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $filter =  $request->all();
        $query = OperationLog::query();

        /*UID*/
        if( isset($filter['user_id']) &&  $filter['user_id'] > 0 ){
            $query->where('user_id','=',$filter['user_id']);
        }

        /*问题标题过滤*/
        if( isset($filter['word']) && $filter['word'] ){
            $query->where('action','like', '%'.$filter['word'].'%');
        }

        /*提问时间过滤*/
        if( isset($filter['date_range']) && $filter['date_range'] ){
            $query->whereBetween('created_at',explode(" - ",$filter['date_range']));
        }
        $operations = $query->orderBy('created_at','desc')->paginate(10);
        return view("admin.operation.index")->with('operations',$operations)->with('filter',$filter);
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
    public function destroy($id)
    {
        //
    }
}
