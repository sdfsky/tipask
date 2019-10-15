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
    public static function multiIncrement($user_id,$tags,$field=false){
        if(!$tags){
            return false;
        }
        foreach( $tags as $tag ){
            $userTag = self::firstOrCreate([
                'user_id'=> $user_id,
                'tag_id' => $tag->id
            ]);

            if($field){
                $userTag->increment($field);
            }
        }
    }


    /*初始化统计用户标签数据*/
    public static function figures(){
        $tags = Tag::all();
        $users = User::where('status','>',0)->get();
        $users->map(function($user) use($tags) {
            $tags->map(function($tag) use($user){
                $articleNum = $tag->articles()->where("user_id","=",$user->id)->count();
                $questions = $tag->questions()->where('status','>',0)->get();
                $questionNum = $answerNum = $supportNum = $adoptionNum = 0;
                foreach($questions as $question){
                    $questionNum++;
                    $answer = $question->answers()->where('user_id','=',$user->id)->first();
                    if($answer){
                        $answerNum++;
                        $supportNum += $answer->supports;
                        if( $answer->adopted_at ){
                            $adoptionNum++;
                        }
                    }
                }
                self::updateOrCreate([
                    'user_id'=>$user->id,
                    'tag_id'=>$tag->id
                ],
                [
                    'user_id'  => $user->id,
                    'tag_id'   => $tag->id,
                    'questions'=> $questionNum,
                    'articles' => $articleNum,
                    'answers'  => $answerNum,
                    'supports' => $supportNum,
                    'adoptions'=> $adoptionNum
                ]);
            });
        });

    }

}
