<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2017/1/4
 * Time: 下午12:03
 */

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Mrgoon\AliSms\AliSms;

class SmsService
{

   public static function sendSms($mobile,$smsTemplateId,$params){
       if(!config('services.sms_open')){
           return false;
       }
       if(!is_mobile($mobile) || !$smsTemplateId){
           return false;
       }
       return self::aliSmsSend($mobile,$smsTemplateId,$params);
   }


   public static function sendSmsCode($mobile){
       $code = random_number(6);
       Cache::put("sms_code_$mobile",$code,600);
       return self::sendSms($mobile,Setting()->get('sms_code_template'),['code'=>$code]);
   }


   public static function verifySmsCode($mobile,$code){
        $storeCode = Cache::get("sms_code_$mobile","");
        if($storeCode != $code){
            return false;
        }

       return true;
   }

   protected static function aliSmsSend($mobile,$smsTemplateId,$params){
       $aliSms = new AliSms();
       $response = $aliSms->sendSms($mobile, $smsTemplateId, $params);
       if($response->Code != 'OK'){
           Log::error("ali_sms_send_error".json_encode($response));
           return false;
       }
       return true;
   }

}