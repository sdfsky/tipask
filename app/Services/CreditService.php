<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2017/4/24
 * Time: 下午5:20
 */

namespace App\Services;


use App\Models\Credit;
use App\Models\UserData;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreditService
{

    public static function create($user_id,$action,$coins = 0,$credits = 0,$source_id = 0 ,$source_subject = null,$through=false){
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

            if(!$through){
                /*修改用户账户信息*/
                UserData::find($user_id)->increment('coins',$coins);
                UserData::find($user_id)->increment('credits',$credits);
            }
            DB::commit();
            return true;
        }catch (\Exception $e) {
            Log::error("credit_create_error:".$e->getMessage());
            DB::rollBack();
            return false;
        }
    }

}