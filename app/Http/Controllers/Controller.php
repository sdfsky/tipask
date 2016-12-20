<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Doing;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserData;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
    protected function success($url,$message)
    {
        Session::flash('message',$message);
        Session::flash('message_type',2);
        return redirect($url);
    }


    protected function error($url,$message)
    {
        Session::flash('message',$message);
        Session::flash('message_type',1);
        return redirect($url);
    }


    protected function showErrorMsg($url , $message){
        return view('errors.error')->with(compact('url','message'));
    }

    /**
     * 成功回调
     * @param $message
     */
    protected function ajaxSuccess($message){
        $data = array(
            'code' => 0,
            'message' => $message
        );
        return response()->json($data);
    }


    /**
     * 错误处理
     * @param $code
     * @param $message
     */
    protected function ajaxError($code,$message){
        $data = array(
            'code' => $code,
            'message' => $message
        );
        return response()->json($data);
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
    protected function credit($user_id,$action,$coins = 0,$credits = 0,$source_id = 0 ,$source_subject = null)
    {
        DB::beginTransaction();
        try{
            /*用户登陆只添加一次积分*/
            if($action == 'login' && Credit::where('user_id','=',$user_id)->where('action','=',$action)->where('created_at','>',Carbon::today())->count()>0){
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
    protected function doing($user_id,$action,$source_type,$source_id,$subject,$content='',$refer_id=0,$refer_user_id=0,$refer_content=null)
    {
        try{
            return Doing::create([
                'user_id' => $user_id,
                'action' => $action,
                'source_id' => $source_id,
                'source_type' => $source_type,
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


    /**
     * 发送用户通知
     * @param $from_user_id
     * @param $to_user_id
     * @param $type
     * @param $subject
     * @param $source_id
     * @return static
     */
    protected function notify($from_user_id,$to_user_id,$type,$subject='',$source_id=0,$content='',$refer_type='',$refer_id=0)
    {
        /*不能自己给自己发通知*/
       if( $from_user_id == $to_user_id ){
           return false;
       }

       $toUser = User::find($to_user_id);

        if( !$toUser ){
            return false;
        }
        /*站内消息策略*/
        if(!in_array($type,explode(",",$toUser->site_notifications))){
            return false;
        }

       return Notification::create([
            'user_id'    => $from_user_id,
            'to_user_id' => $to_user_id,
            'type'       => $type,
            'subject'    => strip_tags($subject),
            'source_id'    => $source_id,
            'content'  => $content,
            'refer_type'  => $refer_type,
            'refer_id'  => $refer_id,
            'is_read'    => 0
        ]);


    }


    /**
     * 将通知设置为已读
     * @param $source_id
     * @param string $refer_type
     * @return mixed
     */
    protected function readNotifications($source_id,$refer_type='question')
    {
        $types = [];
        if($refer_type=='article'){
            $types = ['comment_article'];
        }else if($refer_type=='question'){
            $types = ['answer','follow_question','comment_question','invite_answer','adopt_answer'];
        }else if($refer_type=='answer'){
            $types = ['comment_answer'];
        }else if($refer_type == 'user'){
            $types = ['follow_user'];
        }
        $types[] = 'reply_comment';
        return Notification::where('to_user_id','=',Auth()->user()->id)->where('source_id','=',$source_id)->whereIn('type',$types)->where('is_read','=',0)->update(['is_read'=>1]);
    }


    /*邮件发送*/
    protected function sendEmail($email,$subject,$message){

        if(Setting()->get('mail_open') != 1){//关闭邮件发送
            return false;
        }

        $data = [
            'email' => $email,
            'subject' => $subject,
            'body' => $message,
        ];


        Mail::queue('emails.common', $data, function($message) use ($data)
        {
            $message->to($data['email'])->subject($data['subject']);
        });

    }





    /**
     * 业务层计数器
     * @param $key 计数器key
     * @param null $step 级数步子
     * @param int $expiration 有效期
     * @return Int count
     */
    protected function counter($key,$step=null,$expiration=86400){

        $count = Cache::get($key,0);
        /*直接获取值*/
        if( $step === null ){
            return $count;
        }

        $count = $count + $step;

        Cache::put($key,$count,$expiration);

        return $count;

    }







}
