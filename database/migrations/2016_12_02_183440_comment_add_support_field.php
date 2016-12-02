<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CommentAddSupportField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*问题表、文章表加入分类ID字段*/
        Schema::table('comments', function (Blueprint $table) {
            $table->integer("supports")->default(0)->after('status');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*问题表、文章表加入分类ID字段*/
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn(['supports']);
        });

    }
}
