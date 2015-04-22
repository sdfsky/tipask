<?php

/**
 * 自定义函数处理
 */

if ( ! function_exists('app_var'))
{
    /**
     * 获取系统变量
     * @param  string  $var_name
     * @return String var value
     */
    function app_var($var_name)
    {
        $var_value = null;
        switch($var_name){
            case 'ACTION_NAME':
              $action_path = app('request')->route()->getActionName();
              $end_pos = strrpos($action_path,'\\')+1;
              list($controll_name,$var_value) = explode("@",substr($action_path,$end_pos));
            break;
            case 'CONTROLLER_NAME':
              $action_path = app('request')->route()->getActionName();
              $end_pos = strrpos($action_path,'\\')+1;
              list($var_value,$action_name) = explode("@",substr($action_path,$end_pos));
            break;
        }
        return $var_value;
    }
}

if ( ! function_exists('success'))
{
    /**
     * 记录成功的消息内容
     * @param  string  $var_name
     * @return String var value
     */
    function success($message)
    {
        app('session')->flash('message',$message);
        app('session')->flash('message_type',2);
    }
}

if ( ! function_exists('error'))
{
    /**
     * 记录成功的消息内容
     * @param  string  $var_name
     * @return String var value
     */
    function error($message)
    {
        app('session')->flash('message',$message);
        app('session')->flash('message_type',1);
    }
}





