<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drafts', function (Blueprint $table) {
            $table->string('id',64)->primary();
            $table->integer('user_id')->unsigned()->index();
            $table->longText('editor_content')->comment('编辑器内容');
            $table->string('subject')->nullable()->comment('主题');
            $table->text('form_data')->nullable()->comment('表单其他参数');
            $table->string('source_type',32)->comment('数据类型：question,answer,article');
            $table->integer('source_id')->default(0);
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
        Schema::drop('drafts');
    }
}
