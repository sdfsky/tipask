<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 15/10/27
 * Time: 下午7:11
 */

if (!function_exists('trans_common_bool')) {
    function trans_common_bool($value)
    {
        $map = [
            0 => '否',
            1 => '是',
        ];

        if ($value === 'all') {
            return $map;
        }


        if (isset($map[$value])) {
            return $map[$value];
        }

        return '';
    }

}

/*商品类型字段定义*/
if (!function_exists('trans_goods_post_type')) {

    function trans_goods_post_type($post_type)
    {
        $map = [
            0 => '不需要',
            1 => '需要',
        ];

        if ($post_type === 'all') {
            return $map;
        }


        if (isset($map[$post_type])) {
            return $map[$post_type];
        }

        return '';

    }

}

if (!function_exists('trans_gender_name')) {

    function trans_gender_name($post_type)
    {
        $map = [
            0 => '保密',
            1 => '男',
            2 => '女',
        ];

        if ($post_type === 'all') {
            return $map;
        }


        if (isset($map[$post_type])) {
            return $map[$post_type];
        }

        return '';

    }

}

/*行家认证状态文字定义*/
if (!function_exists('trans_authentication_status')) {

    function trans_authentication_status($status)
    {
        $map = [
            0 => '待审核',
            1 => '审核通过',
            4 => '审核失败',
        ];

        if ($status === 'all') {
            return $map;
        }


        if (isset($map[$status])) {
            return $map[$status];
        }

        return '';

    }

}


/*公告状态文字定义*/
if (!function_exists('trans_exchange_status')) {

    function trans_exchange_status($status)
    {
        $map = [
            0 => '未处理',
            1 => '已处理',
            4 => '兑换失败',
        ];

        if ($status === 'all') {
            return $map;
        }


        if (isset($map[$status])) {
            return $map[$status];
        }

        return '';

    }

}

/*公告状态文字定义*/
if (!function_exists('trans_common_status')) {

    function trans_common_status($status)
    {
        $map = [
            0 => '待审核',
            1 => '已审核',
            -1 => '已禁言'
        ];

        if ($status === 'all') {
            return $map;
        }


        if (isset($map[$status])) {
            return $map[$status];
        }

        return '';

    }

}

/*草稿类型定义*/
if (!function_exists('trans_draft_type')) {

    function trans_draft_type($type)
    {
        $map = [
            'question' => '提问',
            'answer' => '回答',
            'article' => '文章'
        ];

        if ($type === 'all') {
            return $map;
        }


        if (isset($map[$type])) {
            return $map[$type];
        }

        return '';

    }

}

/*举报状态定义*/
if (!function_exists('trans_report_status')) {

    function trans_report_status($status)
    {
        $map = [
            0 => '待处理',
            1 => '已处理',
            4 => '已忽略'
        ];

        if ($status === 'all') {
            return $map;
        }

        if (isset($map[$status])) {
            return $map[$status];
        }

        return '';
    }
}

/*举报原因类型定义*/
if (!function_exists('trans_report_type')) {

    function trans_report_type($type)
    {
        // 读取定义的配置信息
        $map = config('tipask.report_type');
        if ($type === 'all') {
            return $map;
        }

        if (isset($map[$type])) {
            return $map[$type]['subject'];
        }

        return '';
    }
}

/*公告状态文字定义*/
if (!function_exists('trans_pay_status')) {

    function trans_pay_status($status)
    {
        $map = [
            0 => '待支付',
            1 => '已支付',
        ];

        if ($status === 'all') {
            return $map;
        }


        if (isset($map[$status])) {
            return $map[$status];
        }

        return '';

    }

}


/*问题状态文本描述定义*/
if (!function_exists('trans_question_status')) {

    function trans_question_status($status)
    {
        $map = [
            -1 => '待支付',
            0 => '待审核',
            1 => '待解决',
            2 => '已解决',
        ];

        if ($status === 'all') {
            return $map;
        }

        if (isset($map[$status])) {
            return $map[$status];
        }

        return '';
    }

}

