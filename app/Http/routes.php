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


/*公共路由*/
Route::get('/',['as'=>'url','uses'=>'HomeController@index']);
Route::get('login',['as'=>'login','uses'=>'AccountController@login']);
Route::get('register',['as'=>'register','uses'=>'AccountController@register']);
Route::get('forgetPassword',['as'=>'forgetPassword','uses'=>'AccountController@forgetPassword']);


/*问题相关*/
Route::get('question/{id}',['as'=>'questionDetail','uses'=>'QuestionController@detail'])->where(['id'=>'[0-9]+']);







Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::Group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/','HomeController@index');
});


