<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*前台显示部分*/
Route::Group(['namespace'=>'Reception'],function(){
    /*首页*/
    Route::get('/',['as'=>'url','uses'=>'HomeController@index']);

    /*用户账号管理，包含用户登录注册等操作*/
    Route::match(['get','post'],'login',['as'=>'login','uses'=>'AccountController@login']);
    Route::match(['get','post'],'register',['as'=>'register','uses'=>'AccountController@register']);
    Route::get('logout',['as'=>'logout','uses'=>'AccountController@logout']);
    Route::get('forgetPassword',['as'=>'forgetPassword','uses'=>'AccountController@forgetPassword']);

    /*用户个人信息修改*/
    Route::controllers([
        'profile'=>'ProfileController',
    ]);

    /*问题查看*/
    Route::get('question/{id}',['as'=>'questionDetail','uses'=>'QuestionController@detail'])->where(['id'=>'[0-9]+']);
    Route::get('question/add',['as'=>'addQuestion','uses'=>'QuestionController@create']);
    Route::post('question/add',['as'=>'StoreQuestion','uses'=>'QuestionController@store']);
    Route::get('user/{id}',['as'=>'space','uses'=>'SpaceController@index'])->where(['id'=>'[0-9]+']);

});




/*后台管理部分处理*/

Route::Group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/',['as'=>'admin','uses'=>'DashboardController@getindex']);
    Route::match(['get','post'],'login',['as'=>'login','uses'=>'AccountController@login']);
    Route::controllers([
        'dashboard'=>'DashboardController',
        'user'=>'UserController',
        'role'=>'RoleController',
        'permission'=>'PermissionController',
        'menu'=>'MenuController',
    ]);
});


