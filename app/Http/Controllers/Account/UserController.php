<?php

namespace App\Http\Controllers\Account;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
            /*表单数据校验*/
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6',
                'captcha' => 'required|captcha'
            ]);

            /*只接收email和password的值*/
            $credentials = $request->only('email', 'password');

            /*根据邮箱地址和密码进行认证*/
            if ($this->auth->attempt($credentials, $request->has('remember')))
            {
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
        /*注册表单处理*/
        if($request->isMethod('post'))
        {
            $request->flashExcept(['password','password_confirmation']);
            $validator = $this->registrar->validator($request->all());
            if ($validator->fails())
            {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            $this->auth->login($this->registrar->create($request->all()));

            return redirect(route('website.index'));

        }
        return view("theme::account.register");
    }

    /**
     * 用户登出
     */
    public function logout(){

        $this->auth->logout();

        return redirect()->to(route('website.index'));

    }



}
