<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    protected $primaryKey = 'name';
    protected $fillable = ['name', 'value'];
    public $timestamps = false;


    public static function loadAll()
    {
        $settings = self::all();
        print_r($settings);
    }


    /*查询某个配置信息*/
    public static function get($name)
    {
        $setting =  self::where('name','=',$name)->first();
        if($setting){
            return $setting->value;
        }
        return '';
    }


    public static function set($name , $value)
    {
        self::updateOrCreate(['name'=>$name],['value'=>$value]);
    }



    /*清空配置缓存*/
    public static function clearAll()
    {

    }

}
