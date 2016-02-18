<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class AdminController extends Controller {




    public function __construct(Request $request){



        /*管理员登陆检测*/
      //  $this->middleware('auth.admin');

       // $this->middleware('permission:'.$this->getRouter()->currentRouteName());

        //当前是否开启小菜单
        View::share('sidebar_collapse',Cookie::get('sidebar_collapse'));


    }





}
