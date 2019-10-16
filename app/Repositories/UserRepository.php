<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/14
 * Time: 10:01
 */

namespace App\Repositories;


use App\Models\Credit;
use App\Models\User;
use App\Models\UserData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserRepository
{
    protected $user;
    protected $userData;

    public function __construct(User $user, UserData $userData)
    {
        $this->user = $user;
        $this->userData = $userData;
    }

    public function register($data)
    {
        $data['password'] = Hash::make($data['password']);
//        $data['site_notifications'] = 'answer,follow_user,invite_answer,comment_question,comment_article,adopt_answer,comment_answer,reply_comment';
        $data['site_notifications'] = implode(',', array_keys(config('tipask.notification_types')));
        $data['email_notifications'] = 'adopt_answer,invite_answer';
        $user = $this->user->create($data);
        if ($user) {
            $userData = [
                'user_id' => $user->id,
                'coins' => 0,
                'credits' => 0,
                'registered_at' => Carbon::now(),
                'last_visit' => Carbon::now(),
                'last_login_ip' => $data['visit_ip'],
            ];

            if ($user->mobile) {
                $userData['mobile_status'] = 1;
            }
            $this->userData->create($userData);
        }
        return $user;
    }

    public function saveRemoteAvatar($userId, $imageUrl)
    {
        Storage::makeDirectory(User::getAvatarDir($userId));
        Image::make($imageUrl)->save(storage_path('app/'.User::getAvatarPath($userId,'origin')));
        Image::make(storage_path('app/'.User::getAvatarPath($userId,'origin')))->save(storage_path('app/'.User::getAvatarPath($userId,'big')));
        Image::make(storage_path('app/'.User::getAvatarPath($userId,'origin')))->save(storage_path('app/'.User::getAvatarPath($userId,'middle')));
        Image::make(storage_path('app/'.User::getAvatarPath($userId,'origin')))->save(storage_path('app/'.User::getAvatarPath($userId,'small')));
    }


}