/*问题状态文本描述定义*/
if (!function_exists('trans_day_of_week')) {

    function trans_day_of_week($day)
    {
        $map = [
            0 => '星期天',
            1 => '星期一',
            2 => '星期二',
            3 => '星期三',
            4 => '星期四',
            5 => '星期五',
            6 => '星期六',
        ];

        if ($day === 'all') {
            return $map;
        }

        if (isset($map[$day])) {
            return $map[$day];
        }
        return '';
    }

}




if (!function_exists('trans_question_price')) {
    function trans_question_price($price = 'all')
    {
        $map = [0, 5, 10, 15, 20, 30, 50, 80, 100];
        return $map;
    }
}


/*数据库setting表操作*/
if (!function_exists('Setting')) {

    function Setting()
    {
        return app('App\Models\Setting');
    }

}


/*数据库Category表操作*/
if (!function_exists('load_categories')) {

    function load_categories($type = 'all')
    {
        return app('App\Models\Category')->loadFromCache($type);
    }

}

/*数据库Category表操作*/
if (!function_exists('make_option_tree')) {

    function make_option_tree($type = 'all', $select_id = 0)
    {
        $categories = app('App\Models\Category')->loadFromCache($type);
        return app('App\Models\Category')->makeOptionTree($categories, $select_id);
    }

}

/*生成分类Tab下拉数据格式*/
if (!function_exists('get_category_tab_data')) {

    function get_category_tab_data($type = 'all', $size = 6)
    {
        $categories = app('App\Models\Category')->loadFromCache($type);
        $rootCategories = [];
        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $rootCategories[] = $category;
            }
        }
        $tabData['out_tabs'] = array_slice($rootCategories,0,$size);
        $tabData['in_tabs'] = array_slice($rootCategories,$size);
        return $tabData;
    }

}


/*数据库area地区表操作*/
if (!function_exists('Area')) {

    function Area()
    {
        return app('App\Models\Area');
    }

}


/**
 * 将正整数转换为带+,例如 10 装换为 +10
 * 用户积分显示
 */
if (!function_exists('integer_string')) {
    function integer_string($value)
    {
        if ($value >= 0) {
            return '+' . $value;
        }

        return $value;
    }
}

if (!function_exists('get_credit_message')) {
    function get_credit_message($credits, $coins)
    {
        $messages = [];
        if ($credits != 0) {
            $messages[] = '经验 ' . integer_string($credits);
        }
        if ($coins != 0) {
            $messages[] = '金币 ' . integer_string($coins);
        }
        return implode("，", $messages);
    }
}


if (!function_exists('timestamp_format')) {
    function timestamp_format($timestamp, $showDateTime = true)
    {
        $carbon = \Carbon\Carbon::instance(new DateTime($timestamp));
        $time_format_string = Setting()->get('date_format');
        if ($showDateTime) {
            $time_format_string .= ' ' . Setting()->get('time_format');
        }
        if (Setting()->get('time_friendly') == 1) {
            return $carbon->diffInWeeks(\Carbon\Carbon::now()) >= 1 ? $carbon->format($time_format_string) : $carbon->diffForHumans();
        }
        return $carbon->format($time_format_string);

    }
}


