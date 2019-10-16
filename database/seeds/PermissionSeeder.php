<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * 权限相关数据填充
     *
     * Run the database seeds
     *
     * @return void
     */

    // 执行命令  php artisan db:seed --class=PermissionSeeder
    public function run()
    {
        /*添加默认权限组*/
        DB::table('roles')->insert([
            [
                'id' => '1',
                'name' => '系统管理员',
                'slug' => 'admin',
                'description' => '后台管理员，具有最高权限',
                'level' => 1,
                'sort' => 1,
                'created_at' => '2016-02-16 09:52:13',
                'updated_at' => '2016-02-16 09:52:13'
            ],
            [
                'id' => '2',
                'name' => '会员',
                'slug' => 'member',
                'description' => '普通会员，不可管理后台',
                'level' => 1,
                'sort' => 2,
                'created_at' => '2016-02-16 09:52:13',
                'updated_at' => '2016-02-16 09:52:13'
            ],
            [
                'id' => '3',
                'name' => '管理员',
                'slug' => 'manager',
                'description' => '管理员可以管理除全局、第三方以外所有模块',
                'sort' => 3,
                'level' => 1,
                'created_at' => '2016-02-16 09:52:13',
                'updated_at' => '2016-02-16 09:52:13'
            ],
            [
                'id' => '4',
                'name' => '后台运营',
                'slug' => 'operator',
                'description' => '运营可以管理内容、运营模块',
                'level' => 1,
                'sort' => 4,
                'created_at' => '2016-02-16 09:52:13',
                'updated_at' => '2016-02-16 09:52:13'
            ],
        ]);

        DB::table('permissions')->insert([
            [
                'id' => '1',
                'name' => '后台管理首页',
                'slug' => 'admin.index.index',
                'description' => '后台管理首页',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '2',
                'name' => '后台用户管理',
                'slug' => 'admin.user.index',
                'description' => '后台用户管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '3',
                'name' => '后台专家管理',
                'slug' => 'admin.authentication.index',
                'description' => '后台专家管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '4',
                'name' => '后台讲师管理',
                'slug' => 'admin.lecturer.index',
                'description' => '后台讲师管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '5',
                'name' => '后台问题管理',
                'slug' => 'admin.question.index',
                'description' => '后台问题管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '6',
                'name' => '后台回答管理',
                'slug' => 'admin.answer.index',
                'description' => '后台回答管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '7',
                'name' => '后台文章管理',
                'slug' => 'admin.article.index',
                'description' => '后台文章管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '8',
                'name' => '后台评论管理',
                'slug' => 'admin.comment.index',
                'description' => '后台评论管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '9',
                'name' => '后台标签管理',
                'slug' => 'admin.tag.index',
                'description' => '后台标签管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '10',
                'name' => '后台分类管理',
                'slug' => 'admin.category.index',
                'description' => '后台分类管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '11',
                'name' => '后台公告管理',
                'slug' => 'admin.notice.index',
                'description' => '后台公告管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '12',
                'name' => '后台首页推荐管理',
                'slug' => 'admin.recommendation.index',
                'description' => '后台首页推荐管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '13',
                'name' => '后台积分商城管理',
                'slug' => 'admin.goods.index',
                'description' => '后台积分商城管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '14',
                'name' => '后台兑换记录管理',
                'slug' => 'admin.exchange.index',
                'description' => '后台兑换记录管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '15',
                'name' => '后台友情链接管理',
                'slug' => 'admin.friendshipLink.index',
                'description' => '后台友情链接管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '16',
                'name' => '后台积分管理',
                'slug' => 'admin.credit.index',
                'description' => '后台积分管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '18',
                'name' => '后台站点设置',
                'slug' => 'admin.setting.website',
                'description' => '后台站点设置',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '19',
                'name' => '后台邮箱设置',
                'slug' => 'admin.setting.email',
                'description' => '后台邮箱设置',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '20',
                'name' => '后台注册设置',
                'slug' => 'admin.setting.register',
                'description' => '后台注册设置',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '21',
                'name' => '后台时间设置',
                'slug' => 'admin.setting.time',
                'description' => '后台时间设置',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '22',
                'name' => '后台防灌水设置',
                'slug' => 'admin.setting.irrigation',
                'description' => '后台防灌水设置',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '23',
                'name' => '后台积分设置',
                'slug' => 'admin.setting.credits',
                'description' => '后台积分设置',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '24',
                'name' => '后台SEO设置',
                'slug' => 'admin.setting.seo',
                'description' => '后台SEO设置',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '25',
                'name' => '后台功能定制',
                'slug' => 'admin.setting.custom',
                'description' => '后台功能定制',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '26',
                'name' => '后台附件设置',
                'slug' => 'admin.setting.attach',
                'description' => '后台附件设置',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '27',
                'name' => '后台系统工具',
                'slug' => 'admin.system.index',
                'description' => '后台系统工具',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '28',
                'name' => '后台xunSearch',
                'slug' => 'admin.setting.xunSearch',
                'description' => '后台xunSearch',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '29',
                'name' => '后台一键登录',
                'slug' => 'admin.setting.oauth',
                'description' => '后台一键登录',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '31',
                'name' => '后台极验证',
                'slug' => 'admin.setting.geetest',
                'description' => '后台极验证',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '32',
                'name' => '后台短信整合',
                'slug' => 'admin.setting.sms',
                'description' => '后台短信整合',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '33',
                'name' => '后台IP黑名单管理',
                'slug' => 'admin.banIp.index',
                'description' => '网站IP黑名单管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '35',
                'name' => '后台操作日志',
                'slug' => 'admin.operationLog.index',
                'description' => '后台操作日志',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
        ]);

        DB::table('permission_role')->insert([
            // 超级管理员权限
            [
                'id' => '1',
                'permission_id' => '1',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '2',
                'permission_id' => '2',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '3',
                'permission_id' => '3',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '4',
                'permission_id' => '4',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '5',
                'permission_id' => '5',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '6',
                'permission_id' => '6',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '7',
                'permission_id' => '7',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '8',
                'permission_id' => '8',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '9',
                'permission_id' => '9',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '10',
                'permission_id' => '10',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '11',
                'permission_id' => '11',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '12',
                'permission_id' => '12',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '13',
                'permission_id' => '13',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '14',
                'permission_id' => '14',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '15',
                'permission_id' => '15',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '16',
                'permission_id' => '16',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '17',
                'permission_id' => '17',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '18',
                'permission_id' => '18',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '19',
                'permission_id' => '19',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '20',
                'permission_id' => '20',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '21',
                'permission_id' => '21',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '22',
                'permission_id' => '22',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '23',
                'permission_id' => '23',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '24',
                'permission_id' => '24',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '25',
                'permission_id' => '25',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '26',
                'permission_id' => '26',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '27',
                'permission_id' => '27',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '28',
                'permission_id' => '28',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '29',
                'permission_id' => '29',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '30',
                'permission_id' => '30',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '31',
                'permission_id' => '31',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '32',
                'permission_id' => '32',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            // 管理员权限
            [
                'id' => '33',
                'permission_id' => '1',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '34',
                'permission_id' => '2',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '35',
                'permission_id' => '3',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '36',
                'permission_id' => '4',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '37',
                'permission_id' => '5',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '38',
                'permission_id' => '6',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '39',
                'permission_id' => '7',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '40',
                'permission_id' => '8',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '41',
                'permission_id' => '9',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '42',
                'permission_id' => '10',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '43',
                'permission_id' => '11',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '44',
                'permission_id' => '12',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '45',
                'permission_id' => '13',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '46',
                'permission_id' => '14',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '47',
                'permission_id' => '15',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '48',
                'permission_id' => '16',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '49',
                'permission_id' => '17',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            // 运营人员权限
            [
                'id' => '50',
                'permission_id' => '1',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '51',
                'permission_id' => '5',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '52',
                'permission_id' => '6',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '53',
                'permission_id' => '7',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '54',
                'permission_id' => '8',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '55',
                'permission_id' => '9',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '56',
                'permission_id' => '10',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '57',
                'permission_id' => '11',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '58',
                'permission_id' => '12',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '59',
                'permission_id' => '13',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '60',
                'permission_id' => '14',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '61',
                'permission_id' => '15',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            // 超级管理员权限
            [
                'id' => '62',
                'permission_id' => '33',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '63',
                'permission_id' => '34',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '64',
                'permission_id' => '35',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
        ]);

        // 权限表中新增后台草稿管理
        DB::table('permissions')->insert([
            [
                'id' => '36',
                'name' => '后台草稿管理',
                'slug' => 'admin.draft.index',
                'description' => '后台草稿管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ],
            [
                'id' => '37',
                'name' => '后台举报管理',
                'slug' => 'admin.report.index',
                'description' => '后台举报管理',
                'created_at' => '2016-02-16 17:57:51',
                'updated_at' => '2016-02-16 17:57:51'
            ]
        ]);

        // 添加超级管理员、管理员、运营人员草稿管理权限
        DB::table('permission_role')->insert([
            [
                'id' => '65',
                'permission_id' => '36',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '66',
                'permission_id' => '36',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '67',
                'permission_id' => '36',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '68',
                'permission_id' => '37',
                'role_id' => '1',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '69',
                'permission_id' => '37',
                'role_id' => '3',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ],
            [
                'id' => '70',
                'permission_id' => '37',
                'role_id' => '4',
                'created_at' => '2016-02-16 17:37:51',
                'updated_at' => '2016-04-16 17:57:51'
            ]
        ]);

    }
}
