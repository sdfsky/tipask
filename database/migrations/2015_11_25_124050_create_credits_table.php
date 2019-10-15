<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->index();
            $table->char('action',16);
            $table->integer('source_id')->unsigned()->index();   //问题、回答或文字ID
            $table->string('source_subject',128)->nullable();    //问题标题或文字标题等
            $table->integer('coins')->default(0);
            $table->integer('credits')->default(0);
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
        Schema::drop('credits');
    }
}
