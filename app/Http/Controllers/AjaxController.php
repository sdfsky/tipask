<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Question;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\User;
use App\Models\UserTag;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{

    /**
     * 加载城市下拉项
     * @param $province_id 省份ID
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function loadCities($province_id)
    {


        $cities = Area::cities($province_id);
        $city_options = '';
        foreach($cities as $city){
            $city_options .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }

        return response($city_options);

    }



    /*未读通知数目*/
    public function unreadNotifications()
    {
        $total = Notification::where('to_user_id','=',Auth()->user()->id)->where('is_read','=',0)->count();
        $response = '<span class="fa fa-bell-o fa-lg"></span>';
        if( $total > 0 ){
            if($total > 99){
                $total = '99+' ;
            }
            $response =  '<span class="fa fa-bell-o fa-lg"></span><span class="label label-danger">'.$total.'</span>';
        }

        return response($response);
    }


    public function unreadMessages()
    {
        $total = Message::where('to_user_id','=',Auth()->user()->id)->where('is_read','=',0)->where("to_deleted","<>",1)->where("from_deleted","<>",1)->count();
        $response = '<span class="fa fa-envelope-o fa-lg"></span>';
        if( $total > 0 ){
            if($total > 99){
                $total = '99+' ;
            }
            $response =  '<span class="fa fa-envelope-o fa-lg"></span><span class="label label-success">'.$total.'</span>';
        }

        return response($response);
    }


    public function loadTags(Request $request)
    {
        $word = $request->input('word');
        $tags = [];
        if( strlen($word) > 10 ){
            return response()->json($tags);
        }
        $type = $request->input('type','all');
        if(!$word){
            $tags = Taggable::hottest($type,10);
        }else{
            $tags = Tag::where('name','like',$word.'%')->take(10)->get();
        }

        $selectTags = [];
        foreach ($tags as $tag){
            $selectTag = [];
            $selectTag['id'] = $tag->name;
            $selectTag['text'] = $tag->name;
            $selectTags[] = $selectTag;
        }
        return response()->json($selectTags);
    }



    public function loadUsers(Request $request)
    {
        $word = $request->input('word');

        $users = User::where('id','<>',$request->user()->id)->where('name','like',"$word%")->take(10)->get();
        $users->map(function($user){
            $user->avatar = get_user_avatar($user->id);
            $user->coins = $user->userData->coins;
            $user->answers = $user->userData->answers;
            $user->followers = $user->userData->followers;
        });
        return response()->json($users->toArray());
    }


    public function loadInviteUsers(Request $request)
    {
        $questionId = $request->input('question_id',0);
        $question = Question::find($questionId);
        if(!$question){
            return $this->ajaxError(10004,'notFund');
        }
        $tags = $question->tags()->get();

        $tagIds = array_pluck($tags,"id");

        if(!$tagIds){
            return $this->ajaxError(10004,'noData');
        }

        $word = $request->input('word','');

        if(trim($word)){
            $users = User::where('id','<>',$request->user()->id)->where('name','like',"$word%")->take(10)->get();
            $users->map(function($user) use($tagIds,$question) {
                $user->tag_name = '';
                $user->tag_answers = 0;
                $userTag = UserTag::where("user_id","=",$user->id)->whereIn("tag_id",$tagIds)->orderBy("answers","desc")->orderBy("created_at","desc")->first();
                if($userTag){
                    $tag = Tag::find($userTag->tag_id);
                    if($tag){
                        $user->tag_name = $tag->name;
                    }
                    $user->tag_answers = $userTag->answers;
                }
                $user->avatar = get_user_avatar($user->id);
                $user->url = route('auth.space.index',['user_id'=>$user->user_id]);
                $user->isInvited = 0;

            });
        }else{

            $invitations = $question->invitations()->get();
            $invitedUserIds = array_pluck($invitations,'user_id');
            $userTags = UserTag::whereIn("tag_id",$tagIds)->whereNotIn("user_id",$invitedUserIds)->orderBy("answers","desc")->orderBy("supports","desc")->select("user_id","tag_id","answers","supports")->take(16)->groupBy("user_id")->get();
            $users = [];
            foreach($userTags as $userTag){
                $user = User::find($userTag->user_id);
                if(!$user){
                    continue;
                }
                $user->tag_name = '';
                $user->tag_answers = 0;
                $tag = Tag::find($userTag->tag_id);
                if($tag){
                    $user->tag_name = $tag->name;
                }
                $user->tag_answers = $userTag->answers;
                $user->avatar = get_user_avatar($userTag->user_id);
                $user->url = route('auth.space.index',['user_id'=>$userTag->user_id]);
                $user->isInvited = 0;
                $users[] = $user;
            }
        }

        return $this->ajaxSuccess($users);
    }


    public function sendSmsCode(Request $request){

        if($request->isMethod('post')){
            $validateRules['code'] = 'required|captcha';
            $validator = Validator::make($request->all(),$validateRules);
            if($validator->fails()){
                return $this->ajaxError(10003,'验证码错误');
            }

            $mobile = $request->input('mobile','');
            if(!is_mobile($mobile)){
                return $this->ajaxError(10004,'手机号格式码错误');
            }
            $sendType = $request->input('send_type','');
            if($request->user() && $sendType=='bind'){ //绑定手机号绑定处理
                /*黑名单校验*/
                if( $request->user()->status == -1 ){
                    return $this->ajaxError(10011,'你无权进行该操作');
                }
                /*避免重复发送短信校验*/
                if($request->user()->mobile == $mobile && $request->user()->userData->mobile_status==1){
                    return $this->ajaxError(10008,'您的手机号已绑定，不能重复绑定');
                }
                /*已注册手机号校验*/
                if(User::where("mobile","=",$mobile)->where("id","<>",$request->user()->id)->count() > 0){
                    return $this->ajaxError(10009,'该手机号已注册，不能重复绑定');
                }
            }
            if( $sendType =='register' && User::where("mobile","=",$mobile)->count() > 0){ //注册发送处理
                return $this->ajaxError(10011,'该手机号已注册，不能重复注册');
            }else if($sendType =='findPassword' && User::where("mobile","=",$mobile)->count() == 0){ //找回密码处理
                return $this->ajaxError(10011,'该手机号不存在，请核实');
            }

            /*次数限制*/
            $sendTimes = $this->counter('send_sms_counter_'.$mobile);
            if($sendTimes > config('tipask.sms_limit_times',10)){
                return $this->ajaxError(10005,'短信验证码发送数量已超出当日最大限制，请明天再试');
            }

            if(!SmsService::sendSmsCode($mobile)){
                return $this->ajaxError(10006,'短信发送失败，请稍后再试');
            }
            $this->counter('send_sms_counter_'.$mobile,1);
            return $this->ajaxSuccess("success");
        }

        return $this->ajaxError(10007,"请求错误");
    }

}
