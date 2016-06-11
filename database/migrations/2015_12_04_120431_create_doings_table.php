<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->char('action',16);
            $table->morphs('source');
            $table->string('subject',128)->nullable();
            $table->string('content',256)->nullable();
            $table->integer('refer_id')->unsigned();
            $table->integer('refer_user_id')->unsigned();
            $table->string('refer_content',256)->nullable();
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
        Schema::drop('doings');
    }
}
