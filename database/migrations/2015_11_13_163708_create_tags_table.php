<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id')->unsigned();             //标签ID
            $table->string('name','128')->unique();           //标签名称
            $table->string('logo','128')->nullable();         //标签图标
            $table->string('summary',255)->nullable();        //导读、摘要
            $table->text('description')->nullable();         //标签介绍
            $table->integer('parent_id')->unsigned()->index()->default(0); //父级ID
            $table->integer('followers')->unsigned()->index()->default(0); //关注数
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
        Schema::drop('tags');
    }
}
