<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $table = 'credits';
    protected $fillable = ['user_id', 'action','coins','credits','source_id','source_subject','created_at'];
    public $timestamps = false;
}
