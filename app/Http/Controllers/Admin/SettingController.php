<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

class SettingController extends AdminController
{

    /*站点设置*/
    public function website(Request $request)
    {

        $validateRules = [
            'website_name' => 'required|max:128',
            'website_slogan' => 'sometimes|max:128',
            'website_welcome' => 'sometimes|max:256',
            'website_url' => 'required|url',
            'website_icp' => 'sometimes|max:128',
            'website_cache_time' => 'sometimes|digits_between:0,8640',
            'website_admin_email' => 'required|email',
        ];

        $themes = [];
        /*获取模板主题目录下主题列表*/
        $themePath = base_path()."/resources/views/themes";
        if ($dh = opendir($themePath)) {
            while (($file = readdir($dh)) !== false) {
                if( is_dir($themePath.'/'.$file) && $file{0} !== '.' ){
                    $themes[] = $file;
                }
            }
            closedir($dh);
        }

        if($request->isMethod('post')){
            $this->validate($request,$validateRules);
            $data = $request->except('_token');
            foreach($data as $name=>$value){
                Setting()->set($name,$value);
            }
            Setting()->clearAll();
            $_ENV['WEBSITE_URL'] = $request->input('website_url');
            Setting()->writeToEnv();
            return $this->success(route('admin.setting.website'),'站点设置保存成功');

        }

        return view('admin.setting.website')->with('themes',$themes);
    }


    /*邮件配置*/
    public function  email(Request $request)
    {

        if($request->isMethod('post')){
            $data = $request->except('_token');
            unset($data['_token']);
            foreach($data as $name=>$value){
                $_ENV[strtoupper($name)] = $value;
                Setting()->set($name,$value);
            }
            Setting()->clearAll();
            Setting()->writeToEnv();
            return $this->success(route('admin.setting.email'),'邮箱配置保存成功');
        }

        return view('admin.setting.email');
    }

    /*时间格式设置*/
    public function time(Request $request)
    {
        $timeOffsets = [
            '-12' => '(标准时-12:00) 日界线西',
            '-11' => '(标准时-11:00) 中途岛、萨摩亚群岛',
            '-10' => '(标准时-10:00) 夏威夷',
            '-9' => '(标准时-9:00) 阿拉斯加',
            '-8' => '(标准时-8:00) 太平洋时间(美国和加拿大)',
            '-7' => '(标准时-7:00) 山地时间(美国和加拿大)',
            '-6' => '(标准时-6:00) 中部时间(美国和加拿大)、墨西哥城',
            '-5' => '(标准时-5:00) 东部时间(美国和加拿大)、波哥大',
            '-4' => '(标准时-4:00) 大西洋时间(加拿大)、加拉加斯',
            '-3.5' => '(标准时-3:30) 纽芬兰',
            '-3' => '(标准时-3:00) 巴西、布宜诺斯艾利斯、乔治敦',
            '-2' => '(标准时-2:00) 中大西洋',
            '-1' => '(标准时-1:00) 亚速尔群岛、佛得角群岛',
            '0' => '(格林尼治标准时) 西欧时间、伦敦、卡萨布兰卡',
            '1' => '(标准时+1:00) 中欧时间、安哥拉、利比亚',
            '2' => '(标准时+2:00) 东欧时间、开罗，雅典',
            '3' => '(标准时+3:00) 巴格达、科威特、莫斯科',
            '3.5' => '(标准时+3:30) 德黑兰',
            '4' => '(标准时+4:00) 阿布扎比、马斯喀特、巴库',
            '4.5' => '(标准时+4:30) 喀布尔',
            '5' => '(标准时+5:00) 叶卡捷琳堡、伊斯兰堡、卡拉奇',
            '5.5' => '(标准时+5:30) 孟买、加尔各答、新德里',
            '6' => '(标准时+6:00) 阿拉木图、 达卡、新亚伯利亚',
            '7' => '(标准时+7:00) 曼谷、河内、雅加达',
            '8' => '(标准时+8:00)北京、重庆、香港、新加坡',
            '9' => '(标准时+9:00) 东京、汉城、大阪、雅库茨克',
            '9.5' => '(标准时+9:30) 阿德莱德、达尔文',
            '10' => '(标准时+10:00) 悉尼、关岛',
            '11' => '(标准时+11:00) 马加丹、索罗门群岛',
            '12' => '(标准时+12:00) 奥克兰、惠灵顿、堪察加半岛'
        ];

        $validateRules = [
            'time_diff' => 'integer',
        ];

        if($request->isMethod('post'))
        {
            $this->validate($request,$validateRules);
            $data = $request->except('_token');
            foreach($data as $name=>$value){
                Setting()->set($name,$value);
            }
            Setting()->clearAll();

            return $this->success(route('admin.setting.time'),'时间设置成功');
        }

        return view('admin.setting.time')->with('timeOffsets',$timeOffsets);
    }

