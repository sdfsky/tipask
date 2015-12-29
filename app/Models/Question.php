<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use App\Models\Relations\MorphManyCommentsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    use BelongsToUserTrait,MorphManyCommentsTrait;
    protected $table = 'questions';
    protected $fillable = ['title', 'user_id', 'description','tags','price','hide','status'];

    /*获取相关问题*/
    public static function correlations($tagIds,$size=5)
    {
        return self::leftJoin('question_tag','questions.id','=','question_tag.question_id')->whereIn('question_tag.tag_id',$tagIds)->select('questions.*')->distinct()->take($size)->get();
    }

    /*问题所有回答*/
    public function answers()
    {
        return $this->hasMany('App\Models\Answer','question_id');
    }




    /*问题标签*/
    public function tags()
    {
        return array_unique(explode(" ",$this->tags));
    }


    /*热门问题*/
    public static function hots()
    {
        $data = Cache::remember('question_host_list',300,function() {
            return  self::where('status','=',0)->orderBy('views','DESC')->orderBy('created_at','DESC')->take(10)->get();
        });
        return $data;
    }










}
