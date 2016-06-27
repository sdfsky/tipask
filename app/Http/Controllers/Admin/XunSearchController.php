<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 16/6/27
 * Time: 上午11:42
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Artisan;

class XunSearchController extends AdminController
{

    /*清空缓存*/
    public function clear(){
        set_time_limit(0);
       Artisan::call('search:clear');
        return $this->success(route('admin.setting.xunSearch'),'索引删除成功');

    }


    /*重建索引*/
    public function rebuild(){
        set_time_limit(0);
        Artisan::call('search:rebuild');
        return $this->success(route('admin.setting.xunSearch'),'索引重建成功，请3分钟后进行搜索测试！');
    }

}