    /*防灌水设置*/
    public function irrigation(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->except('_token');
            $data['code_login'] = $request->input('code_login',0);
            $data['code_register'] = $request->input('code_register',0);
            $data['code_create_question'] = $request->input('code_create_question',0);
            $data['code_create_article'] = $request->input('code_create_article',0);
            $data['code_create_answer'] = $request->input('code_create_answer',0);
            foreach($data as $name => $value ){
                Setting()->set($name,$value);
            }
            Setting()->clearAll();
            return $this->success(route('admin.setting.irrigation'),'防灌水策略设置成功');

        }

        return view('admin.setting.irrigation');

    }


    /*注册策略设置*/
    public function register(Request $request)
    {
        $validateRules = [];
        if($request->isMethod('post')){
            $this->validate($request,$validateRules);
            $data = $request->except('_token');
            foreach($data as $name=>$value){
                Setting()->set($name,$value);
            }
            Setting()->clearAll();

            return $this->success(route('admin.setting.register'),'注册设置成功');

        }

        return view('admin.setting.register');

    }


    /*积分策略设置*/
    public function credits(Request $request)
    {
        $validateRules = [
            'credits_register' => 'required|integer',
            'coins_register' => 'required|integer',
            'credits_login' => 'required|integer',
            'coins_login' => 'required|integer',
            'credits_ask' => 'required|integer',
            'coins_ask' => 'required|integer',
            'credits_answer' => 'required|integer',
            'coins_answer' => 'required|integer',
            'credits_adopted' => 'required|integer',
            'coins_adopted' => 'required|integer',
        ];
        if($request->isMethod('post')){
            $this->validate($request,$validateRules);
            $data = $request->except('_token');
            unset($data['_token']);
            foreach($data as $name=>$value){
                Setting()->set($name,$value);
            }
            Setting()->clearAll();

            return $this->success(route('admin.setting.credits'),'积分策略设置成功');
        }

        return view('admin.setting.credits');
    }

    public function seo(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->except('_token');
            unset($data['_token']);
            foreach($data as $name=>$value){
                Setting()->set($name,$value);
            }
            Setting()->clearAll();
            return $this->success(route('admin.setting.seo'),'seo策略设置成功');
        }
        return view('admin.setting.seo');
    }


    /*变量设置*/
    public function variables(Request $request){
        return view('admin.setting.variables');
    }



    /*xunsearch整合*/
    public function xunSearch(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->except('_token');
            unset($data['_token']);
            foreach($data as $name=>$value){
                Setting()->set($name,$value);
            }
            Setting()->clearAll();

            return $this->success(route('admin.setting.xunSearch'),'xunSearch设置成功');
        }
        return view('admin.setting.xunSearch');

    }

    public function oauth(Request $request)
    {

        if($request->isMethod('post')){
            $data = $request->except('_token');
            unset($data['_token']);
            foreach($data as $name=>$value){
                $_ENV[strtoupper($name)] = $value;
                Setting()->set($name,$value);
            }
            Setting()->clearAll();
            Setting()->writeToEnv();
            return $this->success(route('admin.setting.oauth'),'一键登录设置成功');

        }

        return view('admin.setting.oauth');

    }

    /*系统功能自定义*/
    public function custom(Request $request){
        if($request->isMethod('post')){
            $data = $request->except('_token');
            foreach($data as $name => $value){
                Setting()->set($name,$value);
            }
            Setting()->clearAll();
            return $this->success(route('admin.setting.custom'),'配置保存成功');

        }
        return view('admin.setting.custom');
    }

    // 附件设置
    public function attach(Request $request){
        if($request->isMethod('post')){
            $validateRules = [
                'attach_image_size' => 'required|integer',
                'attach_file_size' => 'required|integer',
            ];
            $request->flash();
            $this->validate($request,$validateRules);
            $imageSize = $request->input('attach_image_size');
            $attachSize = $request->input('attach_file_size');
            $openWaterMark = $request->input('attach_open_watermark',0);
            $_ENV['UPLOAD_IMAGE_SIZE'] = $imageSize;
            $_ENV['UPLOAD_ATTACH_SIZE'] = $attachSize;
            $_ENV['UPLOAD_OPEN_WATERMARK'] = $openWaterMark;
            if($request->hasFile('attach_watermark_image')){
                $savePath = storage_path('app/watermarks');
                $file = $request->file('attach_watermark_image');
                $fileName = uniqid(str_random(8)).'.'.$file->getClientOriginalExtension();
                $target = $file->move($savePath,$fileName);
                if($target){
                    $_ENV['UPLOAD_WATERMARK_IMAGE'] = 'watermarks-'.$fileName;
                }
            }
            Setting()->writeToEnv();
            return $this->success(route('admin.setting.attach'),'设置成功');
        }
        return view('admin.setting.attach');
    }

    // 极验证
    public function geetest(Request $request){
        if($request->isMethod('post')){
            $_ENV['GEETEST_OPEN'] = $request->input('geetest_open',false);
            $_ENV['GEETEST_ID'] = $request->input('geetest_id','');
            $_ENV['GEETEST_KEY'] = $request->input('geetest_key','');
            Setting()->writeToEnv();
            return $this->success(route('admin.setting.geetest'),'配置保存成功');
        }
        return view('admin.setting.geetest');
    }
}
