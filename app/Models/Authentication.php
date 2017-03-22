<?php

namespace App\Models;

use App\Models\Relations\BelongsToCategoryTrait;
use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    use BelongsToUserTrait,BelongsToCategoryTrait;
    protected $table = 'authentications';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id','real_name','province','city','gender','title','description','id_card','id_card_image','skill','skill_image','status','category_id'];

    public static function boot()
    {
        parent::boot();

        static::updating(function($authentication){
            $authentication->userData->update(['authentication_status'=>$authentication->status]);
        });
    }

    public function userData()
    {
        return $this->belongsTo('App\Models\UserData','user_id','user_id');
    }

    /*用户统计标签*/
    public function userTags(){
        return $this->hasMany('App\Models\UserTag','user_id','user_id');
    }

    public function hotTags(){
        $hotTagIds = $this->userTags()->select("tag_id")->distinct()->orderBy('supports','desc')->orderBy('answers','desc')->orderBy('created_at','desc')->take(5)->lists('tag_id');
        $tags = [];
        foreach($hotTagIds as $hotTagId){
            $tag = Tag::find($hotTagId);
            if($tag){
                $tags[] = $tag;
            }

        }
        return $tags;
    }

    /*推荐行家*/
    public static function hottest($size)
    {
        return  self::leftJoin('user_data', 'user_data.user_id', '=', 'authentications.user_id')
            ->where('user_data.authentication_status','=',1)
            ->orderBy('user_data.answers','DESC')
            ->orderBy('user_data.articles','DESC')
            ->orderBy('authentications.updated_at','DESC')
            ->select('authentications.user_id','authentications.real_name','authentications.title','user_data.coins','user_data.credits','user_data.followers','user_data.supports','user_data.answers','user_data.articles','user_data.authentication_status')
            ->take($size)->get();
    }
}