if (!function_exists('parse_seo_template')) {
    function parse_seo_template($type, $source)
    {
        $seo_template = Setting()->get($type);
        $seo_template = str_replace("{wzmc}", Setting()->get('website_name'), $seo_template);
        $seo_template = str_replace("{wzkh}", Setting()->get('website_slogan'), $seo_template);

        if (str_contains($type, ['question', 'article'])) {
            if ($source->tags) {
                $tagList = array_pluck($source->tags->toArray(), 'name');
                $seo_template = str_replace("{htlb}", implode(",", $tagList), $seo_template);
            }
        }

        if (str_contains($type, 'question')) {
            $seo_template = str_replace("{wtbt}", strip_tags($source->title), $seo_template);
            $seo_template = str_replace("{wtms}", str_limit(strip_tags($source->description), 200), $seo_template);
        } else {
            if (str_contains($type, 'article')) {
                $seo_template = str_replace("{wzbt}", strip_tags($source->title), $seo_template);
                $seo_template = str_replace("{wzzy}", str_limit($source->summary, 200), $seo_template);
            } else {
                if (str_contains($type, 'topic')) {
                    $seo_template = str_replace("{htmc}", $source->name, $seo_template);
                    $seo_template = str_replace("{htjj}", str_limit($source->summary, 200), $seo_template);
                }
            }
        }

        return $seo_template;
    }
}

/*生成头像图片地址*/
if (!function_exists('get_user_avatar')) {
    function get_user_avatar($user_id, $size = 'middle', $extension = 'jpg', $random = '')
    {
        $avatarName = $user_id . '_' . $size . '.' . $extension;

        if ($random) {
            $avatarName .= '?' . str_random(8);
        }

        return route('website.image.avatar', ['avatar_name' => $avatarName]);
    }
}


/*常见的正则判断*/

/*邮箱判断*/
if (!function_exists('is_email')) {
    function is_email($email)
    {
        $reg = "/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
        if (preg_match($reg, $email)) {
            return true;
        }
        return false;
    }
}

/*手机号码判断*/
if (!function_exists('is_mobile')) {
    function is_mobile($mobile)
    {
        $reg = "/^1[3456789]\d{9}$/";
        if (!preg_match($reg, $mobile)) {
            return false;
        }
        return true;
    }
}


/*创建唯一订单号*/
if (!function_exists('build_order_no')) {
    function build_order_no($user_id = 0)
    {
        $order_no = date('Ymd') . substr(implode(null, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        $salt = md5($user_id);
        $star = strtoupper(substr($salt, 1, 5));
        return $order_no . $star;
    }
}


/*创建唯一订单号*/
if (!function_exists('random_number')) {
    function random_number($length = 6)
    {
        $pool = '0123456789';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}


/*金币转换元*/
if (!function_exists('coins_to_cent')) {
    function coins_to_cent($coins)
    {
        /*获取1元能够吗多少个金币*/
        $charge_rage = config('pay.charge_rate');
        if ($charge_rage > 0 && $coins > 0) {
            $rate = ceil(100 / $charge_rage); //计算单个金币的价格
            $result = $coins * $rate;
            return $result;
        }
        return 0;
    }
}

if (!function_exists('yuan_to_coins')) {
    function yuan_to_coins($yuan)
    {
        $charge_rage = config('pay.charge_rate');
        if ($charge_rage > 0 && $yuan > 0) {
            $result = $yuan * $charge_rage;
            return $result;
        }
        return false;
    }
}


/*分转元*/
if (!function_exists('cent_to_yuan')) {
    function cent_to_yuan($cent)
    {
        return '￥' . number_format($cent / 100, 2);
    }
}

if (!function_exists('format_money')) {
    function format_money($money)
    {
        return number_format($money / 100, 2);
    }
}


/*提取html内容中的img标签图片地址*/
if (!function_exists('get_editor_images')) {
    function get_editor_images($content)
    {
        preg_match_all('/<img[^>]+>/i', $content, $imgTags);
        $imageUrls = [];
        for ($i = 0; $i < count($imgTags[0]); $i++) {
            preg_match('/src="([^"]+)/i', $imgTags[0][$i], $imgage);
            $imageUrls[] = str_ireplace('src="', '', $imgage[0]);
        }
        return $imageUrls;
    }
}


if (!function_exists('env_cert')) {
    function env_cert($env_param)
    {
        $cert_string = '';
        if (file_exists(env($env_param, ''))) {
            $cert_string = file_get_contents(env($env_param));
        }
        return $cert_string;
    }
}
















