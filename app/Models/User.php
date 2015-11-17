<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    HasRoleAndPermissionContract
{
    use Authenticatable, CanResetPassword,HasRoleAndPermission;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static function getAvatarPath($userId,$size='big',$ext='jpg')
    {
        $avatarDir = self::getAvatarDir($userId);
        $avatarFileName = self::getAvatarFileName($userId,$size);
        return $avatarDir.'/'.$avatarFileName.'.'.$ext;
    }

    /**
     * 获取用户头像存储目录
     * @param $user_id
     * @return string
     */
    public static function getAvatarDir($userId,$rootPath='avatars')
    {
        $userId = sprintf("%09d", $userId);
        return $rootPath.'/'.substr($userId, 0, 3) . '/' . substr($userId, 3, 2) . '/' . substr($userId, 5, 2);
    }


    /**
     * 获取头像文件命名
     * @param string $size
     * @return mixed
     */
    public static function getAvatarFileName($userId,$size='big')
    {
        $avatarNames = [
            'small'=>'user_small_'.$userId,
            'middle'=>'user_middle_'.$userId,
            'big'=>'user_big_'.$userId,
            'origin'=>'user_origin_'.$userId
        ];
       return $avatarNames[$size];
    }


    /**
     * 从缓存中获取用户数据，主要用户问答文章等用户数据显示
     * @param $userId
     * @return mixed
     */
    public static function findFromCache($userId){

        $data = Cache::remember('user_cache_'.$userId,Config::get('tipask.user_cache_time'),function() use($userId) {
            return  self::select('name','title','gender')->find($userId);
        });

        return $data;
    }


    /**
     *获取用户数据
     * @param $userId
     */
    public function userData(){
        return $this->hasOne('App\Models\UserData');
    }

    /**
     * 获取用户问题
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(){
        return $this->hasMany('App\Models\Question');
    }

    /**
     * 获取用户回答
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers(){
        return $this->hasMany('App\Models\Answer');
    }












}
