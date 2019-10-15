<?php

namespace App\Models;

use App\Models\Relations\BelongsToCategoryTrait;
use App\Models\Relations\BelongsToUserTrait;
use App\Models\Relations\MorphManyCommentsTrait;
use App\Models\Relations\MorphManyTagsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Article extends Model
{
    use BelongsToUserTrait,MorphManyTagsTrait,MorphManyCommentsTrait,BelongsToCategoryTrait;
    protected $table = 'articles';
    protected $fillable = ['title', 'user_id','category_id', 'content','tags','summary','status','logo'];


    public static function boot()
    {
        parent::boot();

        /*监听创建*/
        static::creating(function($article){
            /*开启状态检查*/
            if(Setting()->get('verify_article')==1){
                $article->status = 0;
            }
            if( trim($article->summary) === '' ){
                $article->summary = str_limit(strip_tags($article->content),180);
            }

        });

        static::saved(function($article){

            if(Setting()->get('xunsearch_open',0) == 1){
                App::offsetGet('search')->update($article);
            }
        });
        /*监听删除事件*/
        static::deleting(function($article){

            /*用户文章数 -1 */
            $article->user->userData()->where("articles",">",0)->decrement('articles');

            Collection::where('source_type','=',get_class($article))->where('source_id','=',$article->id)->delete();

            /*删除回答评论*/
            Comment::where('source_type','=',get_class($article))->where('source_id','=',$article->id)->delete();
            /*删除动态*/
            Doing::where('source_type','=',get_class($article))->where('source_id','=',$article->id)->delete();


        });

        static::deleted(function($article){
            if(Setting()->get('xunsearch_open',0) == 1){
                App::offsetGet('search')->delete($article);
            }
        });
    }

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
    public static function recommended($categoryId=0 , $pageSize=20)
    {
        $query = self::query();
        $category = Category::findFromCache($categoryId);
        if( $category ){
            $query->whereIn('category_id',$category->getSubIds());
        }

        $list = $query->where('status','>',0)->orderBy('supports','DESC')->orderBy('created_at','DESC')->paginate($pageSize);
        return $list;
    }

    /*热门文章*/
    public static function hottest($categoryId=0 , $pageSize=20)
    {
        $query = self::query();
        $category = Category::findFromCache($categoryId);
        if( $category ){
            $query->whereIn('category_id',$category->getSubIds());
        }
        if(Setting()->get('hot_content_period',365)){
            $query->where('created_at', ">" , Carbon::now()->subDays(Setting()->get('hot_content_period',365)));
        }
        $list = $query->where('status','>',0)->orderBy('views','DESC')->orderBy('collections','DESC')->orderBy('created_at','DESC')->paginate($pageSize);
        return $list;

    }


    /*最新问题*/
    public static function newest($categoryId=0 , $pageSize=20)
    {
        $query = self::query();
        $category = Category::findFromCache($categoryId);
        if( $category ){
            $query->whereIn('category_id',$category->getSubIds());
        }
        $list = $query->where('status','>',0)->orderBy('created_at','DESC')->paginate($pageSize);
        return $list;
    }




}
