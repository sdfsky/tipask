<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 16/6/27
 * Time: 下午3:04
 */

namespace App\Http\Controllers\Account;


use App\Http\Controllers\Controller;
use App\Models\EmailToken;
use App\Models\UserOauth;
use App\Services\Registrar;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function login($type){
        return Socialite::with($type)->redirect();
    }

    public function callback($type,Request $request){

        $oauthUser = Socialite::driver($type)->user();

        $userOauth = UserOauth::firstOrCreate($oauthUser->id);
        $userOauth->auth_type = $type;
        $userOauth->access_token = $oauthUser->accessTokenResponseBody['access_token'];
        $userOauth->refresh_token = $oauthUser->accessTokenResponseBody['refresh_token'];
        $userOauth->expires_in = $oauthUser->accessTokenResponseBody['expires_in'];

        if(Auth()->guest()){//游客登录
            $userOauth->save();
            return view("theme::account.oauth")->with(compact('oauthUser'));
        }

        $userOauth->user_id =  $request->user()->id;
        $userOauth->save();
        return $this->success( route('auth.profile.oauth') , $type .'绑定成功！');


    }

    public function unbind( $type , Request $request){
        $request->user()->userOauth()->where('auth_type','=',$type)->delete();
        return $this->success( route('auth.profile.oauth') , $type .'已解除绑定！');
    }


    public function register(Request $request,Registrar $registrar){

        $request->flash();
        /*表单数据校验*/
        $this->validate($request, [
            'email' => 'required|email|max:255|unique:users',
            'name' => 'required|min:2|max:100',
        ]);

        $formData = $request->all();
        $formData['password'] = 'oauth';
        $formData['status'] = 0;
        $formData['visit_ip'] = $request->getClientIp();

        $user = $registrar->create($formData);

        if($user){//绑定用户信息
            $userOauth = UserOauth::find($formData['auth_id']);
            $userOauth->user_id = $user->id;
            $userOauth->save();
        }
        $user->attachRole(2); //默认注册为普通用户角色
        $this->auth->login($user);
        $message = '登录成功!';

        if($this->credit($request->user()->id,'register',Setting()->get('coins_register'),Setting()->get('credits_register'))){
            $message .= get_credit_message(Setting()->get('credits_register'),Setting()->get('coins_register'));
        }

        /*发送邮箱验证邮件*/
        $emailToken = EmailToken::create([
            'email' => $user->email,
            'token' => EmailToken::createToken(),
            'action'=> 'register'
        ]);

        $this->sendEmail($user->id,'register','欢迎注册'.Setting()->get('website_name').',请激活您注册的邮箱！',$emailToken,true);

        return $this->success(route('website.index'),$message);

    }

}