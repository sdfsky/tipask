<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doing;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Artisan;

class DynamicController extends AdminController
{
    /**
     * 分类列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doings = Doing::orderBy('created_at','desc')->paginate(config('tipask.admin.page_size'));
        return view("admin.dynamic.index")->with(compact('doings'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Doing::destroy($request->input('ids'));
        Artisan::call('cache:clear');
        return $this->success(route('admin.dynamic.index'),'动态删除成功');
    }
}
