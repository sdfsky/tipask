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

/*问题状态文本描述定义*/
if (! function_exists('trans_day_of_week')) {

    function trans_day_of_week($day){
        $map = [
            0 => '星期天',
            1 => '星期一',
            2 => '星期二',
            3 => '星期三',
            4 => '星期四',
            5 => '星期五',
            6 => '星期六',
        ];

        if($day==='all'){
            return $map;
        }

        if(isset($map[$day])){
            return $map[$day];
        }
        return '';
    }

}

/**
 * 判断地址是否为内网
 * @param string $addr
 * @return bool
 */
if( !function_exists('isIntranet') ) {
    function isIntranet($addr)
    {
        //验证是否是 IPv4
        if ( !filter_var($addr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return false;
        }
        //是否为 内网
        if ( !filter_var($addr, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
            return true;
        }
        return false;
    }
}
if( !function_exists('ta_version') ) {

    function ta_version()
    {
        return ['plug_version' => '1.0', 'php_version' => PHP_VERSION, 'OS' => PHP_OS, 'cms_version' => config("tipask.version")];
    }
}

if( !function_exists('ta_success') ) {
    function ta_success($data = "", $message = "")
    {
        ta_result(1, $data, $message);
    }
}

if( !function_exists('ta_fail') ) {
    function ta_fail($code = 2, $data = "", $message = "")
    {
        ta_result($code, $data, $message);
    }
}

if( !function_exists('ta_result') ) {
    function ta_result($result = 1, $data = "", $message = "")
    {
        if (isset($_GET['callback']) && $_GET['callback']) {
            die($_GET['callback'] . "(" . json_encode(["result" => $result, "data" => $data, "message" => urlencode($message)]) . ")");
        } else {
            die(json_encode(["result" => $result, "data" => $data, "message" => urlencode($message)]));
        }
    }
}

/**
 * @return \Illuminate\Support\Collection
 */
if( !function_exists('mergeRequest') ) {
    function mergeRequest()
    {
        if (isset($_GET['callback'])) {
            $request_data = array_merge($_GET, $_POST);
        } else {
            $request_data = $_POST;
        }
        return collect($request_data);
    }
}

if( !function_exists('ta_curl_headers') ) {
    function ta_curl_headers($url)
    {
        // 初始化Curl
        $ch = curl_init();
        // 开启header显示
        curl_setopt($ch, CURLOPT_HEADER, true);
        // 不输出网页内容
        curl_setopt($ch, CURLOPT_NOBODY, true);
        // 禁止自动输出内容
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 自动跳转
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        // 跳转时自动设置来源地址
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        // 超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        // 设置URL
        curl_setopt($ch, CURLOPT_URL, $url);
        // 关闭SSL证书验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // 返回结果
        return curl_exec($ch);
    }
}

if( !function_exists('ta_log') ) {
    function ta_log($data)
    {
        if ($data && (is_array($data) || is_object($data))) {
            if (method_exists($data, 'jsonSerialize')) {
                $data = $data->jsonSerialize();
            }
            $str = json_encode($data);
        } else {
            $str = $data;
        }
        $myfile = fopen("ta_log.txt", "a") or die("Unable to open file!");
        fwrite($myfile, $str);
        fclose($myfile);
    }
}

if( !function_exists('ta_random_ip') ) {
    function ta_random_ip()
    {
        $ip_long = [
            ['607649792', '608174079'], //36.56.0.0-36.63.255.255
            ['1038614528', '1039007743'], //61.232.0.0-61.237.255.255
            ['1783627776', '1784676351'], //106.80.0.0-106.95.255.255
            ['2035023872', '2035154943'], //121.76.0.0-121.77.255.255
            ['2078801920', '2079064063'], //123.232.0.0-123.235.255.255
            ['-1950089216', '-1948778497'], //139.196.0.0-139.215.255.255
            ['-1425539072', '-1425014785'], //171.8.0.0-171.15.255.255
            ['-1236271104', '-1235419137'], //182.80.0.0-182.92.255.255
            ['-770113536', '-768606209'], //210.25.0.0-210.47.255.255
            ['-569376768', '-564133889'], //222.16.0.0-222.95.255.255
        ];
        $rand_key = mt_rand(0, 9);
        $ip = long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
        return $ip;
    }
}

if( !function_exists('randEmail') ) {
    function randEmail($username)
    {
        $emailSps = ['163.com', 'qq.com', 'gmail.com', 'sina.com', 'weibo.com', 'yahoo.cn', '139.com'];
        $f = substr(md5($username), 8, rand(6, 12));

        return $f . '@' . $emailSps[rand(0, 6)];
    }
}





