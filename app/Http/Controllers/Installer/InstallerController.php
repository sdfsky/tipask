<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 16/6/6
 * Time: 下午5:40
 */

namespace app\Http\Controllers\Installer;

use Exception;
use App\Models\Setting;
use App\Services\Registrar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class InstallerController extends Controller
{

    /*欢迎使用*/
    public function welcome(){
        return view("installer.welcome");
    }

    public function requirement(){
        $requirements = $this->checkRequirements();
        $folders = $this->checkPermissions();
        $result = true;
        if(isset($requirements['errors']) || isset($folders['errors'])){
            $result = false;
        }
        return view("installer.environment")->with(compact('requirements','folders','result'));
    }


    public function config(Request $request){

        if($request->isMethod('post')){
            $validateRules = [
                'database_host' => 'required|max:128',
                'database_port' => 'required|digits_between:0,65535',
                'database_username' => 'required|max:128',
                'database_password' => 'sometimes|max:128',
                'database_name' => 'required|max:128',
                'database_prefix' => 'required|max:64',

            ];
            $request->flash();
            $this->validate($request,$validateRules);
            $envData = [
                'APP_ENV'=>'local',
                'APP_DEBUG'=>'true',
                'APP_KEY'=>Str::random(32),
                'DB_HOST'=>$request->input('database_host'),
                'DB_PORT'=>$request->input('database_port'),
                'DB_DATABASE'=>$request->input('database_name'),
                'DB_USERNAME'=>$request->input('database_username'),
                'DB_PASSWORD'=>$request->input('database_password'),
                'DB_PREFIX'=>$request->input('database_prefix'),
            ];

            /*写入配置文件*/
            $env_path = base_path('.env');

            if (!file_exists($env_path)){
                if(touch($env_path)){
                    return $this->error(route('website.installer.config'),'配置文件创建失败，请在网站根目录创建名称 .env 空文件文件并添加读写权限！');
                }
            }

            $env_content = '';

            foreach($envData as $key => $value ){
                $env_content .= $key.'='.$value."\n";
            }

            try {
                file_put_contents($env_path,$env_content);
            }catch(Exception $e) {
                return $this->error(route('website.installer.config'),'配置文件写入失败，请将网站根目录创建名称为 .env 的文件添加读写权限！');
            }


            return redirect()->route('website.installer.initDB');
        }

        return view('installer.config');
    }


    public function initDB(){
        set_time_limit(0);//不限制执行时间
        /*创建表结构*/
        try{
            Artisan::call('migrate');
        }catch(Exception $e) {
            return $this->error(route('website.installer.config'),'数据库连接出错：'.$e->getMessage());
        }

        /*导入数据*/
        try{
            Artisan::call('db:seed');
        }catch(Exception $e){
            return $this->error(route('website.installer.config'),'数据插入失败：'.$e->getMessage());
        }

        return redirect()->route('website.installer.website');

    }

    public function website(Request $request,Registrar $registrar)
    {

        if($request->isMethod('post')){
            $validateRules = [
                'website_name' => 'required|max:256',
                'website_url' => 'required|max:128',
                'website_admin_name' => 'required|max:128',
                'website_admin_email' => 'required|email',
                'website_admin_pass' => 'required|min:6|max:32',
            ];

            $request->flash();
            $this->validate($request,$validateRules);

            $registerData = [
                'name' => $request->input('website_admin_name'),
                'email' => $request->input('website_admin_email'),
                'password' => $request->input('website_admin_pass'),
                'status' => 1,
                'visit_ip' => $request->getClientIp(),
            ];

            Setting::set('website_name',$request->input('website_name'));
            Setting::set('website_url',$request->input('website_url'));
            Setting::set('website_admin_email',$request->input('website_admin_email'));

            $admin =  $registrar->create($registerData);
            $admin->attachRole(1);

            return redirect()->route('website.installer.finished');
        }

        return view('installer.website');

    }

    public function finished(){
        file_put_contents(storage_path('installed'), '');
        return view('installer.finished');
    }



    private function checkRequirements(){
        $requirements = config('installer.requirements');
        $results = [];
        foreach($requirements as $requirement)
        {
            $results['requirements'][$requirement] = true;

            if(!extension_loaded($requirement))
            {
                $results['requirements'][$requirement] = false;

                $results['errors'] = true;
            }
        }

        return $results;
    }

    private function checkPermissions(){
        $folders = config('installer.permissions');
        $results = [];

        foreach($folders as $folder => $permission)
        {
            $results['folders'][$folder]['status'] = true;
            $results['folders'][$folder]['permission'] = $this->getPermission($folder);

            if(!($results['folders'][$folder]['permission'] >= $permission))
            {
                $results['folders'][$folder]['status'] = false;
                $results['errors'] = true;
            }
        }

        return $results;
    }


    /**
     * Get a folder permission.
     *
     * @param $folder
     * @return string
     */
    private function getPermission($folder)
    {
        return substr(sprintf('%o', fileperms(base_path($folder))), -4);
    }



}