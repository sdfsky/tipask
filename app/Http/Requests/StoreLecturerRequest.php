<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLecturerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'sometimes|unique:lecturers',
            'name' => 'required|max:64',
            'email' => 'required|email|max:128',
            'mobile' => 'required|integer',
            'theme' => 'required|max:9999',
            'description' => 'required|max:9999',
            'credentials' => 'sometimes|max:9999',
            'project' => 'sometimes|max:9999',
            'status' => 'in:1,4,0'
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
