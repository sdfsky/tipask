<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Doing extends Model
{
    use BelongsToUserTrait;
    protected $table = 'doings';
    protected $fillable = ['user_id', 'action','source_type','source_id','subject','content','refer_id','refer_user_id','refer_content','created_at'];
    public $timestamps = false;

    public static function concerned(User $user)
    {
      $attentions = $user->attentions()->get();
      $tags = $questions = $users = [];

      foreach($attentions as $attention){
          if($attention->source_type == 'App\Models\Tag'){
                $tags[] = $attention->source_id;
          }elseif($attention->source_type == 'App\Models\User'){
                $users[] = $attention->source_id;
          }elseif($attention->source_type == 'App\Models\Question'){
                $questions[] = $attention->source_id;
          }
      }

      /*追加用户标签*/
      foreach( $user->tags()->get() as $tag ){
          $tags[] = $tag->id;
      }

      if($tags){
            $taggables = DB::table("taggables")->whereIn("tag_id",$tags)->get();
            foreach($taggables as $tagable){
                if($tagable->taggable_type == 'App\Models\Question'){
                    $questions[] = $tagable->taggable_id;
                }
            }
      }

      return self::where(function($query) use($users){
                     $query->whereIn("user_id",$users);
                 })
                 ->oRwhere(function($query) use($questions){
                     $query->whereIn("source_id",$questions)->where("source_type","=","App\Models\Question");

                 })
                 ->where('doings.user_id','<>',$user->id)
             //->where('attentions.created_at','<','doings.created_at')
             ->select('doings.*')
             ->orderBy('doings.created_at','DESC');
    }

   public static function newest(){
        return self::where("source_type","=","App\Models\Question")->orderBy('created_at','desc');
    }


}
