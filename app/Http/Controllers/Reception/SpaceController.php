<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 15/5/11
 * Time: 下午10:18
 */

namespace App\Http\Controllers\Reception;


class SpaceController extends ReceptionController{

    /**
     * 用户空间首页
     */
    public function index()
    {

        return view("theme::space.index");

    }




}