<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUserTagTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('tag_id')->unsigned()->index();
            $table->integer('questions')->unsigned()->default(0);
            $table->integer('articles')->unsigned()->default(0);
            $table->integer('answers')->unsigned()->default(0);
            $table->integer('supports')->unsigned()->default(0);
            $table->integer('adoptions')->unsigned()->default(0);
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
        Schema::drop('user_tags');
    }

}
