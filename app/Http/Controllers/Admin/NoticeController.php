<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notice;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Mockery\Matcher\Not;

class NoticeController extends AdminController
{

    /*权限验证规则*/
    protected $validateRules = [
        'subject' => 'required|max:255',
        'url' => 'required|max:255',
    ];


    /**
     * 显示公告列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $word = $request->input("word",'');
        $notices = Notice::where('subject','like',"%$word%")->orderBy('updated_at','DESC')->paginate(Config::get('tipask.admin.page_size'));
        return view('admin.notice.index')->with('notices',$notices)->with('word',$word);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notice.create');
    }



    /**
     * 保存添加的公告信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $this->validate($request,$this->validateRules);
        Notice::create($request->all());
        return $this->success(route('admin.notice.index'),'公告添加成功');

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
        $notice = Notice::find($id);
        if(!$notice){
            return $this->error(route('admin.notice.index'),'公告不存在，请核实');
        }
        return view('admin.notice.edit')->with('notice',$notice);
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
        $notice = Notice::find($id);
        if(!$notice){
            return $this->error(route('admin.notice.index'),'公告不存在，请核实');
        }
        $this->validate($request,$this->validateRules);
        $notice->subject = $request->input('subject');
        $notice->url = $request->input('url');
        $notice->status = $request->input('status');
        $notice->save();
        return $this->success(route('admin.notice.index'),'公告修改成功');
    }

    /**
     * 删除公告
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Notice::destroy($request->input('ids'));
        return $this->success(route('admin.notice.index'),'公告删除成功');
    }
}
