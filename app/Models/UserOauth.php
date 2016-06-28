<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class UserOauth extends Model
{
    use BelongsToUserTrait;
    protected $table = 'user_oauth';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'access_token','refresh_token','expires_in'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];



    public function isBind($type){

        if($this->auth_type === $type ){
            return true;
        }
        return false;
    }



}
