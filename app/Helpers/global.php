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

if ( ! function_exists('list_to_tree'))
{
    /**
     * 创建tree显示
     * @param  string  $var_name
     * @return String var value
     */
    function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0) {
        // 创建Tree
        $tree = array();
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId =  $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }
}





