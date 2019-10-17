<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2017/4/24
 * Time: 下午5:08
 */

namespace App\Services;


use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotificationService
{

    /**全局站内通知处理
     * @param $from_user_id
     * @param $to_user_id
     * @param $type
     * @param string $subject
     * @param int $source_id
     * @param string $content
     * @param string $refer_type
     * @param int $refer_id
     * @return bool|static
     */
    public static function notify($from_user_id,$to_user_id,$type,$subject='',$source_id=0,$content='',$refer_type='',$refer_id=0){
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


    /**全局邮件发送处理
     * @param $email
     * @param $subject
     * @param $message
     * @return bool
     */
    public static function sendEmail($email,$subject,$message){
        if(Setting()->get('mail_open') != 1){//关闭邮件发送
            return false;
        }
        $data = [
            'email' => $email,
            'subject' => $subject,
            'body' => $message,
        ];
        MailService::sendMail($email, $subject, $data);
    }




}