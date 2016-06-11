<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {

            $table->increments('id')->unsigned();                             //问题ID

            $table->integer('user_id')->unsigned()->default(0)->index();                  //问题发起人UID

            $table->string('title',255)->index();                          //问题标题

            $table->text('description')->nullable();              //问题详情

            $table->smallInteger('price')->default(0);            //问题价格

            $table->tinyInteger('hide')->default(0);              //匿名提问

            $table->integer('answers')->unsigned()->default(0);               //回答数

            $table->integer('views')->unsigned()->default(0);                 //查看数

            $table->integer('followers')->unsigned()->default(0);           //关注数

            $table->integer('collections')->unsigned()->default(0);           //收藏数

            $table->integer('comments')->unsigned()->default(0);              //评论数

            $table->tinyInteger('device')->default(1);            //提问设备类型1pc,2安卓,3IOS,4weixin

            $table->tinyInteger('status')->default(0);            //提问状态0待审核,1已审核

            $table->timestamps();                                 //创建和更新时间

            $table->index('created_at');
            $table->index('updated_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
