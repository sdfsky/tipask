<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use BelongsToUserTrait;
    protected $table = 'comments';
    protected $fillable = ['user_id', 'content','source_id','source_type','to_user_id','supports','status'];


    public static function boot()
    {
        parent::boot();

        /*监听创建*/
        static::creating(function($comment){
            /*开启状态检查*/
            if(Setting()->get('verify_comment')==1){
                $comment->status = 0;
            }
        });

        /*监听删除事件*/
        static::deleting(function($comment){
            /*问题、回答、文章评论数 -1*/
            $comment->source()->where("comments",">",0)->decrement('comments');
        });
    }

    public function source()
    {
        return $this->morphTo();
    }


    public function toUser(){
        return $this->belongsTo('App\Models\User','to_user_id');
    }


}
