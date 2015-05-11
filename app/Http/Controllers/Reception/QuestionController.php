<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2015/4/13
 * Time: 11:57
 */

namespace App\Http\Controllers\Reception;


class QuestionController extends ReceptionController
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * 问题详情查看
     */
    public function detail()
    {
        return view("theme::question.detail");
    }


    /**
     * 问题添加页面显示
     */
    public function create(){

        return view("theme::question.add");

    }


} 