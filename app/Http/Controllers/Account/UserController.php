<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\EmailToken;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\CaptchaService;
use App\Services\CreditService;
use App\Services\SmsService;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $auth;

    protected $userRepository;
    protected $captchaService;


    public function __construct(Guard $auth,UserRepository $userRepository,CaptchaService $captchaService){
        $this->auth = $auth;
        $this->userRepository = $userRepository;
        $this->captchaService = $captchaService;
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
                $this->captchaService->setValidateRules('code_login', $validateRules);
            }

            /*表单数据校验*/
            $this->validate($request,$validateRules);

            /*只接收email和password的值*/
            $credentials = [
                'password' => $request->input('password')
            ];
            if(is_email($request->input('email'))){
                $credentials['email'] =   $request->input('email');
            }else{
                $credentials['mobile'] =   $request->input('email');
            }

            /*根据邮箱地址和密码进行认证*/
            if ($this->auth->attempt($credentials, $request->has('remember')))
            {

                if($this->credit($request->user()->id,'login',Setting()->get('coins_login'),Setting()->get('credits_login'))){
                    $message = '登陆成功! '.get_credit_message(Setting()->get('credits_login'),Setting()->get('coins_login'));
                   return $this->success(route('website.index'),$message,true);
                }
                /*认证成功后跳转到首页*/
                return $this->success(route('auth.doing.index'),'登陆成功！',true);
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
            if( $registerCount >= Setting()->get('register_limit_num')){
                return $this->showErrorMsg(route('website.index'),'您的当前的IP已经超过当日最大注册数目，如有疑问请联系管理员');
            }
        }

        /*注册表单处理*/
        if($request->isMethod('post'))
        {
            $request->flashExcept(['password','password_confirmation']);
            /*表单数据校验*/
            $validateRules = [
                'name' => 'required|min:2|max:100|unique:users',
                'password' => 'required|confirmed|min:6|max:16',
            ];
            if(Setting()->get('register_type') == 'email'){
                $validateRules['email'] = 'required|email|max:255|unique:users';
            }else{
                $validateRules['mobile'] = 'required|regex:/^1[3456789]\d{9}$/|unique:users';
                $validateRules['code'] = 'required|min:4|:max:8';
            }

            if( Setting()->get('code_register') == 1){
                $this->captchaService->setValidateRules('code_register', $validateRules);
            }

            $this->validate($request,$validateRules);

            $formData = $request->all();
            $formData['status'] = 0;
            $formData['visit_ip'] = $request->getClientIp();


            if( Setting()->get('register_type') == 'mobile' ){
                if( !SmsService::verifySmsCode($formData['mobile'],$request->input('code')) )  {
                    return view("theme::account.register")->withErrors(['code'=>'短信验证码错误']);
                }
                $formData['status'] = 1;
            }

            $user = $this->userRepository->register($formData);
            $user->attachRole(2); //默认注册为普通用户角色
            $this->auth->login($user);
            $message = '注册成功!';
            if($this->credit($request->user()->id,'register',Setting()->get('coins_register'),Setting()->get('credits_register'))){
                $message .= get_credit_message(Setting()->get('credits_register'),Setting()->get('coins_register'));
            }

            if(Setting()->get('register_type')=='email'){
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
            }

            /*记录注册ip*/
            $this->counter('register_number_'.md5($request->ip()) , 1,86400 );

            return $this->success(route('website.index'),$message);
        }
        return view("theme::account.register");
    }


    /*忘记密码*/
    public function forgetPassword()
    {
        return view("theme::account.forgetPassword");
    }


    /*通过邮件方式找回密码*/
    public function findByEmail(Request $request){
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

            return view("theme::account.findByEmail")->with('success','ok')->with('email',$request->input('email'));

        }

        return view("theme::account.findByEmail");
    }


    /*通过手机验证码找回密码*/
    public function findByMobile(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'mobile' => 'required|regex:/^1[34578]\d{9}$/|exists:users',
                'code' => 'required|min:4|max:6',
                'password' => 'required|min:6|max:32'
            ]);

            $mobile = $request->input('mobile');
            $code = $request->input('code');

            if( !SmsService::verifySmsCode($mobile,$code) ){
                return view("theme::account.findByMobile")->withErrors(['code'=>'验证码错误']);
            }

            $user = User::where('mobile','=',$mobile)->first();

            if(!$user){
                return view("theme::account.findByMobile")->withErrors(['mobile'=>'手机号不存在']);
            }

            $user->password = Hash::make($request->input('password'));
            $user->save();

            return $this->success(route('auth.user.login'),'密码修改成功,请重新登录');
        }
        return view("theme::account.findByMobile");

    }


    public function findPassword($token,Request $request)
    {
        if($request->isMethod('post')){

            $this->validate($request, [
                'password' => 'required|min:6|max:32',
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

    /*每日签到*/
    public function sign(Request $request){
        if(!Setting()->get('open_user_sign')){
            abort(404);
        }
        $loginUser = $request->user();
        if($loginUser->isSigned()){
            return $this->error(route('website.index'),'今日已签到，不能重复签到');
        }
        $message = '签到成功!';
        if(CreditService::create($loginUser->id, 'sign', Setting()->get('coins_sign'),Setting()->get('credits_sign'))){
            $message .= get_credit_message(Setting()->get('credits_sign'),Setting()->get('coins_sign'));
        }
        return $this->success(route('website.index'),$message);
    }


    /**
     * 用户登出
     */
    public function logout(){
        $this->auth->logout();
        return redirect()->to(route('website.index'));
    }



}
