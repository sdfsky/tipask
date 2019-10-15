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

        });

        /*监听删除事件*/
        static::deleting(function($category){
            $category->questions()->update(['category_id'=>0]);
            $category->articles()->update(['category_id'=>0]);
            $category->tags()->update(['category_id'=>0]);
            $category->experts()->update(['category_id'=>0]);
            Category::destroy($category->getSubIds(false));
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


    /**
     * 生成select下拉选择框
     * @param $categories
     * @param int $parentId
     * @param int $depth
     * @return string
     */
    public static function makeOptionTree($categories,$selectId=0, $parentId=0, $depth = 0){
        $childTree = '';
        foreach ($categories as $category) {
            if ( $parentId == $category->parent_id ) {
                if($category->id == $selectId){
                    $childTree .= "<option value=\"{$category->id}\" selected>";
                }else{
                    $childTree .= "<option value=\"{$category->id}\">";
                }
                $depthStr = str_repeat("--", $depth);
                $childTree .= $depth ? "&nbsp;&nbsp;|{$depthStr}&nbsp;{$category->name}</option>" : "{$category->name}</option>";
                $childTree .= self::makeOptionTree($categories,$selectId, $category->id, $depth + 1);
            }
        }
        return $childTree;
    }


    public static function getSubCategoryIds($parentId=0){
        $ids = '';
        $categories  =  self::loadFromCache('all');
        foreach ($categories as $category) {
            if ( $parentId == $category->parent_id ) {
                $ids .= $category->id.' ';
                $ids .= self::getSubCategoryIds($category->id);
            }
        }

        return $ids;

    }


    /*获取分类子分类ID*/
    public function getSubIds($wrap=true){
       $ids = self::getSubCategoryIds($this->id);
       $subIds = trim($ids);
       if($wrap){
            $subIds = $this->id.' '.$subIds;
       }
       $subCategoryIds =  explode(" ",$subIds);
       $subCategoryIds =array_filter($subCategoryIds);
       sort($subCategoryIds);
       return $subCategoryIds;
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

    /*查找摸一个分类信息*/
    public static function findFromCache($categoryId){
        $categories = self::loadFromCache('all');
        foreach($categories as $category){
            if($categoryId == $category->id){
                return  $category;
            }
        }
        return false;
    }


    /**生成树状结构
     * @param $categories
     * @param int $parentId
     * @return array
     */
    public static function makeTree($categories,$parentId=0){
        $tree = [];
        foreach ($categories as $category) {
            if ( $parentId == $category->parent_id ) {
                $category->_child = self::makeTree($categories,$category->id);
                $tree[] = $category;
            }
        }
        return $tree;
    }





    /**
     * 获取参数的所有父级分类
     * @param int $cid 分类id
     * @return array 参数分类和父类的信息集合
     * @author huajie <banhuajie@163.com>
     */
    public  static function getParentCategories($categoryId){
        if(!$categoryId){
            return [];
        }
        $allCategories  =  self::loadFromCache('all');
        $category  =   self::findFromCache($categoryId);
        $parentId    =   $category->parent_id;
        $parentCategories[]  =   $category;
        while(true){
            foreach ($allCategories as $key => $value){
                if($value->id == $parentId){
                    $parentId = $value->parent_id;
                    array_unshift($parentCategories, $value);	//将父分类插入到数组第一个元素前
                }
            }
            if($parentId == 0){
                break;
            }
        }
        return $parentCategories;
    }


    /*判断是否有子分类*/
    public function hasChild(){
        $categories = self::loadFromCache('all');
        foreach($categories as $category){
            if($category->parent_id == $this->id){
                return true;
            }
        }
        return false;
    }


    /*获取分类下的子分类*/
    public function getSubChild(){
        $categories = self::loadFromCache('all');
        $children = [];
        foreach($categories as $category){
            if($category->parent_id == $this->id){
                $children[] = $category;
            }
        }
        return $children;
    }

}
