<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2016/11/10
 * Time: 下午4:15
 */

namespace App\Models\Relations;


trait BelongsToCategoryTrait
{

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

}