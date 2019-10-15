<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exchange;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class ExchangeController extends AdminController
{
    /*权限验证规则*/
    protected $validateRules = [
        'real_name' => 'required|max:32',
        'phone' => 'required|regex:/^1[3456789]{1}\d{9}$/',
        'email' => 'required|email|max:64',
        'comment' => 'max:512'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $exchanges = Exchange::orderBy('created_at','desc')->paginate(Config::get('tipask.admin.page_size'));
        return view('admin.exchange.index')->with('exchanges',$exchanges);

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
        $exchange = Exchange::find($id);
        return view("admin.exchange.edit")->with('exchange',$exchange);
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
        $exchange = Exchange::find($id);
        if(!$exchange){
            return $this->error(route('admin.exchange.index'),'记录不存在，请核实');
        }
        $this->validate($request,$this->validateRules);

        $data = $request->all();

        $exchange->update($data);

        return $this->success(route('admin.exchange.index'),'兑换记录修改成功');

    }


    /*修改兑换记录状态*/
    public function changeStatus($id,$status)
    {
        $exchange = Exchange::find($id);
        if(!$exchange){
            return $this->error(route('admin.exchange.index'),'记录不存在，请核实');
        }

        if($status === 'success' && $exchange->status ===0 ){
            $exchange->update(['status'=>1]);
        }else if($status === 'failed' && $exchange->status ===0 ){
            $exchange->update(['status'=>4]);
        }

        return $this->success(route('admin.exchange.index'),'兑换记录状态修改成功');

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
