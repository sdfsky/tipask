<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAuthenticationAddRecommend extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authentications', function (Blueprint $table) {
            $table->timestamp('recommend_at')->nullable()->comment('推荐时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('authentications', function (Blueprint $table) {
            $table->dropColumn(['recommend_at']);
        });
    }
}
