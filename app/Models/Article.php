<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use App\Models\Relations\MorphManyCommentsTrait;
use App\Models\Relations\MorphManyTagsTrait;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use BelongsToUserTrait,MorphManyTagsTrait,MorphManyCommentsTrait;
    protected $table = 'articles';
    protected $fillable = ['title', 'user_id', 'content','tags','summary','status'];


    /*获取相关文章*/
    public static function correlations($tagIds,$size=6)
    {
        $questions = self::whereHas('tags', function($query) use ($tagIds) {
            $query->whereIn('tag_id', $tagIds);
        })->orderBy('created_at','DESC')->take($size)->get();
        return $questions;
    }


    /*搜索*/
    public static function search($word,$size=16)
    {
        $list = self::where('title','like',"$word%")->paginate($size);
        return $list;
    }





    /*推荐文章*/
    public static function recommended()
    {
        $list = self::with('user')->where('status','>',0)->orderBy('supports','DESC')->orderBy('created_at','DESC')->paginate(20);
        return $list;
    }

    /*热门文章*/
    public static function hottest($pageSize=20)
    {
        $list = self::with('user')->where('status','>',0)->orderBy('views','DESC')->orderBy('collections','DESC')->orderBy('created_at','DESC')->paginate($pageSize);
        return $list;

    }


    /*最新问题*/
    public static function newest($pageSize=20)
    {
        $list = self::with('user')->where('status','>',0)->orderBy('created_at','DESC')->paginate($pageSize);
        return $list;
    }




}
