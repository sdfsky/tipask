<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use App\Models\Relations\MorphManyCommentsTrait;
use App\Models\Relations\MorphManyTagsTrait;
use Carbon\Carbon;
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




    /*热门问题*/
    public static function hottest()
    {
        $list = self::with('user')->where('status','>',0)->orderBy('views','DESC')->orderBy('answers','DESC')->orderBy('created_at','DESC')->paginate(20);
        return $list;

    }

    /*最新问题*/
    public static function newest()
    {
        $list = self::with('user')->where('status','>',0)->orderBy('created_at','DESC')->paginate(20);
        return $list;
    }

    /*未回答的*/
    public static function unAnswered()
    {
        $list = self::with('user')->where('status','>',0)->where('answers','=',0)->orderBy('created_at','DESC')->paginate(20);
        return $list;
    }

    /*悬赏问题*/
    public static function reward()
    {
        $list = self::with('user')->where('status','>',0)->where('price','>',0)->orderBy('created_at','DESC')->paginate(20);
        return $list;
    }

    /*最近热门问题*/
    public static function recent()
    {
        $list = Cache::remember('recent_questions',300, function() {
            return self::where('status','>',0)->where('created_at','>',Carbon::today()->subWeek())->orderBy('views','DESC')->orderBy('answers','DESC')->orderBy('created_at','DESC')->take(8)->get();
        });

        return $list;
    }


    /*问题搜索*/
    public static function search($word,$size=16)
    {
        $list = self::where('title','like',"$word%")->paginate($size);
        return $list;
    }





    /*问题所有回答*/
    public function answers()
    {
        return $this->hasMany('App\Models\Answer','question_id');
    }


}
