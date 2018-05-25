<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2018/5/8
 * Time: 下午4:23
 */

namespace App\Services;


class CaptchaService
{

    public  function setValidateRules($type, &$validateRules){
        /*目前极验验证只对于用户登陆、注册、提问、发布文章开放*/
        if( in_array($type, ['code_login','code_register','code_create_question','code_create_answer','code_create_article']) && config('services.geetest_open')){
            $validateRules['geetest_challenge'] = 'geetest';
        } else {
            $validateRules['captcha'] = 'required|captcha';
        }
    }
}