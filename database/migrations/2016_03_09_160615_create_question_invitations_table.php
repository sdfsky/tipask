<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_invitations', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('user_id')->unsigned()->index();                  //问题发起人UID

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('question_id')->unsigned()->index();              //问题ID

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

            $table->tinyInteger('status')->default(0);            //回答状态0待审核,1已审核


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
        Schema::drop('question_invitations');
    }
}
