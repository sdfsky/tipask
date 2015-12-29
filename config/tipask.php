<?php
/**
 * Tipask全局配置
 * User: sdf_sky
 * Date: 15/9/4
 * Time: 上午11:40
 */

return [
    'user_cache_time' => 1, //用户数据缓存时间单位分钟
    'admin' => [
        'page_size' => 15,  //后台分页列表显示数目
    ],
    'user_actions' => [   //积分操作动作
        'login'    => '登录',
        'register' => '注册',
        'ask'      => '发起提问',
        'answer'   => '回答问题',
        'follow_question' => '关注了问题',

    ],
    'notification_types' =>[
        'answer'  => '回答了问题',
        'comment_user' => '回复了',
        'comment_question' => '评论了问题',
        'comment_answer' => '评论了',
        'comment_article' => '评论了文章',
        'follow_question' => '关注了问题',
    ],

];