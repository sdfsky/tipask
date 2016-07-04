<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 16/7/4
 * Time: 上午11:57
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SystemController extends AdminController
{

    public function upgrade(Request $request)
    {
        /*执行升级操作*/
        if($request->query('act','') === 'do'){
            try{
                Artisan::call('migrate');
            }catch(\Exception $e) {
                return $this->error(route('admin.system.upgrade'),'数据库连接出错：'.$e->getMessage());
            }
            return $this->success(route('admin.system.upgrade'),'升级脚本执行成功！');

        }

        return view('admin.system.upgrade');

    }

}