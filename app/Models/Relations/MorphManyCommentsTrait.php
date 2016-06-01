<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 15/12/17
 * Time: 下午3:24
 */

namespace App\Models\Relations;


trait MorphManyCommentsTrait
{
    /**
     * Get the comments relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment','source');
    }
}