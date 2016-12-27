<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['parent_id','grade','name','slug','icon','status','sort','type','role_id','category_id'];


    public static function boot()
    {
        parent::boot();

        /*添加事件监听*/
        static::creating(function($category){
            $category->parent_id = 0 ;
            $category->grade = 1;
        });

        /*监听删除事件*/
        static::deleting(function($category){
            $category->questions()->update(['category_id'=>0]);
            $category->articles()->update(['category_id'=>0]);
            $category->tags()->update(['category_id'=>0]);
            $category->experts()->update(['category_id'=>0]);
        });
    }


    /**
     * 获取用户问题
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Models\Question','category_id');
    }


    /**
     * 获取用户问题
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article','category_id');
    }

    /**
     * 获取用户问题
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany('App\Models\Tag','category_id');
    }


    /**
     * 获取用户问题
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function experts()
    {
        return $this->hasMany('App\Models\Authentication','category_id');
    }


    public static function makeOptionTree($categories=null)
    {
        if(!$categories){
            $categories = self::loadFromCache('all');
        }

        $optionTree = '';
        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $optionTree .= "<option value=\"{$category->id}\">{$category->name}</option>";
                $optionTree .= self::makeChildOption($categories, $category->id, 1);
            }
        }
        return $optionTree;

    }


    public static function makeChildOption($categories, $parentId, $depth = 1){
        $childTree = '';
        foreach ($categories as $category) {
            if ( $parentId == $category->parent_id ) {
                $childTree .= "<option value=\"{$category->id}\">";
                $depthStr = str_repeat("--", $depth);
                $childTree .= $depth ? "&nbsp;&nbsp;|{$depthStr}&nbsp;{$category->name}</option>" : "{$category->name}</option>";
                $childTree .= self::makeChildOption($categories, $category->id, $depth + 1);
            }
        }
        return $childTree;
    }


    public static function loadFromCache($type='all'){

        $globalCategories = Cache::rememberForever('global_all_categories',function() {
            return self::where('status','>',0)->orderBy('sort','asc')->orderBy('created_at','asc')->get();
        });

        /*返回所有分类*/
        if($type == 'all'){
            return $globalCategories;
        }

        /*按类文档型返回分类*/
        $categories = [];
        foreach( $globalCategories as $category ){
            if( str_contains($category->type,$type) ){
                $categories[] = $category;
            }
        }
        return $categories;

    }

}
