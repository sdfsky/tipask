<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAuthenticationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authentications', function (Blueprint $table) {
            $table->smallInteger('province')->nullable()->after('real_name')->index();//居住省份
            $table->smallInteger('city')->nullable()->after('province')->index();     //居住城市
            $table->string('title')->nullable()->after('province');                   //头衔
            $table->text('description')->nullable()->after('title');                  //个人简介
            $table->tinyInteger('gender')->nullable()->after('description');          //性别: 1-男，2-女，0-保密
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
            $table->dropColumn(['province','city','title','description','gender']);
        });
    }
}
