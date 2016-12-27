<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attention extends Model
{
    protected $table = 'attentions';
    protected $fillable = ['user_id','source_id','source_type'];


    public static function store(){

    }



}
