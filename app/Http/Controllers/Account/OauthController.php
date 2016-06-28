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
use App\Models\User;
use App\Models\UserOauth;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function login($type){
        return Socialite::with($type)->redirect();
    }

    public function callback($type,Request $request){

        $oauthUser = Socialite::driver($type)->user();

        $userOauth = UserOauth::firstOrCreate(['id'=>$oauthUser->id]);
        $userOauth->auth_type = $type;
        $userOauth->nickname = $oauthUser->nickname;
        $userOauth->avatar = $oauthUser->avatar;
        $userOauth->access_token = $oauthUser->accessTokenResponseBody['access_token'];
        $userOauth->refresh_token = $oauthUser->accessTokenResponseBody['refresh_token'];
        $userOauth->expires_in = $oauthUser->accessTokenResponseBody['expires_in'];

        if(Auth()->guest()){//游客登录
            $userOauth->save();
            return redirect(route('auth.oauth.profile',['auth_id'=>$userOauth->id]));
        }

        $userOauth->user_id =  $request->user()->id;
        $userOauth->save();
        return $this->success( route('auth.profile.oauth') , $type .'绑定成功！');


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
            //同步用户头像
            $this->syncAvatar($userOauth->user_id,$userOauth->avatar);
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

        $this->sendEmail($user->id,'register','欢迎注册'.Setting()->get('website_name').',请激活您注册的邮箱！',$emailToken,true);

        return $this->success(route('website.index'),$message);
    }

    /*同步用户头像*/
    private function syncAvatar($userId,$avatarUrl){

        $avatarFile = storage_path('app/'.User::getAvatarPath($userId,'small'));
        if(is_file($avatarFile)){
            return true;
        }
        $extension = '.jpg';
        $avatarDir = User::getAvatarDir($userId);
        Storage::disk('local')->put($avatarDir.'/'.User::getAvatarFileName($userId,'origin').$extension,File::get($avatarUrl));
        Image::make(storage_path('app/'.User::getAvatarPath($userId,'origin',$extension)))->resize(128,128)->save(storage_path('app/'.User::getAvatarPath($userId,'big')));
        Image::make(storage_path('app/'.User::getAvatarPath($userId,'origin',$extension)))->resize(64,64)->save(storage_path('app/'.User::getAvatarPath($userId,'middle')));
        Image::make(storage_path('app/'.User::getAvatarPath($userId,'origin',$extension)))->resize(24,24)->save(storage_path('app/'.User::getAvatarPath($userId,'small')));
        return response('ok');
    }

}