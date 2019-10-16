<?php
/**
 * Tipask全局配置
 * User: sdf_sky
 * Date: 15/9/4
 * Time: 上午11:40
 */

return [
    'version' => 'Tipask3.5',
    'theme'   => env('WEBSITE_THEME','default'),
    'skin'    => env('WEBSITE_SKIN','default'),
    'admin_email' => env('WEBSITE_ADMIN_EMAIL',''),
    'release' => 20191016,
    'user_cache_time' => 1, //用户数据缓存时间单位分钟
    'user_invite_limit' => 10,//用户邀请回答限制数
    'super_admin_id' => env('SUPER_ADMIN_ID',1),
    'skins' => [
        'default' => '默认',
        'dark' => '深色',
        'blue' => '深蓝',
        'green' => '青绿',
        'warm-red' => '暖红',
        'light' => '浅色'
    ],
    'admin' => [
        'page_size' => 15,  //后台分页列表显示数目
    ],
    'user_actions' => [   //积分操作动作
        'login'    => '登录',
        'register' => '注册',
        'ask'      => '发起提问',
        'answer'   => '回答问题',
        'follow_question' => '关注了问题',
        'append_reward' => '对问题追加悬赏',
        'answer_adopted' => '回答被采纳',
        'create_article' => '发表了文章',
        'exchange' => '兑换商品',
        'reward_user' => '系统奖励',
        'punish_user' => '系统惩罚',
        'sign' => '签到',
    ],
    'notification_types' =>[
        'answer'  => '回答了问题',
        'reply_comment'  => '回复了',
        'comment_question' => '评论了问题',
        'comment_answer' => '评论了回答',
        'comment_article' => '评论了文章',
        'follow_question' => '关注了问题',
        'invite_answer' => '邀请您回答问题',
        'adopt_answer' => '采纳了您的回答',
        'create_article' => '发表了文章',
        'follow_user' => '关注了你',
        'remove_question' => '删除了问题',
        'remove_answer' => '删除了回答',
        'remove_article' => '删除了文章',
    ],
    'summernote'=>[
        'ask' => "['common', ['style','bold','ol','link','picture','attachment','video','clear','codeview','fullscreen']]",
        'blog' => "['common', ['style','bold','color','ol', 'paragraph','table','video','link','picture','attachment','clear','codeview','fullscreen']]",
    ],

    'upload' =>[
        'image_size'  => env('UPLOAD_IMAGE_SIZE',2048),    //最大上传图片大小
        'attach_size' => env('UPLOAD_ATTACH_SIZE',8192),   //最大上传附件大小
        'open_watermark' => env('UPLOAD_OPEN_WATERMARK',0),//开启图片水印
        'watermark_image' => env('UPLOAD_WATERMARK_IMAGE',''),//图片水印地址
    ],
    'mail_drivers' => [
        'smtp' => '连接 SMTP 服务器发送',
        'sendmail' => '通过sendmail方式进行发送',
    ],
    'category_types' => [
        'questions' => '问题',
        'articles' => '文章',
        'tags' => '话题',
        'experts' => '专家',
        'goods' => '商城',
    ],
    
    'sms_limit_times' => 10,
    'report_type' => [
        1 => [
            'subject' => '垃圾广告信息',
            'desc' => '广告、推广、测试等内容',
        ],
        2 => [
            'subject' => '违规内容',
            'desc' => '色情、暴力、血腥、敏感信息等内容',
        ],
        3 => [
            'subject' => '不友善内容',
            'desc'    => '人身攻击、挑衅辱骂、恶意行为'
        ],
        99 => [
            'subject' => '其他原因',
            'desc'    => '请补充说明'
        ],
    ]
];