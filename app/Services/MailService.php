<?php
/**
 * Created by PhpStorm.
 * User: nayo
 * Date: 2018/6/6
 * Time: 下午4:04
 */

namespace App\Services;


use App\Jobs\SendEmail;
use App\Mail\GlobalMail;
use Illuminate\Support\Facades\Mail;

class MailService
{

    /**
     * 通用发送邮件服务
     * @param string $email 发送邮件地址
     * @param string $subject 邮件主题
     * @param array $data 邮件内容数据
     * @param string $blade 邮件模板
     * @param string $type 默认async异步队列,否则为同步
     */
    public static function sendMail($email, $subject, $data=[], $blade='common',$type='async')
    {
        if ($type == 'async'){
            SendEmail::dispatch($email, $subject, $data, $blade)->onQueue('global_email_queue');
        }else{
            Mail::to($email)->send(new GlobalMail($blade,$subject,$data));
        }
        return;
    }
}