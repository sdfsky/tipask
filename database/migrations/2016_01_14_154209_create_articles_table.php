<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('user_id')->unsigned()->index();                  //文章发起人


            $table->string('title',255);                          //文章标题

            $table->string('summary',255);                        //导读、摘要

            $table->text('content');                         //文章内容

            $table->integer('views')->unsigned()->default(0);                 //查看数

            $table->integer('collections')->unsigned()->default(0);           //收藏数

            $table->integer('comments')->unsigned()->default(0);              //评论数

            $table->integer('supports')->unsigned()->default(0);              //支持数、推荐数目


            $table->tinyInteger('status')->default(0);                        //状态0待审核,1已审核

            $table->tinyInteger('device')->default(1);            //提问设备类型1pc,2安卓,3IOS,4weixin

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
