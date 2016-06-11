<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('to_user_id')->unsigned()->default(0)->index();
            $table->char('type',32);
            $table->integer('source_id')->unsigned()->index();
            $table->string('subject',128)->nullable();
            $table->text('content')->nullable();
            $table->integer('refer_id')->unsigned()->default(0);
            $table->string('refer_type',64)->nullable();
            $table->tinyInteger('is_read')->default(0);
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
        Schema::drop('notifications');
    }
}
