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
      //  print_r($settings);
    }


    /*查询某个配置信息*/
    public static function get($name,$default='')
    {
        $setting =  self::where('name','=',$name)->first();
        if($setting){
            return $setting->value;
        }
        return $default;
    }


    public static function set($name , $value)
    {
        self::updateOrCreate(['name'=>$name],['value'=>$value]);
    }


    public static function writeToEnv(){
        $env_path = base_path('.env');
        $env_content = '';
        ksort($_ENV);
        foreach($_ENV as $key => $value ){
            $env_content .= $key.'='.$value."\n";
        }
        file_put_contents($env_path,$env_content);
    }



    /*清空配置缓存*/
    public static function clearAll()
    {

    }

}
