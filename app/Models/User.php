<?php

namespace App\Models;
use App\Models\Relations\MorphManyTagsTrait;
use Carbon\Carbon;
use Illuminate\Auth\Passwords\CanResetPassword;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class User extends Authenticatable
{
    use CanResetPassword,MorphManyTagsTrait,Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $roles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email','mobile', 'password','status','site_notifications','email_notifications'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static function boot()
    {
        parent::boot();
        static::saved(function($user){
            if(Setting()->get('xunsearch_open',0) == 1) {
                App::offsetGet('search')->update($user);
            }
        });
        static::deleted(function($user){

            /*删除用户扩展信息*/
            $user->userData()->delete();
            $user->userOauth()->delete();
            $user->authentication()->delete();
            /*删除用户提问*/
            $user->questions()->delete();
            /*删除用户回答*/
            $user->answers()->delete();

            /*删除用户文章*/
            $user->articles()->delete();

            /*删除粉丝*/
            $user->followers()->delete();

            /*删除收藏*/
            $user->collections()->delete();

            /*删除积分设置*/
            $user->credits()->delete();

            /*删除我的通知*/
            $user->notifications()->delete();

            /*删除动态*/
            $user->doings()->delete();

            /*删除积分兑换*/
            $user->exchanges()->delete();

            /*删除统计标签*/
            $user->userTags()->delete();

            /*删除问题邀请*/
            $user->questionInvitations()->delete();
            /*删除评论*/
            $user->comments()->delete();

            /*删除角色管理*/
            $user->detachAllRoles();

            if(Setting()->get('xunsearch_open',0) == 1) {
                App::offsetGet('search')->delete($user);
            }
        });
    }
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
    public static function findFromCache($userId)
    {

        $data = Cache::remember('user_cache_'.$userId,Config::get('tipask.user_cache_time'),function() use($userId) {
            return  self::select('name','title','gender')->find($userId);
        });

        return $data;
    }

    /*搜索*/
    public static function search($word,$size=16)
    {
        $list = self::where('name','like',"$word%")->paginate($size);
        return $list;
    }


    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function getRoles()
    {
        return (!$this->roles) ? $this->roles = $this->roles()->get() : $this->roles;
    }

    public function attachRole($role)
    {
        return (!$this->getRoles()->contains($role)) ? $this->roles()->attach($role) : true;
    }

    public function detachRole($role)
    {
        $this->roles = null;
        return $this->roles()->detach($role);
    }

    public function detachAllRoles()
    {
        $this->roles = null;
        return $this->roles()->detach();
    }


    /**
     * 检测用户是否有权限
     * @param string $permission
     * @return mixed
     */
    public function hasPermission($permission){
        $permissions = session('user_permissions',[]);
        return (in_array($permission,$permissions) || $this->isSuperAdmin());
    }

    public function getPermissionsAttribute(){
        return session('user_permissions',[]);
    }



    /**
     *获取用户数据
     * @param $userId
     */
    public function userData()
    {
        return $this->hasOne('App\Models\UserData');
    }

    public function userTag(){
        return $this->hasMany('App\Models\UserTag');
    }

    public function userOauth(){
        return $this->hasMany('App\Models\UserOauth');
    }


    /*用户认证信息*/
    public function authentication()
    {
        return $this->hasOne('App\Models\Authentication');
    }

    /*用户认证信息*/
    public function lecturer()
    {
        return $this->hasOne('App\Models\Lecturer');
    }

    /**
     * 获取用户问题
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

    /**
     * 获取用户回答
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }


    /**
     * 获取用户文章
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    /*我发起的通知*/
    public function notifications(){
        return $this->hasMany('App\Models\Notification');
    }


    /**
     * 获取用户动态
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doings()
    {
        return $this->hasMany('App\Models\Doing');
    }


    /*我的评论*/

    public function comments(){
        return $this->hasMany('App\Models\Comment');

    }


    /*我的积分操作*/
    public function credits(){
        return $this->hasMany('App\Models\Credit');

    }


    /*获取用户收藏*/
    public function collections()
    {
        return $this->hasMany('App\Models\Collection');
    }


    /*用户关注*/
    public function attentions()
    {
        return $this->hasMany('App\Models\Attention');
    }

    /*用户粉丝*/
    public function followers()
    {
        return $this->morphToMany('App\Models\UserData', 'source','attentions','source_id','user_id');
    }

    /*邀请的回答*/
    public function questionInvitations()
    {
        return $this->hasMany('App\Models\QuestionInvitation');
    }

    /*我的商品兑换*/
    public function exchanges()
    {
        return $this->hasMany('App\Models\Exchange');
    }

    /*用户统计标签*/
    public function userTags(){
        return $this->hasMany('App\Models\UserTag','user_id');
    }



    public function hotTags(){
        $hotTagIds = $this->userTags()->select("tag_id")->distinct()->orderBy('supports','desc')->orderBy('answers','desc')->orderBy('created_at','desc')->take(5)->pluck('tag_id');
        $tags = [];
        foreach($hotTagIds as $hotTagId){
            $tag = Tag::find($hotTagId);
            if($tag){
                $tags[] = $tag;
            }

        }
        return $tags;
    }


    /*是否回答过问题*/
    public function isAnswered($questionId)
    {
        return boolval($this->answers()->where('question_id','=',$questionId)->count());
    }


    /*是否已经收藏过问题或文章*/
    public function isCollected($source_type,$source_id)
    {
        return $this->collections()->where('source_type','=',$source_type)->where('source_id','=',$source_id)->first();
    }



    /*是否已关注问题、用户*/
    public function isFollowed($source_type,$source_id)
    {
        return boolval($this->attentions()->where('source_type','=',$source_type)->where('source_id','=',$source_id)->count());
    }


    /**
     * 第三方账号是否绑定
     * @param $auth_type
     * @return bool
     */
    public function isOauthBind($auth_type){
        if($this->userOauth()->where("auth_type",'=',$auth_type)->count()){
            return true;
        }
        return false;
    }

    /*判断用户是否开启了邮件通知*/
    public function allowedEmailNotify($type){
        if(!in_array($type,explode(",",$this->email_notifications))){
            return false;
        }
        return true;
    }

    /*当前是否已签到*/
    public function isSigned(){
        $today = Carbon::parse(date('Y-m-d 00:00:00'));
        return $this->credits()->where('created_at','>',$today)->where('action','=','sign')->count();
    }

    public function isSuperAdmin(){
        return $this->id == config('tipask.super_admin_id');
    }

    public function openid(){
        $oauth =  $this->userOauth()->where("auth_type","wechat-app")->first();
        if($oauth){
            return $oauth->id;
        }
        return '';
    }

}
