<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthenticationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authentications', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->primary();              //用户UID
            $table->string('real_name',64);
            $table->string('id_card',32);
            $table->string('id_card_image',128);
            $table->string('skill',128);
            $table->string('skill_image',128);
            $table->string('failed_reason',256)->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::drop('authentications');
    }
}
