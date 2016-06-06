<?php

namespace App\Http\Controllers\Account;

use App\Models\Area;
use App\Models\Authentication;
use App\Models\EmailToken;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    /*个人基本资料*/
    public function anyBase(Request $request)
    {
        $user = $request->user();
        if($request->isMethod('POST')){
            $request->flash();
            $validateRules = [
                'name' => 'required|max:128',
                'title' => 'sometimes|max:128',
                'description' => 'sometimes|max:9999',
            ];
            $this->validate($request,$validateRules);
            $user->name = $request->input('name');
            $user->gender = $request->input('gender');
            $user->birthday = $request->input('birthday');
            $user->title = $request->input('title');
            $user->description = $request->input('description');
            $user->province = $request->input('province');
            $user->city = $request->input('city');
            $user->save();
            return $this->success(route('auth.profile.base'),'个人资料修改成功');

        }
        $provinces = Area::provinces();
        $cities = Area::cities($user->province);
        $data = [
            'provinces' => $provinces,
            'cities' => $cities,
        ];

        return view('theme::profile.base')->with('data',$data);
    }

    /**
     * 修改用户头像
     * @param Request $request
     */
    public function postAvatar(Request $request)
    {
        $validateRules = [
            'user_avatar' => 'required|image',
        ];
        if($request->hasFile('user_avatar')){
            $this->validate($request,$validateRules);
            $user_id = $request->user()->id;
            $file = $request->file('user_avatar');
            $avatarDir = User::getAvatarDir($user_id);
            $extension = $file->getClientOriginalExtension();

            File::delete(storage_path('app/'.User::getAvatarPath($user_id,'big')));
            File::delete(storage_path('app/'.User::getAvatarPath($user_id,'middle')));
            File::delete(storage_path('app/'.User::getAvatarPath($user_id,'small')));

            Storage::disk('local')->put($avatarDir.'/'.User::getAvatarFileName($user_id,'origin').'.'.$extension,File::get($file));
            Image::make(storage_path('app/'.User::getAvatarPath($user_id,'origin',$extension)))->resize(128,128)->save(storage_path('app/'.User::getAvatarPath($user_id,'big')));
            Image::make(storage_path('app/'.User::getAvatarPath($user_id,'origin',$extension)))->resize(64,64)->save(storage_path('app/'.User::getAvatarPath($user_id,'middle')));
            Image::make(storage_path('app/'.User::getAvatarPath($user_id,'origin',$extension)))->resize(24,24)->save(storage_path('app/'.User::getAvatarPath($user_id,'small')));
            return response('ok');
        }

    }

    /**
     * 修改用户密码
     * @param Request $request
     */
    public function anyPassword(Request $request)
    {
        if($request->isMethod('POST')){
            $validateRules = [
                'old_password' => 'required|min:6|max:16',
                'password' => 'required|min:6|max:16',
                'password_confirmation'=>'same:password',
                'captcha' => 'required|captcha',

            ];
            $this->validate($request,$validateRules);

            $user = $request->user();

            if(Hash::check($request->input('old_password'),$user->password)){
                $user->password = Hash::make($request->input('password'));
                $user->save();
                Auth()->logout();
                return $this->success(route('auth.user.login'),'密码修改成功,请重新登录');
            }

            return redirect(route('auth.profile.password'))
                ->withErrors([
                    'old_password' => '原密码错误！',
                ]);
        }
        return view('theme::profile.password');
    }

    /*修改邮箱*/
    public function anyEmail(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $validateRules = [
                'email' => 'required|email|unique:users,email,'.$request->user()->id,
                'captcha' => 'required|captcha',
            ];
            $this->validate($request,$validateRules);

            if($request->input('email') !== $request->user()->email){
                $request->user()->email = $request->input('email');
                $request->user()->status = 0;
                $request->user()->save();
                $emailToken = EmailToken::create([
                    'email' =>$request->input('email'),
                    'action' => 'verify',
                    'token' => EmailToken::createToken(),
                ]);

                $this->sendEmail($request->user()->id,'verify','您好，请激活您在'.Setting()->get('website_name').'注册的邮箱！',$emailToken,true);

                return $this->success(route('auth.profile.email'),'邮箱修改成功！一封验证邮件已经发到您的邮箱'.$request->user()->email.',请登陆邮箱进行验证！');
            }

        }
        return view('theme::profile.email');
    }



    /*第三方系统账号绑定*/
    public function anyOauth()
    {

        return view('theme::profile.oauth');
    }

    /*消息通知设置*/
    public function anyNotification(Request $request)
    {
        if($request->isMethod('post')){
            $siteNotifications = $request->input('site_notifications');
            $emailNotifications = $request->input('email_notifications');
            if($siteNotifications){
                $request->user()->site_notifications = implode(",",$siteNotifications);
            }
            if($emailNotifications){
                $request->user()->email_notifications = implode(",",$emailNotifications);
            }

            if($siteNotifications || $emailNotifications){
                $request->user()->save();
            }
            return $this->success(route('auth.profile.notification'),'通知提醒策略设置成功');

        }
        $siteNotifications = explode(",",$request->user()->site_notifications);
        $emailNotifications = explode(",",$request->user()->email_notifications);
        return view('theme::profile.notification')->with(compact('siteNotifications','emailNotifications'));

    }


}
