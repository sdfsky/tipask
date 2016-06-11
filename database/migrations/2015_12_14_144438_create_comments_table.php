<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->index();      //评论人
            $table->text('content');
            $table->morphs('source');
            $table->integer('to_user_id')->unsigned()->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::drop('comments');
    }
}
