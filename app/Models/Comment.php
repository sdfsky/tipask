<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use BelongsToUserTrait;
    protected $table = 'comments';
    protected $fillable = ['user_id', 'content','source_id','source_type','to_user_id','status'];

    public function source()
    {
        return $this->morphTo();
    }


    public function toUser(){
        return $this->belongsTo('App\Models\User','to_user_id');
    }


}
