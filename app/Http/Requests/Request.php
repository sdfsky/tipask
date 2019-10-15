<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
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
        return $this->getRules();
    }

    public function getRules()
    {
        list(, $action) = explode('@', $this->route()->getActionName());
        $ruleMethodName = 'get' . ucfirst($action) . 'Rules';
        if(method_exists($this, $ruleMethodName)){
            $rules = $this->$ruleMethodName();
            if(is_array($rules)){
                return $rules;
            }
        }
        return [];
    }
}
