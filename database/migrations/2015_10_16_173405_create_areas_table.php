<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id')->unsigned();                       //地区ID
            $table->string('name','64');                    //地区名称
            $table->smallInteger('parent_id')->default(0);  //父级ID
            $table->tinyInteger('grade');                   //当前级别
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('areas');
    }

}
