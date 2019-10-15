<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2018/5/15
 * Time: 下午2:47
 */

namespace App\Policies\Traits;


trait AdminTrait
{

    public function before($user)
    {
        if($user->hasPermission('admin.index.index')){
            return true;
        }
    }

}