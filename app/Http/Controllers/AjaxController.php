<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $total = Message::where('to_user_id','=',Auth()->user()->id)->where('is_read','=',0)->count();
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
        $tags = Tag::where('name','like',$word.'%')->select('id',DB::raw('name as text'))->take(10)->get();
        $tags->map(function($tag){
            $tag->id = $tag->text;
        });

        return response()->json($tags->toArray());
    }



    public function loadUsers(Request $request)
    {
        $word = $request->input('word');

        $users = User::where('id','<>',$request->user()->id)->where('name','like',"$word%")->take(10)->get();
        $users->map(function($user){
            $user->avatar = route('website.image.avatar',['avatar_name'=>$user->id.'_middle']);
            $user->coins = $user->userData->coins;
            $user->answers = $user->userData->answers;
            $user->followers = $user->userData->followers;
        });
        return response()->json($users->toArray());
    }




}
