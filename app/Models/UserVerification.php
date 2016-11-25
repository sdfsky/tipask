<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Auth\Passwords\DatabaseTokenRepository as Token;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class UserVerification extends Model
{

    use BelongsToUserTrait;

    protected $table = 'user_verifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','category_id', 'name','status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];



}
