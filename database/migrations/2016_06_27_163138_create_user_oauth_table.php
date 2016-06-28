<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOauthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_oauth', function (Blueprint $table) {
            $table->string("id",64)->primary();
            $table->integer('user_id')->index()->default(0);              //用户UID
            $table->char("auth_type",64);
            $table->string("access_token",64);
            $table->string("refresh_token",64);
            $table->integer("expires_in");
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
        Schema::drop('user_oauth');
    }
}
