<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('举报人uid');
            $table->morphs('source');
            $table->string('subject',255)->default('')->comment('主题');
            $table->tinyInteger('report_type')->default(0)->comment('举报类型');
            $table->string('reason',255)->nullable()->comment('举报原因');
            $table->tinyInteger('status')->default(0)->comment('状态:0-未审核,1-已审核,4-忽略');
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
        Schema::dropIfExists('report');
    }
}
