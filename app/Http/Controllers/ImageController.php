<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests;
use Intervention\Image\Facades\Image;

class ImageController extends BaseController
{

    /**
     * 显示用户头像
     * @param $avatar_name
     * @return mixed
     */
    public function avatar($avatar_name){
        list($user_id,$size) = explode('_',$avatar_name);
        $avatarFile = storage_path('app/'.User::getAvatarPath($user_id,$size));
        if(!is_file($avatarFile)){
            $avatarFile = public_path('static/images/default_avatar.jpg');
        }
        return Image::make($avatarFile)->response();
    }

}
