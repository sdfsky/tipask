<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use App\Models\Relations\MorphManyCommentsTrait;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use MorphManyCommentsTrait,BelongsToUserTrait;
    protected $table = 'answers';
    protected $fillable = ['question_title','question_id','user_id', 'content','status'];

    public static function boot()
    {
        parent::boot();

        /*监听创建*/
        static::creating(function($answer){
            /*开启状态检查*/
            if(Setting()->get('verify_answer')==1){
                $answer->status = 0;
            }

        });
        /*监听删除事件*/
        static::deleting(function($answer){

            /*问题回答数 -1 */
            $answer->question()->where('answers','>',0)->decrement('answers');

            /*用户回答数 -1 */
            $answer->user->userData()->where('answers','>',0)->decrement('answers');

            /*删除动态*/
            Doing::where('source_type','=',get_class($answer))->where('source_id','=',$answer->id)->delete();

            /*删除回答评论*/
            Comment::where('source_type','=',get_class($answer))->where('source_id','=',$answer->id)->delete();

        });
    }



    public function question(){
        return $this->belongsTo('App\Models\Question');
    }
}
