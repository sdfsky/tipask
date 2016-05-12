<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    use BelongsToUserTrait;
    protected $table = 'authentications';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id','real_name','id_card','id_card_image','skill','skill_image','status'];


}
