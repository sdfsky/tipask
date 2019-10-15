<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * 数据库初始化
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
