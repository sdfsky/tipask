<?php

/**
 * Created by PhpStorm.
 * User: nayo
 * Date: 2018/8/1
 * Time: 下午2:36
 */
namespace App\Models\Relations;

trait MorphManyReportTrait
{
    public function report(){
        return $this->morphMany('App\Models\Report','source');
    }
}