<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = array(
            array('icon' => 'menus-Ev9TFhka5d70aabc4fd1d.png','name' => '问答','url' => '/pages/question/index/index','sort' => '1','type' => '2','status' => '1','created_at' => '2019-09-05 14:27:08','updated_at' => '2019-09-05 14:27:08'),
            array('icon' => 'menus-heIkyFPb5d70aad381639.png','name' => '文章','url' => '/pages/article/index/index','sort' => '2','type' => '2','status' => '1','created_at' => '2019-09-05 14:27:31','updated_at' => '2019-09-05 14:27:31'),
            array('icon' => 'menus-BwoszGvV5d70aaef52e42.png','name' => '课堂','url' => '/pages/course/index/index','sort' => '3','type' => '2','status' => '1','created_at' => '2019-09-05 14:27:59','updated_at' => '2019-09-05 14:27:59'),
            array('icon' => 'menus-8uB448zU5d70ab0928707.png','name' => '商城','url' => '/pages/shop/index/index','sort' => '4','type' => '2','status' => '1','created_at' => '2019-09-05 14:28:25','updated_at' => '2019-09-05 14:28:25')
        );
        DB::table("menus")->insert($menus);
    }
}
