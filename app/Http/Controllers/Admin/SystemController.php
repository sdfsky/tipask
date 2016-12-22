<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 16/7/4
 * Time: 上午11:57
 */

namespace App\Http\Controllers\Admin;

use App\Models\UserTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SystemController extends AdminController
{

    /*系统工具首页*/
    public function index(){
        return view('admin.system.index');
    }
    
    public function upgrade()
    {
        /*执行升级操作*/
        try{
            Artisan::call('migrate');
        }catch(\Exception $e) {
            return $this->error(route('admin.system.index'),'数据库连接出错：'.$e->getMessage());
        }
        return $this->success(route('admin.system.index'),'升级脚本执行成功！');

    }


    /*系统统计数据校准*/
    public function adjust(){
        set_time_limit(0);
        ignore_user_abort(true);

        UserTag::figures();

        return $this->success(route('admin.system.index'),'用户标签数据同步成功！');
    }

}