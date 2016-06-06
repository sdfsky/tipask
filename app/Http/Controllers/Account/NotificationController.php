<?php

namespace App\Http\Controllers\Account;

use App\Models\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class NotificationController extends Controller
{
    /**
     * 显示用户通知
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        $notifications = Notification::where('to_user_id',$request->user()->id)->orderBy('created_at','DESC')->paginate(10);
        $notifications->map(function($notification){
          $notification->type_text = Config::get('tipask.notification_types.'.$notification->type);
        });
        $this->readNotifications(0,'user');
        return view('theme::notification.index')->with('notifications',$notifications);
    }


    public function getReadAll()
    {
        Notification::where('to_user_id','=',Auth()->user()->id)->where('is_read','=',0)->update(['is_read'=>1]);
        return $this->success(route('auth.notification.index'),'设置成功');
    }







}
