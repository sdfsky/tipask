<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Taggable extends Model
{
    protected $table = 'taggables';

    protected $fillable = ['source_type', 'source_id', 'tag_id'];


    public static function hottest($pageSize=20)
    {

       $taggables =  DB::table('taggables')->select('tag_id',DB::raw('COUNT(id) as total_num'))
            ->groupBy('tag_id')
            ->orderBy('total_num','desc')
            ->paginate($pageSize);
        return $taggables;

    }

    /*全局热门标签*/
    public static function globalHotTags()
    {
        return Cache::remember('hot_tags',10,function(){
            $tags = self::hottest(25);
            $tags->map(function($tag){
                $tagInfo = Tag::find($tag->tag_id);
                $tag->name = $tagInfo->name;
            });
            return $tags;
        });
    }

}
