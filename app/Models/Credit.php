<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use BelongsToUserTrait;
    protected $table = 'credits';
    protected $fillable = ['user_id', 'action','coins','credits','source_id','source_subject','created_at'];
    public $timestamps = false;
}
