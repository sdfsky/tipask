<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\EmailToken;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $auth;

    protected $registrar;


    public function __construct(Guard $auth,Registrar $registrar){
        $this->auth = $auth;
        $this->registrar = $registrar;
    }

    public function login(Request $request){

        /*登录表单处理*/
        if($request->isMethod('post'))
        {

            $request->flashOnly('email');

            $validateRules = [
                'email' => 'required|min:8|max:128',
                'password' => 'required|min:6'
            ];

            if( Setting()->get('code_login') == 1){
                $validateRules['captcha'] = 'required|captcha';
            }

            /*表单数据校验*/
            $this->validate($request,$validateRules);

            /*只接收email和password的值*/
            $credentials = $request->only('email', 'password');

            /*根据邮箱地址和密码进行认证*/
            if ($this->auth->attempt($credentials, $request->has('remember')))
            {

                if($this->credit($request->user()->id,'login',Setting()->get('coins_login'),Setting()->get('credits_login'))){
                    $message = '登陆成功! '.get_credit_message(Setting()->get('credits_login'),Setting()->get('coins_login'));
                   return $this->success(route('website.index'),$message);
                }

                /*认证成功后跳转到首页*/
                return redirect()->to(route('website.index'));

            }

            /*登录失败后跳转到首页，并提示错误信息*/
            return redirect(route('auth.user.login'))
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'password' => '用户名或密码错误，请核实！',
                ]);

        }

        return view("theme::account.login");
    }

    /**
     * 用户注册入口
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function register(Request $request)
    {

        /*注册是否开启*/
        if(!Setting()->get('register_open',1)){
            return $this->showErrorMsg(route('website.index'),'管理员已关闭了网站的注册功能！');
        }

        /*防灌水检查*/
        if( Setting()->get('register_limit_num') > 0 ){
            $registerCount = $this->counter('register_number_'.md5($request->ip()));
            if( $registerCount > Setting()->get('register_limit_num')){
                return $this->showErrorMsg(route('website.index'),'您的当前的IP已经超过当日最大注册数目，如有疑问请联系管理员');
            }
        }

        /*注册表单处理*/
        if($request->isMethod('post'))
        {
            $request->flashExcept(['password','password_confirmation']);
            /*表单数据校验*/
            $validateRules = [
                'name' => 'required|min:2|max:100',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6|max:16',
            ];

            if( Setting()->get('code_register') == 1){
                $validateRules['captcha'] = 'required|captcha';
            }

            $this->validate($request,$validateRules);

            $formData = $request->all();
            $formData['status'] = 0;
            $formData['visit_ip'] = $request->getClientIp();

            $user = $this->registrar->create($formData);
            $user->attachRole(2); //默认注册为普通用户角色
            $this->auth->login($user);
            $message = '注册成功!';
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

            /*记录注册ip*/
            $this->counter('register_number_'.md5($request->ip()) , 1 );

            return $this->success(route('website.index'),$message);
        }
        return view("theme::account.register");
    }


    /*忘记密码*/
    public function forgetPassword(Request $request)
    {

        if($request->isMethod('post'))
        {
            $request->flashOnly('email');
            /*表单数据校验*/
            $this->validate($request, [
                'email' => 'required|email|exists:users',
                'captcha' => 'required|captcha'
            ]);

            $emailToken = EmailToken::create([
                'email' =>  $request->input('email'),
                'token' => EmailToken::createToken(),
                'action'=> 'findPassword'
            ]);

            if($emailToken){
                $subject = Setting()->get('website_name').' 找回密码通知';
                $content = "如果您在 ".Setting()->get('website_name')."的密码丢失，请点击下方链接找回 → ".route('auth.user.findPassword',['token'=>$emailToken->token])."<br />如非本人操作，请忽略此邮件！";
                $this->sendEmail($emailToken->email,$subject,$content);
            }

            return view("theme::account.forgetPassword")->with('success','ok')->with('email',$request->input('email'));

        }


        return view("theme::account.forgetPassword");

    }


    public function findPassword($token,Request $request)
    {
        if($request->isMethod('post')){

            $this->validate($request, [
                'password' => 'required|min:6',
                'captcha' => 'required|captcha'
            ]);

            $emailToken = EmailToken::where('action','=','findPassword')->where('token','=',$token)->first();
            if(!$emailToken){
                return $this->error(route('website.ask'),'token信息不存在，请重新找回');
            }

            if($emailToken->created_at->diffInMinutes() > 60){

                return $this->error(route('website.ask'),'token信息已失效，请重新找回');
            }

            $user = User::where('email','=',$emailToken->email)->first();

            if(!$user){
                return $this->error(route('website.ask'),'用户不存在或已被删除');
            }

            $user->password = Hash::make($request->input('password'));
            $user->save();

            EmailToken::clear($user->email,'findPassword');

            return $this->success(route('auth.user.login'),'密码修改成功,请重新登录');

        }

        return view("theme::account.findPassword")->with('token',$token);

    }



    /**
     * 用户登出
     */
    public function logout(){

        $this->auth->logout();

        return redirect()->to(route('website.index'));

    }



}
