<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterQuestionInvitationAddSendto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_invitations', function (Blueprint $table) {
            $table->string("send_to",255)->after('user_id')->nullable()->index();
        });

        Schema::table('question_invitations', function (Blueprint $table) {
            $table->integer("from_user_id",false,true)->after('id')->default(0)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_invitations', function (Blueprint $table) {
            $table->dropColumn(['send_to','from_user_id']);
        });
    }
}
