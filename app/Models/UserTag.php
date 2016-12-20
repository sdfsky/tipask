<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserTag extends Model
{
    use BelongsToUserTrait;
    protected $table = 'user_tags';
    protected $fillable = ['user_id', 'tag_id','questions','articles','answers','supports'];
    

    /*用户标签统计*/
    public static function multiIncrement($user_id,$tags,$field){
        if(!$tags){
            return false;
        }
        foreach( $tags as $tag ){
            $userTag = self::where("user_id","=",$user_id)->where("tag_id","=",$tag->id)->first();
            if(!$userTag){
              $userTag =   self::create([
                    'user_id'=> $user_id,
                    'tag_id' => $tag->id
                ]);
            }

            $userTag->increment($field);
        }
    }

}
