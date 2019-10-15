<?php

namespace App\Http\Controllers\Admin;

use App\Models\FriendshipLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Requests;

class FriendshipLinkController extends AdminController
{
    /*权限验证规则*/
    protected $validateRules = [
        'name' => 'required|max:128',
        'url' => 'required|url|max:128',
        'slogan' => 'required|max:128',
        'sort' => 'sometimes|integer',
    ];



    /**
     * 显示友情链接列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = FriendshipLink::orderBy('sort','asc')->orderBy('updated_at','desc')->paginate(Config::get('tipask.admin.page_size'));
        return view('admin.friendshipLink.index')->with(compact('links'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.friendshipLink.create');
    }



    /**
     * 保存添加的友情链接信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $this->validate($request,$this->validateRules);
        FriendshipLink::create($request->all());
        return $this->success(route('admin.friendshipLink.index'),'友情链接添加成功');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = FriendshipLink::find($id);
        if(!$link){
            return $this->error(route('admin.friendshipLink.index'),'友情链接不存在，请核实');
        }
        return view('admin.friendshipLink.edit')->with(compact('link'));
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
        $request->flash();
        $link = FriendshipLink::find($id);
        if(!$link){
            return $this->error(route('admin.friendshipLink.index'),'友情链接不存在，请核实');
        }
        $this->validate($request,$this->validateRules);
        $link->update($request->all());
        return $this->success(route('admin.friendshipLink.index'),'友情链接修改成功');
    }

    /**
     * 删除友情链接
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        FriendshipLink::destroy($request->input('ids'));
        return $this->success(route('admin.friendshipLink.index'),'友情链接删除成功');
    }
}
