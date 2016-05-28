<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 16/5/27
 * Time: 上午11:24
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ToolController extends AdminController
{

    /*清空缓存*/
    public function clearCache(Request $request)
    {
        if($request->isMethod('post')){
            $cacheItems = $request->input('cacheItems');

            if(isset($cacheItems['data'])){
                Artisan::call('cache:clear');
            }

            if(isset($cacheItems['view'])){
                Artisan::call('view:clear');
            }

            return $this->success(route('admin.tool.clearCache'),'缓存更新成功');

        }
        return view('admin.tool.clearCache');

    }

}