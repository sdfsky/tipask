<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['title', 'user_id', 'description','tags','price','hide'];

   /*获取相关问题*/
    public static function correlations($tagIds,$size=5)
    {
        return DB::table('questions')->leftJoin('question_tag','questions.id','=','question_tag.question_id')->whereIn('question_tag.tag_id',$tagIds)->select('questions.*')->distinct()->take($size)->get();
    }

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
