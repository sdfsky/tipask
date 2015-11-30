<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\models\UserData;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 操作成功提示
     * @param $url string
     * @param $message 消息内容
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function success($url,$message){
        Session::flash('message',$message);
        Session::flash('message_type',2);
        return redirect($url);
    }

    protected function error($url,$message){
        Session::flash('message',$message);
        Session::flash('message_type',1);
        return redirect($url);
    }


    /**
     * 修改用户积分
     * @param $user_id 用户id
     * @param $action  执行动作：提问、回答、发起文章
     * @param int $source_id 源：问题id、回答id、文章id等
     * @param string $source_subject 源主题：问题标题、文章标题等
     * @param int $coins      金币数/财富值
     * @param int $credits    经验值
     * @return bool           操作成功返回true 否则  false
     */
    public function credit($user_id,$action,$source_id=0,$source_subject='',$coins=0,$credits=0){

        DB::beginTransaction();
        try{
            /*记录详情数据*/
            Credit::create([
                'user_id' => $user_id,
                'action' => $action,
                'source_id' => $source_id,
                'source_subject' => $source_subject,
                'coins' => $coins,
                'credits' => $credits,
            ]);

            /*修改用户账户信息*/
            UserData::find($user_id)->increment('coins',$coins);
            UserData::find($user_id)->increment('credits',$credits);

            DB::commit();

            return true;

        }catch (\Exception $e) {

            DB::rollBack();
            return false;
        }


    }






}
