<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model {

	protected $table='menus';
    protected $fillable = ['name', 'slug', 'pid','icon','url'];

    public function getAllTree(){
        /* 获取所有分类 */
        $list = DB::table('menus')->orderby('sort','asc')->orderby('name','asc')->get();
        $list = list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_', $root = $id);

        /* 获取返回数据 */
        if(isset($info)){ //指定分类则返回当前分类极其子分类
            $info['_'] = $list;
        } else { //否则返回所有分类
            $info = $list;
        }

        return $info;
    }

}
