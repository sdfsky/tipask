<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

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


    /**
     * 设置env配置文件
     * @param $params
     */
    public static function setEnvParams($params){
        if(!$params){
            return false;
        }
        $envPath = app()->environmentFilePath();
        $envString = file_get_contents($envPath);
        foreach ($params as $key => $value){
            $envKey = strtoupper($key);
            $oldValue = env($envKey,null);
            $keyString = "{$envKey}=";
            $oldEnvString = "{$key}={$oldValue}";
            if(str_contains($oldValue,' ')){
                $oldEnvString = "{$envKey}='$oldValue'";
            }
            $newEnvString = "{$envKey}=$value";
            if(str_contains($value,' ')){
                $newEnvString = "{$envKey}='$value'";
            }
            if(str_contains($envString,$keyString)){
                $envString = str_replace($oldEnvString,$newEnvString,$envString);
            }else{
                $envString .= $newEnvString."\n";
            }
        }
        file_put_contents($envPath,$envString);
        return true;
    }

}
