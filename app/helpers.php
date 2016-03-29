<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 15/10/27
 * Time: 下午7:11
 */



/*公告状态文字定义*/
if (! function_exists('trans_common_status')) {

    function trans_common_status($status){
        $map = [
            0 => '待审核',
            1 => '已审核',
        ];

        if($status==='all'){
            return $map;
        }


        if(isset($map[$status])){
            return $map[$status];
        }

        return '';

    }

}


/*问题状态文本描述定义*/
if (! function_exists('trans_question_status')) {

    function trans_question_status($status){
        $map = [
            0 => '待审核',
            1 => '待解决',
            2 => '已解决',
        ];

        if($status==='all'){
            return $map;
        }

        if(isset($map[$status])){
            return $map[$status];
        }

        return '';
    }

}



/*数据库setting表操作*/
if (! function_exists('Setting')) {

    function Setting(){
        return app('App\Models\Setting');
    }

}


/*数据库area地区表操作*/
if (! function_exists('Area')) {

    function Area(){
        return app('App\Models\Area');
    }

}


/**
 * 将正整数转换为带+,例如 10 装换为 +10
 * 用户积分显示
 */
if( ! function_exists('integer_string')){
    function integer_string($value){
        if($value>=0){
            return '+'.$value;
        }

        return $value;
    }
}


if(! function_exists('timestamp_format')){
    function timestamp_format($date_time){
        $timestamp = \Carbon\Carbon::instance(new DateTime($date_time));
        $time_format_string = Setting()->get('date_format').' '.Setting()->get('time_format');
        if(Setting()->get('time_friendly')==1){
            return $timestamp->diffInWeeks(\Carbon\Carbon::now()) >= 1 ? $timestamp->format($time_format_string) : $timestamp->diffForHumans();
        }
        return $timestamp->format($time_format_string);

    }
}