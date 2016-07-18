<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Area extends Model
{
    protected $table = 'areas';
    protected $fillable = ['name', 'parent_id', 'grade'];


    /**
     *从缓存中加载所有数据
     * @return mixed
     */
    public static function loadFromCache(){
        $areas = Cache::rememberForever('all_area_data', function() {
            return DB::table('areas')->orderBy('id','ASC')->get();
        });
        return $areas;
    }

    /**
     * 获取所有省份信息
     * @return mixed 省份信息
     */
    public static function provinces()
    {
        $provinces = [];
        foreach(self::loadFromCache() as $area){
            if($area->parent_id == 0){
                array_push($provinces,$area);
            }
        }
        return $provinces;
    }

    /**
     * 获取省份所有城市信息
     * @param $province_id
     * @return mixed 城市信息
     */
    public static function cities($province_id)
    {
        $cities = [];
        foreach(self::loadFromCache() as $area){
            if($area->parent_id == $province_id){
                array_push($cities,$area);
            }
        }
        return $cities;
    }


    public static function getName($id)
    {
        foreach(self::loadFromCache() as $area){
            if($area->id == $id){
               return $area->name;
            }
        }
        return '';
    }



}
