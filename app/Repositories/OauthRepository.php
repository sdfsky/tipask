<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2018/7/4
 * Time: 下午9:59
 */

namespace App\Repositories;


use App\Models\UserOauth;

class OauthRepository
{
    protected $userOauth;

    public function __construct(UserOauth $userOauth)
    {
        $this->userOauth = $userOauth;
    }

    /**
     * 绑定用户
     * @param $id
     * @param $userId 用户ID
     */
    public function bind($id, $userId)
    {
        $userOauth = $this->userOauth->find($id);
        if(!$userOauth){
            return false;
        }
        $userOauth->user_id = $userId;
        return $userOauth->save();
    }

}