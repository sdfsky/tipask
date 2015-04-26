<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Menu extends Model {

	protected $table='menus';
    protected $fillable = ['name', 'slug', 'pid','icon','url'];



    public static function getTree(){

        Cache::forget('_menus');
        $menus =  Cache::rememberForever('_menus',function(){

             return Menu::all()->toArray();

         });
        $menuArray= array();
        foreach($menus as $menu){
            $menuArray[$menu['id']]= $menu;
        }
        return $menuArray;

    }

}
