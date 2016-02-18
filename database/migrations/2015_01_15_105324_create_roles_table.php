<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->integer('level')->default(1);
            $table->timestamps();
        });

        /*插入初始化数据*/
        $this->initData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }



    private function initData()
    {

        $roles = [
            ['id'=>1,'name'=>'超级管理员','slug'=>'admin','description'=>'超级管理员，具有最高权限','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>2,'name'=>'普通会员','slug'=>'member','description'=>'普通会员，不可管理后台','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ];

        DB::table('roles')->insert($roles);

    }

}
