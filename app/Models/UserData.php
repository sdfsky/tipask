<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class UserData extends Model
{
    use BelongsToUserTrait;
    protected $table = 'user_data';

    public $timestamps = false;
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'coins',
        'credits',
        'authentication_status',
        'last_login_ip',
        'registered_at',
        'mobile_status',
        'last_visit'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];


    /*文章活跃用户*/
    public static function activeInArticles($size = 8)
    {

        $list = Cache::remember('active_in_articles', 10, function () use ($size) {
            return self::leftJoin('users', 'users.id', '=', 'user_data.user_id')
                ->where('users.status', '>', 0)->where('user_data.articles', '>', 0)
                ->orderBy('user_data.articles', 'DESC')
                ->orderBy('users.created_at', 'DESC')
                ->select('users.id', 'users.name', 'users.title', 'user_data.coins', 'user_data.credits',
                    'user_data.followers', 'user_data.supports', 'user_data.answers', 'user_data.articles',
                    'user_data.authentication_status')
                ->take($size)->get();
        });

        return $list;
    }


    /*活跃用户*/
    public static function activities($size)
    {
        return self::leftJoin('users', 'users.id', '=', 'user_data.user_id')
            ->where('users.status', '>', 0)
            ->orderBy('user_data.answers', 'DESC')
            ->orderBy('user_data.articles', 'DESC')
            ->orderBy('users.updated_at', 'DESC')
            ->select('users.id', 'users.name', 'users.title', 'user_data.coins', 'user_data.credits',
                'user_data.followers', 'user_data.supports', 'user_data.answers', 'user_data.articles',
                'user_data.authentication_status')
            ->take($size)->get();
    }

    /*财富榜*/

    public static function topCoins($size)
    {
        return self::leftJoin('users', 'users.id', '=', 'user_data.user_id')
            ->where('users.status', '>', 0)->where('user_data.articles', '>', 0)
            ->orderBy('user_data.coins', 'DESC')
            ->select('users.id', 'users.name', 'users.title', 'user_data.coins', 'user_data.credits',
                'user_data.followers', 'user_data.supports', 'user_data.answers', 'user_data.articles',
                'user_data.authentication_status')
            ->take($size)->get();
    }


    /*排行榜*/
    public static function top($type, $size)
    {
        return self::leftJoin('users', 'users.id', '=', 'user_data.user_id')
            ->where('users.status', '>', 0)
            ->orderBy('user_data.' . $type, 'DESC')
            ->orderBy('user_data.last_visit', 'DESC')
            ->select('users.id', 'users.name', 'users.title', 'user_data.coins', 'user_data.credits',
                'user_data.followers', 'user_data.supports', 'user_data.answers', 'user_data.articles',
                'user_data.authentication_status')
            ->take($size)->get();
    }

    /*用户采纳率*/
    public function adoptPercent()
    {
        return round($this->adoptions / $this->answers, 2) * 100;
    }

    public static function hottest($size = 20)
    {
        return self::where("status", ">", 0)->leftJoin("users", function ($join) {
            $join->on("users.id", '=', "user_data.user_id")
                ->where("users.status", ">", 0);
        })->orderBy('answers', 'desc')->orderBy('credits', 'desc')->take($size)->get();
    }


}
