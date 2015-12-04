<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = ['question_title','question_id','user_id', 'content','status'];


    public function question(){
        return $this->belongsTo('App\Models\Question');
    }
}
