<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'supports';
    protected $fillable = ['session_id', 'user_id','supportable_id','supportable_type'];

}
