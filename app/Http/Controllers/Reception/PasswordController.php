<?php
/**
 * 用户密码相关操作.
 * User: simon
 * Date: 2015/4/21
 * Time: 14:34
 */

namespace App\Http\Controllers\Reception;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;

class PasswordController extends ReceptionController{

    protected $auth;
    protected $passwords;

    public function __construct(Guard $auth,PasswordBroker $passwords){

        $this->auth = $auth;

        $this->passwords = $passwords;

    }


} 