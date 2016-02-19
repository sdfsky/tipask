<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('name','128')->primary();       //设置名称
            $table->text('value')->nullable();             //设置备注
        });

        $this->initData();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }


    private function initData()
    {
        $settings = [
            ['name' => 'coins_adopted','value' => '0'],
            ['name' => 'coins_answer','value' => '0'],
            ['name' => 'coins_ask','value' => '0'],
            ['name' => 'coins_login','value' => '0'],
            ['name' => 'coins_register','value' => '20'],
            ['name' => 'credits_adopted','value' => '20'],
            ['name' => 'credits_answer','value' => '10'],
            ['name' => 'credits_ask','value' => '0'],
            ['name' => 'credits_login','value' => '10'],
            ['name' => 'credits_register','value' => '20'],
            ['name' => 'date_format','value' => 'Y-m-d'],
            ['name' => 'time_diff','value' => '0'],
            ['name' => 'time_format','value' => 'H:i'],
            ['name' => 'time_friendly','value' => '1'],
            ['name' => 'time_offset','value' => '8'],
            ['name' => 'website_admin_email','value' => 'admin@tipask.com'],
            ['name' => 'website_footer','value' => ''],
            ['name' => 'website_header','value' => ''],
            ['name' => 'website_icp','value' => '京ICP备13022057号'],
            ['name' => 'website_name','value' => 'Tipask问答网'],
            ['name' => 'website_url','value' => 'http://www.tipask.com'],
        ];

        DB::table('settings')->insert($settings);



    }
}
