<?php

namespace App\Http\Requests;


class LecturerRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
/*    public function rules()
    {
//        return [];
        return [
            'name' => 'required|max:64',
            'email' => 'required|email|max:128',
            'mobile' => 'required|between:11,11|integer',
            'theme' => 'required|max:9999',
            'description' => 'required|max:9999',
            'credentials' => 'sometimes|max:9999',
            'project' => 'sometimes|max:9999',
        ];
    }*/

    // 提交专家申请
    public function getPostStoreRules()
    {
        return [
            'name' => 'required|max:64',
            'email' => 'required|email|max:128',
            'mobile' => 'required|integer',
            'theme' => 'required|max:9999',
            'description' => 'required|max:9999',
            'credentials' => 'sometimes|max:9999',
            'project' => 'sometimes|max:9999',
            'captcha' => 'required|captcha',
        ];
    }

    // 修改专家申请
    public function getPostEditRules()
    {
        return [
            'name' => 'required|max:64',
            'email' => 'required|email|max:128',
            'mobile' => 'required|integer',
            'theme' => 'required|max:9999',
            'description' => 'required|max:9999',
            'credentials' => 'sometimes|max:9999',
            'project' => 'sometimes|max:9999',
            'captcha' => 'required|captcha',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '真实姓名不能为空',
            'name.max' => '真实姓名长度不能超过:max个字符',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'email.max' => '邮箱长度不能超过:max个字符',
            'mobile.required' => '手机号码不能为空',
            'mobile.integer' => '手机号码必须为11位数字',
            'mobile.between' => '手机号码必须为11位数字',
            'theme.required' => '演讲主题不能为空',
            'theme.max' => '演讲主题不能超过:max个字符',
            'description.required' => '个人简介不能为空',
            'description.max' => '个人简介不能超过:max个字符',
            'credentials.max' => '证书/评级信息不能超过:max个字符',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ];
    }
}
