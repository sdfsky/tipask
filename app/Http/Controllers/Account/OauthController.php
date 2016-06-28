<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 16/6/27
 * Time: 下午3:04
 */

namespace App\Http\Controllers\Account;


use App\Http\Controllers\Controller;
use App\Models\UserOauth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function auth($type){
        return Socialite::with($type)->redirect();
    }

    public function callback($type,Request $request){

        $oauthUser = Socialite::driver($type)->user();
        if(Auth()->guest()){//游客登录

        }else{

            $oauthData = [
                'auth_type' => $type ,
                'access_token' => $oauthUser->accessTokenResponseBody['access_token'],
                'refresh_token' => $oauthUser->accessTokenResponseBody['refresh_token'],
                'expires_in' => $oauthUser->accessTokenResponseBody['expires_in'],
                'user_id' => $request->user()->id
            ];

            UserOauth::create($oauthData);

            return $this->success( route('auth.profile.oauth') , $type .'绑定成功！');
        }

    }

    public function unbind( $type , Request $request){
        $request->user()->userOauth()->where('auth_type','=',$type)->delete();
        return $this->success( route('auth.profile.oauth') , $type .'已解除绑定！');
    }

}