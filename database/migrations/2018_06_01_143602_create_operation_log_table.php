<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户uid');
            $table->string('action',256)->default('')->comment('请求操作');
            $table->string('method',64)->default('')->comment('请求方法');
            $table->mediumText('data')->default('')->comment('操作内容');
            $table->string('ip',64)->default('')->comment('操作IP');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operation_log');
    }
}
