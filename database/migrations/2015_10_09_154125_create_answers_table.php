<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {

            $table->increments('id');                             //回答ID

            $table->string('question_title',255);                 //问题标题

            $table->integer('question_id')->index();              //问题ID

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

            $table->integer('user_id')->index();                  //回答发起人UID

            $table->text('content');                              //回答内容

            $table->integer('supports')->default(0);              //支持数

            $table->integer('oppositions')->default(0);           //反对数

            $table->integer('comments')->default(0);              //评论数

            $table->tinyInteger('device')->default(1);            //回答设备类型1pc,2安卓,3IOS,4wap

            $table->tinyInteger('status')->default(0);            //回答状态0待审核,1已审核

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
        Schema::drop('answers');
    }
}
