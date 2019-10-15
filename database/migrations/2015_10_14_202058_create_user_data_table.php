<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {

            $table->integer('user_id')->unsigned()->primary();              //用户UID
            $table->integer('coins')->unsigned()->default(0);               //金币数
            $table->integer('credits')->unsigned()->default(0);             //经验值

            $table->timestamp('registered_at')->nullable();      //注册时间
            $table->timestamp('last_visit')->nullable();        //上次访问时间
            $table->string('last_login_ip')->nullable();        //上次登录IP

            $table->integer('questions')->unsigned()->default(0);           //提问数
            $table->integer('articles')->unsigned()->default(0);            //文章数
            $table->integer('answers')->unsigned()->default(0);             //回答数
            $table->integer('adoptions')->unsigned()->default(0);           //被采纳个数
            $table->integer('supports')->unsigned()->default(0);            //赞同数
            $table->integer('followers')->unsigned()->default(0);           //关注数
            $table->integer('views')->unsigned()->default(0);
            $table->unsignedTinyInteger('email_status')->default(0);
            $table->unsignedTinyInteger('mobile_status')->default(0);
            $table->unsignedTinyInteger('authentication_status')->default(0); //行家认证状态


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_data');
    }
}
