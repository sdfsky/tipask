<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 15/10/27
 * Time: 下午7:11
 */

/*商品类型字段定义*/
if (! function_exists('trans_goods_post_type')) {

    function trans_goods_post_type($post_type){
        $map = [
            0 => '不需要',
            1 => '需要',
        ];

        if($post_type==='all'){
            return $map;
        }


        if(isset($map[$post_type])){
            return $map[$post_type];
        }

        return '';

    }

}

if (! function_exists('trans_gender_name')) {

    function trans_gender_name($post_type){
        $map = [
            0 => '保密',
            1 => '男',
            2 => '女',
        ];

        if($post_type==='all'){
            return $map;
        }


        if(isset($map[$post_type])){
            return $map[$post_type];
        }

        return '';

    }

}


/*行家认证状态文字定义*/
if (! function_exists('trans_authentication_status')) {

    function trans_authentication_status($status){
        $map = [
            0 => '待审核',
            1 => '审核通过',
            4 => '审核失败',
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


/*公告状态文字定义*/
if (! function_exists('trans_exchange_status')) {

    function trans_exchange_status($status){
        $map = [
            0 => '未处理',
            1 => '已处理',
            4 => '兑换失败',
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

/*公告状态文字定义*/
if (! function_exists('trans_common_status')) {

    function trans_common_status($status){
        $map = [
            0 => '待审核',
            1 => '已审核',
           -1 => '已禁言'
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


/*数据库Category表操作*/
if (! function_exists('load_categories')) {

    function load_categories( $type = 'all' ){
        return app('App\Models\Category')->loadFromCache($type);
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

if( ! function_exists('get_credit_message')){
    function get_credit_message($credits,$coins){
        $messages = [];
        if( $credits != 0 ){
            $messages[] = '经验 '.integer_string($credits);
        }
        if( $coins != 0 ){
            $messages[] = '金币 '.integer_string($coins);
        }
        return implode("，",$messages);
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


if( ! function_exists('parse_seo_template')){
    function parse_seo_template($type,$source){
        $seo_template = Setting()->get($type);
        $seo_template = str_replace("{wzmc}",Setting()->get('website_name'),$seo_template);
        $seo_template = str_replace("{wzkh}",Setting()->get('website_slogan'),$seo_template);

        if(str_contains($type,['question','article'])){
            if($source->tags){
                $tagList = array_pluck($source->tags->toArray(),'name');
                $seo_template = str_replace("{htlb}",implode(",",$tagList),$seo_template);
            }
        }

        if(str_contains($type,'question')) {
            $seo_template = str_replace("{wtbt}", strip_tags($source->title), $seo_template);
            $seo_template = str_replace("{wtms}", str_limit(strip_tags($source->description),200), $seo_template);
        }else if(str_contains($type,'article')){
            $seo_template = str_replace("{wzbt}",strip_tags($source->title),$seo_template);
            $seo_template = str_replace("{wzzy}",str_limit($source->summary,200),$seo_template);
        }else if(str_contains($type,'topic')){
            $seo_template = str_replace("{htmc}",$source->name,$seo_template);
            $seo_template = str_replace("{htjj}",str_limit($source->summary,200),$seo_template);
        }

        return $seo_template;
    }
}

/*生成头像图片地址*/
if(! function_exists('get_user_avatar')){
    function get_user_avatar($user_id,$size='middle',$extension='jpg'){
        return route('website.image.avatar',['avatar_name'=>$user_id.'_'.$size.'.'.$extension]);
    }
}


/*常见的正则判断*/

/*邮箱判断*/
if( !function_exists('is_email') ){
    function is_email($email){
        $reg = "/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
        if( preg_match($reg,$email) ){
            return true;
        }
        return false;
    }
}

/*手机号码判断*/
if( !function_exists('is_mobile') ){
    function is_mobile($mobile){
        $reg = "/^1[34578]\d{9}$/";
        if( !preg_match($reg,$mobile) ){
            return false;
        }
        return true;
    }
}





