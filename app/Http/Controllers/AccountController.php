<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 15/4/12
 * Time: 下午5:53
 */

namespace App\Http\Controllers;

class AccountController extends Controller{


    public function login(){
        return view("theme::account.login");
    }

    public function register(){
        return view("theme::account.register");
    }
}