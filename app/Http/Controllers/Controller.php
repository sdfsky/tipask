<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Doing;
use App\models\UserData;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Config;
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
    protected function credit($user_id,$action,$coins = 0,$credits = 0,$source_id = 0 ,$source_subject = null){
        DB::beginTransaction();
        try{
            /*用户登陆只添加一次积分*/
            if($action == Config::get('tipask.credit_actions.login') && Credit::where('user_id','=',$user_id)->where('action','=',$action)->where('created_at','>',Carbon::today())->count()>0){
                return false;
            }
            /*记录详情数据*/
            Credit::create([
                'user_id' => $user_id,
                'action' => $action,
                'source_id' => $source_id,
                'source_subject' => $source_subject,
                'coins' => $coins,
                'credits' => $credits,
                'created_at' => Carbon::now()
            ]);

            /*修改用户账户信息*/
            UserData::find($user_id)->increment('coins',$coins);
            UserData::find($user_id)->increment('credits',$credits);
            DB::commit();
            return true;

        }catch (\Exception $e) {
            echo $e->getMessage();
            exit;
            DB::rollBack();
            return false;
        }

    }

    /**
     * 记录用户动态
     * @param $user_id 动态发起人
     * @param $action  动作 ['ask','answer',...]
     * @param $source_id 问题或文章ID
     * @param $subject   问题或文章标题
     * @param string $content 回答或评论内容
     * @param int $refer_id  问题或者文章ID
     * @param int $refer_user_id 引用内容作者ID
     * @param null $refer_content 引用内容
     * @return static
     */
    protected function doing($user_id,$action,$source_id,$subject,$content='',$refer_id=0,$refer_user_id=0,$refer_content=null){
        try{
            return Doing::create([
                'user_id' => $user_id,
                'action' => $action,
                'source_id' => $source_id,
                'subject' => $subject,
                'content' => strip_tags($content),
                'refer_id' => $refer_id,
                'refer_user_id' => $refer_user_id,
                'refer_content' => strip_tags($refer_content),
                'created_at' => Carbon::now()
            ]);
        }catch (\Exception $e){
            exit($e->getMessage());
        }

    }











}
