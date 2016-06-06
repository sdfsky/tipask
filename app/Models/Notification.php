<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use BelongsToUserTrait;
    protected $table = 'notifications';
    protected $fillable = ['user_id', 'to_user_id','type','subject','source_id','content','refer_type','refer_id'];


    public function toUser()
    {
        return $this->belongsTo('App\Models\User','to_user_id');
    }

}
