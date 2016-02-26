<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name', 'logo', 'description'];


    /**通过字符串添加标签
     * @param $tagString
     * @param $question_id
     */
    public static function multiSave($tagString,$taggable)
    {
        $tags = array_unique(explode(" ",$tagString));

        /*删除所有标签关联*/
        if($tags){
            $taggable->tags()->detach();
        }

        foreach($tags as $tag_name){

            if(!trim($tag_name)){
                continue;
            }

            $tag = self::firstOrCreate(['name'=>$tag_name]);

            if(!$taggable->tags->contains($tag->id))
            {
                $taggable->tags()->attach($tag->id);
            }

        }
        return $tags;
    }


    /*搜索*/
    public static function search($word,$size=16)
    {
        $list = self::where('name','like',"$word%")->paginate($size);
        return $list;
    }



    public function questions()
    {
        return $this->morphedByMany('App\Models\Question', 'taggable');
    }


    public function articles()
    {
        return $this->morphedByMany('App\Models\Article', 'taggable');
    }



    public function followers()
    {
        return $this->morphToMany('App\Models\UserData', 'source','attentions','source_id','user_id');
    }





    /*相关标签检索*/
    public function relations($pageSize=25)
    {
        return self::where(function($query){
                        $query->where('parent_id','=',$this->parent_id)
                              ->where('id','<>',$this->id);
                      })->orWhere('parent_id','=',$this->parent_id)
                        ->orderBy('followers','desc')->take($pageSize)->get();
    }


}
