<?php

namespace App\Http\Controllers\Account;

use App\Models\EmailToken;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{

    protected $auth;



    public function __construct(Guard $auth){
        $this->auth = $auth;
    }


    /*验证邮箱token*/
    public function verifyToken($action,$token)
    {
        $emailToken = EmailToken::where('action','=',$action)->where('token','=',$token)->first();
        if(!$emailToken){
            return $this->error(route('website.ask'),'token信息不存在');
        }

        if($emailToken->created_at->diffInMinutes() > 60){

            return $this->error(route('website.ask'),'token信息已失效，请重新发送');
        }

        $user = User::where('email','=',$emailToken->email)->first();
        if(!$user){
            return $this->error(route('website.ask'),'用户不存在或已被删除');
        }


        if(in_array($action,['register','verify'])){

            if($user->status==0){
                $user->status=1;
                $user->save();
                $user->userData->email_status = 1;
                $user->userData->save();

            }

            $this->auth->login($user);
            EmailToken::clear($user->email,$action);
            return $this->success(route('auth.profile.base'),'邮箱验证成功');

        }

    }




    public function sendToken(Request $request)
    {
        $lastEmailToken = EmailToken::where('email','=',$request->user()->email)->orderBy('created_at','DESC')->first();
        if($lastEmailToken && $lastEmailToken->created_at->diffInMinutes() < 1)
        {
            return response('tooFast');
        }

        $emailToken = EmailToken::create([
            'email' => $request->user()->email,
            'action' => 'verify',
            'token' => EmailToken::createToken(),
        ]);

        $this->sendEmail($request->user()->id,'verify','您好，请激活您在'.Setting()->get('website_name').'注册的邮箱！',$emailToken,true);

        if($emailToken){
            return response('success');
        }

        return response('failed');

    }


}
