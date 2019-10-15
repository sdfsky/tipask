<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 16/5/27
 * Time: 上午11:24
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class ToolController extends AdminController
{

    /*清空缓存*/
    public function clearCache(Request $request)
    {
        if($request->isMethod('post')){
            $cacheItems = $request->input('cacheItems',[]);
            if(in_array('data',$cacheItems)){
               Artisan::call('cache:clear');
               Artisan::call('config:clear');
            }

            if(in_array('view',$cacheItems)){
                Artisan::call('view:clear');
            }
            return $this->success(route('admin.tool.clearCache'),'缓存更新成功');
        }
        return view('admin.tool.clearCache');

    }


    /*发送测试邮件*/
    public function sendTestEmail(Request $request){
        $validateRules = [
            'sendTo' => 'required|email',
            'content' => 'required|max:255',
        ];

        $this->validate($request,$validateRules);

        $mailData = $request->all();

        try{
            Mail::send('emails.test',$mailData, function($message) use ($mailData)
            {
                $message->to($mailData['sendTo'])->subject(Setting()->get('website_name').'邮件测试');
            });
            return response('ok');
        }catch (\Swift_SwiftException $e){
            return response($e->getMessage());
        }


    }

}