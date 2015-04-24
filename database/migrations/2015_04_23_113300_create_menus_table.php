<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->unsigned()->index();
            $table->integer('sort');
            $table->string('name')->index();
            $table->string('icon',100);
            $table->string('url');
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
		Schema::drop('menus');
	}

}
