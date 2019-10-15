<?php

namespace App\Http\Controllers\Admin;

use App\Models\BanIp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class BanIpController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter =  $request->all();
        $query = BanIp::query();

        /*操作人过滤*/
        if( isset($filter['user_id']) &&  $filter['user_id'] > 0 ){
            $query->where('user_id','=',$filter['user_id']);
        }

        /*关键字过滤*/
        if( isset($filter['word']) && $filter['word'] ){
            $query->where('ip','like', '%'.$filter['word'].'%');
        }

        /*时间过滤*/
        if( isset($filter['date_range']) && $filter['date_range'] ){
            $query->whereBetween('created_at',explode(" - ",$filter['date_range']));
        }

        $ip = $query->orderBy('created_at','desc')->paginate(10);
        return view('admin.banIp.index')->with(compact('filter','ip'));
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
     *
     */
    public function store(Request $request)
    {
        $validate = [
            'ip' => 'required|ip|unique:ban_ips',
        ];
        $validator = Validator::make($request->all(),$validate);
        if($validator->fails()){
            return $this->error(route('admin.banIp.index'),$validator->errors()->first());
        }

        $ip = $request->input('ip');
        $banIp = BanIp::create([
            'ip' => $ip,
            'user_id' => $request->user()->id,
            'created_at' => Carbon::now()
        ]);
        $this->updateIpCache();
        return $this->success(route('admin.banIp.index'),'添加成功！');
    }

    public function updateIpCache()
    {
        Cache::forget('ip_blacklist');
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
        $ids = $request->input('id');
        BanIp::destroy($ids);
        $this->updateIpCache();
        return $this->success(route('admin.banIp.index'),'删除成功');
    }
}
