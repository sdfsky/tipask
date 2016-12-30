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
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function login($type){
        return Socialite::with($type)->redirect();
    }

    public function callback($type,Request $request,Guard $auth){

        $oauthUser = Socialite::driver($type)->user();

        if(!$oauthUser){
            abort(500);
        }

        $refresh_token = '';
        if(isset($oauthUser->accessTokenResponseBody['refresh_token'])){
            $refresh_token = $oauthUser->accessTokenResponseBody['refresh_token'];
        }

        if( Auth()->check() ){ //用户登录时处理绑定请求
            $request->user()->userOauth()->where("auth_type",'=',$type)->delete();
            UserOauth::where('id','=',$oauthUser->id)->delete();
            $userOauth = UserOauth::create([
                'id'=>$oauthUser->id,
                'auth_type'=>$type,
                'user_id'=> $request->user()->id,
                'nickname'=>$oauthUser->nickname,
                'avatar'=>$oauthUser->avatar,
                'access_token'=>$oauthUser->accessTokenResponseBody['access_token'],
                'refresh_token'=>$refresh_token,
                'expires_in'=>$oauthUser->accessTokenResponseBody['expires_in'],
            ]);

            if($userOauth){
                return $this->success( route('auth.profile.oauth') , $type .'绑定成功！');
            }

            return $this->error(route('auth.profile.oauth'),'绑定失败请稍后重试！');

        }

        //游客登录处理注册流程
         $userOauth = UserOauth::find($oauthUser->id);

        if( $userOauth && $userOauth->user_id > 0 ){
            $auth->loginUsingId($userOauth->user_id);
            if($this->credit($request->user()->id,'login',Setting()->get('coins_login'),Setting()->get('credits_login'))){
                $message = '登陆成功! '.get_credit_message(Setting()->get('credits_login'),Setting()->get('coins_login'));
                return $this->success(route('website.index'),$message);
            }
            /*认证成功后跳转到首页*/
            return redirect()->to(route('website.index'));
        }

        UserOauth::where('id','=',$oauthUser->id)->delete();

        $oauthData = UserOauth::create([
            'id'=>$oauthUser->id,
            'auth_type'=>$type,
            'user_id'=> 0,
            'nickname'=>$oauthUser->nickname,
            'avatar'=>$oauthUser->avatar,
            'access_token'=>$oauthUser->accessTokenResponseBody['access_token'],
            'refresh_token'=>$refresh_token,
            'expires_in'=>$oauthUser->accessTokenResponseBody['expires_in'],
        ]);


        if($oauthData){
            return redirect(route('auth.oauth.profile',['auth_id'=>$oauthUser->id]));
        }

        return $this->error(route('auth.profile.oauth'),$type.'登录错误，请稍后再试！');

    }

    public function unbind( $type , Request $request){
        $request->user()->userOauth()->where('auth_type','=',$type)->delete();
        return $this->success( route('auth.profile.oauth') , $type .'已解除绑定！');
    }


    public function profile($auth_id)
    {
        $userOauth = UserOauth::find($auth_id);
        if(!$userOauth){
            abort(404);
        }
        return view('theme::account.oauth')->with(compact('userOauth'));
    }


    public function register(Request $request,Registrar $registrar,Guard $auth)
    {
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
        $auth->login($user);
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

        if($emailToken){
            $subject = '欢迎注册'.Setting()->get('website_name').',请激活您注册的邮箱！';
            $content = "「".$request->user()->name."」您好，请激活您在 ".Setting()->get('website_name')." 的注册邮箱！<br /> 请在1小时内点击该链接激活注册账号 → ".route('auth.email.verifyToken',['action'=>$emailToken->action,'token'=>$emailToken->token])."<br />如非本人操作，请忽略此邮件！";
            $this->sendEmail($emailToken->email,$subject,$content);
        }

        return $this->success(route('website.index'),$message);
    }


}