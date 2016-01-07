<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use App\Models\Relations\MorphManyCommentsTrait;
use App\Models\Relations\MorphManyTagsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    use BelongsToUserTrait,MorphManyCommentsTrait,MorphManyTagsTrait;
    protected $table = 'questions';
    protected $fillable = ['title', 'user_id', 'description','tags','price','hide','status'];

    /*获取相关问题*/
    public static function correlations($tagIds,$size=6)
    {
        $questions = self::whereHas('tags', function($query) use ($tagIds) {
            $query->whereIn('tag_id', $tagIds);
        })->orderBy('created_at','DESC')->take($size)->get();
        return $questions;
    }

    /*问题所有回答*/
    public function answers()
    {
        return $this->hasMany('App\Models\Answer','question_id');
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
