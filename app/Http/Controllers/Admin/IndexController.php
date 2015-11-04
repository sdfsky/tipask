<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class IndexController extends AdminController
{
    /**
     *显示后台首页
     */
    public function index()
    {
        return view("admin.index.index");
    }


    /*显示或隐藏sidebar*/
    public function sidebar(Request $request){
        Cookie::forget('sidebar_collapse');
        $cookie = Cookie::forever('sidebar_collapse',$request->get('collapse'));
        return response()->json('ok')->withCookie($cookie);
    }


}
