<?php

namespace App\Http\Controllers;

use App\models\Area;
use App\Models\Notification;

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




}
