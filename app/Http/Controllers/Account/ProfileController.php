<?php

namespace App\Http\Controllers\Account;

use App\Models\Area;
use App\Models\EmailToken;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;

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
            if($request->input('birthday')){
                $user->birthday = $request->input('birthday');
            }
            $user->title = $request->input('title');
            $user->description = $request->input('description');
            $user->province = $request->input('province');
            $user->city = $request->input('city');
            if($request->hasFile('qrcode')){
                $validateRules = [
                    'qrcode' => 'required|image|max:'.config('tipask.upload.image_size'),
                ];
                $this->validate($request,$validateRules);
                $file = $request->file('qrcode');
                $extension = $file->getClientOriginalExtension();
                $filePath = 'qrcodes/'.gmdate("Y")."/".gmdate("m")."/".uniqid(str_random(8)).'.'.$extension;
                Storage::disk('local')->put($filePath,File::get($file));
                Image::make(storage_path('app/'.$filePath))->resize(320,435)->save();
                $user->qrcode = str_replace("/","-",$filePath);
            }

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
            $extension = strtolower($file->getClientOriginalExtension());
            $extArray = array('png', 'gif', 'jpeg', 'jpg');

            if(in_array($extension, $extArray)){
	            if($extension != 'jpg'){
                    Image::make(File::get($file))->save(storage_path('app/'.User::getAvatarPath($user_id,'origin')));
                }else{
                    Storage::disk('local')->put($avatarDir.'/'.User::getAvatarFileName($user_id,'origin').'.'.$extension,File::get($file));
                }
            }else{
                return response('error');
            }

            return response()->json(array(
                'status' => 1,
                'msg' => '头像上传成功'
            ));
        }

        if($request->isMethod('POST')){
            $x = intval($request->input('x'));
            $y = intval($request->input('y'));
            $width = intval($request->input('width'));
            $height = intval($request->input('height'));

            $user_id = $request->user()->id;

            File::delete(storage_path('app/'.User::getAvatarPath($user_id,'big')));
            File::delete(storage_path('app/'.User::getAvatarPath($user_id,'middle')));
            File::delete(storage_path('app/'.User::getAvatarPath($user_id,'small')));

            Image::make(storage_path('app/'.User::getAvatarPath($user_id,'origin')))->crop($width,$height,$x,$y)->resize(128,128)->save(storage_path('app/'.User::getAvatarPath($user_id,'big')));
            Image::make(storage_path('app/'.User::getAvatarPath($user_id,'origin')))->crop($width,$height,$x,$y)->resize(64,64)->save(storage_path('app/'.User::getAvatarPath($user_id,'middle')));
            Image::make(storage_path('app/'.User::getAvatarPath($user_id,'origin')))->crop($width,$height,$x,$y)->resize(24,24)->save(storage_path('app/'.User::getAvatarPath($user_id,'small')));

            return response()->json(array(
                'status' => 1,
                'msg' => '头像截剪成功'
            ));
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

                if($emailToken){
                    $subject = '欢迎注册'.Setting()->get('website_name').',请激活您注册的邮箱！';
                    $content = "「".$request->user()->name."」您好，请激活您在 ".Setting()->get('website_name')." 的注册邮箱！<br /> 请在1小时内点击该链接激活注册账号 → ".route('auth.email.verifyToken',['action'=>$emailToken->action,'token'=>$emailToken->token])."<br />如非本人操作，请忽略此邮件！";
                    $this->sendEmail($emailToken->email,$subject,$content);
                }

                return $this->success(route('auth.profile.email'),'邮箱修改成功！一封验证邮件已经发到您的邮箱'.$request->user()->email.',请登陆邮箱进行验证！');
            }

        }
        return view('theme::profile.email');
    }


    public function anyMobile(Request $request)
    {
        if($request->isMethod('post')){
            $validateRules = [
                'mobile' => 'required|max:11,'.$request->user()->id,
                'code' => 'required|min:4|max:10',
            ];

            $this->validate($request,$validateRules);

            $mobile = $request->input('mobile');
            $code = $request->input('code');

            if(!SmsService::verifySmsCode($mobile,$code)){
                return $this->error(route('auth.profile.mobile'),"短信验证码错误，请重新验证");
            }

            $request->user()->mobile = $mobile;
            $request->user()->status = 1;
            $request->user()->save();
            $request->user()->userData->mobile_status = 1;
            $request->user()->userData->save();
            return $this->success(route('auth.profile.mobile'),'手机号码绑定成功！');
        }
        return view('theme::profile.mobile');
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
            $siteNotifications = $request->input('site_notifications','');
            $emailNotifications = $request->input('email_notifications','');
            $request->user()->site_notifications = '';
            if($siteNotifications){
                $request->user()->site_notifications = implode(",",$siteNotifications);
            }
            $request->user()->email_notifications = '';
            if($emailNotifications){
                $request->user()->email_notifications = implode(",",$emailNotifications);
            }

            $request->user()->save();
            return $this->success(route('auth.profile.notification'),'通知提醒策略设置成功');

        }
        $siteNotifications = explode(",",$request->user()->site_notifications);
        $emailNotifications = explode(",",$request->user()->email_notifications);
        return view('theme::profile.notification')->with(compact('siteNotifications','emailNotifications'));

    }


}
