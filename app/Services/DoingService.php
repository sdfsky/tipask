<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2017/4/24
 * Time: 下午5:29
 */

namespace App\Services;


use App\Models\Doing;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DoingService
{
    /**添加动态记录信息
     * @param $user_id
     * @param $action
     * @param $source_type
     * @param $source_id
     * @param $subject
     * @param string $content
     * @param int $refer_id
     * @param int $refer_user_id
     * @param null $refer_content
     * @return bool|static
     */
    public static function create($user_id,$action,$source_type,$source_id,$subject,$content='',$refer_id=0,$refer_user_id=0,$refer_content=null){
        //避免重复动态
        $doings = Doing::where("user_id",'=',$user_id)->where("action",'=',$action)->where("source_id","=",$source_id)->where("source_type","=",$source_type)->count();
        if( $doings > 0 ) {
            return false;
        }
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
            Log::error('doing_service_error:'.$e->getMessage());
            return false;
        }
    }

}