<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 15/12/16
 * Time: 下午6:26
 */

namespace App\Models\Relations;


trait BelongsToUserTrait
{
    /**
     * Get the user relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the user relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userData()
    {
        return $this->belongsTo('App\Models\UserData','user_id');
    }
}