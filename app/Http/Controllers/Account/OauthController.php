<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 16/6/27
 * Time: 下午3:04
 */

namespace App\Http\Controllers\Account;


use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function auth($type){
        return Socialite::with($type)->redirect();
    }

}