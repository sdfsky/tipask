<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class UserData extends Model
{
    protected $table = 'user_data';

    public $timestamps = false;
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'coins','credits','last_login_ip','registered_at','last_visit'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];


    /*文章活跃用户*/
    public static function activeInArticles($size=8)
    {

        $list = Cache::remember('active_in_articles',10,function() use($size) {
            return  self::leftJoin('users', 'users.id', '=', 'user_data.user_id')
                          ->where('users.status','>',0)->where('user_data.articles','>',0)
                          ->orderBy('user_data.articles','DESC')
                          ->orderBy('users.created_at','DESC')
                          ->select('users.id','users.name','users.title','user_data.articles','user_data.supports')
                          ->take($size)->get();
        });

        return  $list;
    }



    public static function activities($size)
    {
        return  self::leftJoin('users', 'users.id', '=', 'user_data.user_id')
            ->where('users.status','>',0)->where('user_data.articles','>',0)
            ->orderBy('user_data.answers','DESC')
            ->orderBy('user_data.articles','DESC')
            ->orderBy('users.updated_at','DESC')
            ->select('users.id','users.name','users.title')
            ->take($size)->get();
    }




    /*用户采纳率*/
    public function adoptPercent()
    {
        return round($this->adoptions / $this->answers, 2) * 100;
    }











}
