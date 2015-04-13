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

Route::get('/', 'HomeController@index');

Route::get('login','AccountController@login');
Route::get('register','AccountController@register');
Route::get('forgetPassword','AccountController@forgetPassword');

//Route::get('home', 'HomeController@index');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::Group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/','HomeController@index');
});
