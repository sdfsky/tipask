<?php namespace App\Http\Controllers\Admin;

/**
 * 用户账号管理操作相关
 */
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;

class AccountController extends AdminController {

    /**
     * The Guard implementation.
     *认证模块
     * @var Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *注册模块处理
     * @var Registrar
     */
    protected $registrar;


    public function __construct(Guard $auth,Registrar $registar){

        $this->auth = $auth;

        $this->registrar = $registar;

    }

    /*
     * 用户登录入口，包含登录页面显示以及登录处理
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function login(Request $request){


        /*登录表单处理*/
        if($request->isMethod('post'))
        {

            $request->flashOnly('email');
            /*表单数据校验*/
            $this->validate($request, [
                'email' => 'required|email', 'password' => 'required|min:6',
                'captcha' => 'required|captcha'
            ]);

            /*只接收email和password的值*/
            $credentials = $request->only('email', 'password');

            /*根据邮箱地址和密码进行认证*/
            if ($this->auth->attempt($credentials, $request->has('remember')))
            {
                /*认证成功后跳转到首页*/
                return redirect()->intended(route('url'));

            }

            /*登录失败后跳转到首页，并提示错误信息*/
            return redirect(route('login'))
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'password' => '用户名或密码错误，请核实！',
                ]);

        }

        return view("admin.account.login");
    }



    /**
     * 用户登出
     */
    public function logout(){

        $this->auth->logout();

        return redirect()->intended(route('url'));

    }







}