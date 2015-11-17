<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['title', 'user_id', 'description','tags','price','hide'];


    /*问题所有回答*/
    public function answers()
    {
        return $this->hasMany('App\Models\Answer','question_id');
    }


    /*用户*/
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }


    /*问题标签*/
    public function tags()
    {
        return array_unique(explode(" ",$this->tags));
    }







}
