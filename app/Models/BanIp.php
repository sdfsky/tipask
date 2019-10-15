<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class BanIp extends Model
{
    use BelongsToUserTrait;
    protected $table = 'ban_ips';
    protected $fillable = ['user_id','ip','created_at'];
    public $timestamps = false;
}
