<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*创建分类表*/
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("parent_id")->default(0);
            $table->integer("grade")->default(1);
            $table->string("name");
            $table->string("icon")->nullable();
            $table->string("slug",128)->unique();
            $table->string("type",64);
            $table->integer("sort")->default(0);
            $table->string("role_id",64)->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();
        });

        /*问题表、文章表加入分类ID字段*/
        Schema::table('questions', function (Blueprint $table) {
            $table->integer("category_id")->default(0)->after('user_id')->index();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->integer("category_id")->after('user_id')->default(0)->index();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->integer("category_id")->after('name')->default(0)->index();
        });

        Schema::table('authentications', function (Blueprint $table) {
            $table->integer("category_id")->after('user_id')->default(0)->index();
        });

        /*插入默认分类*/
        DB::table('categories')->insert([
            ['id' => '1','name' => '默认分类','slug'=>'default','parent_id' =>'0','grade'=>'1','sort' =>'0','status'=>'1','type'=>'questions,articles,tags,experts','created_at' => '2016-09-29 18:25:54','updated_at' => '2016-09-29 18:28:05'],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*删除文章表*/
        Schema::drop('categories');

        /*问题表、文章表加入分类ID字段*/
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn(['category_id']);
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['category_id']);
        });
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn(['category_id']);
        });
        Schema::table('authentications', function (Blueprint $table) {
            $table->dropColumn(['category_id']);
        });

    }
}
