<?php

namespace App\Models;

use App\Models\Relations\BelongsToCategoryTrait;
use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    use BelongsToUserTrait,BelongsToCategoryTrait;
    protected $table = 'authentications';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id','real_name','id_card','id_card_image','skill','skill_image','status','category_id'];

    public static function boot()
    {
        parent::boot();

        static::updating(function($authentication){
            $authentication->userData->update(['authentication_status'=>$authentication->status]);
        });
    }

    public function userData()
    {
        return $this->belongsTo('App\Models\UserData','user_id','user_id');
    }

}
