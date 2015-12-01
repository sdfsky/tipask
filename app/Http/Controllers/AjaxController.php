<?php

namespace App\Http\Controllers;

use App\models\Area;

class AjaxController extends BaseController
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

}
