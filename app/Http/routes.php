<?php


/*首页*/
Route::get('/',['as'=>'website.index','uses'=>'IndexController@index']);


/*用户账号管理，包含用户登录注册等操作*/
Route::Group(['namespace'=>'Account'],function(){
    Route::match(['get','post'],'login',['as'=>'auth.user.login','uses'=>'UserController@login']);
    Route::match(['get','post'],'register',['as'=>'auth.user.register','uses'=>'UserController@register']);
    Route::get('logout',['as'=>'auth.user.logout','uses'=>'UserController@logout']);
    Route::get('forgetPassword',['as'=>'auth.user.forgetPassword','uses'=>'UserController@forgetPassword']);

    /*用户空间首页*/
    Route::get('people/{user_id}',['as'=>'auth.space.index','uses'=>'SpaceController@index'])->where(['user_id'=>'[0-9]+']);
    /*我的提问*/
    Route::get('people/{user_id}/questions',['as'=>'auth.space.questions','uses'=>'SpaceController@questions'])->where(['user_id'=>'[0-9]+']);
    /*我的回答*/
    Route::get('people/{user_id}/answers',['as'=>'auth.space.answers','uses'=>'SpaceController@answers'])->where(['user_id'=>'[0-9]+']);


    Route::Group(['middleware'=>'auth'],function(){
        /*用户个人信息修改*/
        Route::controller('profile','ProfileController', [
            'anyBase'     => 'auth.profile.base',
            'postAvatar'  => 'auth.profile.avatar',
            'anyPassword' =>'auth.profile.password',
            'anyEmail'    =>'auth.profile.email',
            'anyMobile'   =>'auth.profile.mobile',
            'anyOauth'    =>'auth.profile.oauth',
            'anyNotification' =>'auth.profile.notification',
        ]);

    });





});

/*前台显示部分*/
Route::Group(['namespace'=>'Ask'],function(){


    /*问题查看*/
    Route::get('question/{id}',['as'=>'ask.question.detail','uses'=>'QuestionController@detail'])->where(['id'=>'[0-9]+']);
    Route::get('question/create',['as'=>'ask.question.create','uses'=>'QuestionController@create']);
    Route::post('question/store',['as'=>'ask.question.store','uses'=>'QuestionController@store']);
    Route::post('answer/store',['as'=>'ask.answer.store','uses'=>'AnswerController@store']);
    /*标签模块*/
    Route::get('topic/{name}',['as'=>'ask.tag.index','uses'=>'TagController@index']);

});


/*后台管理部分处理*/
Route::Group(['prefix'=>'admin','namespace'=>'Admin','middleware' => ['auth']],function(){


    /*用户登陆*/
    Route::match(['get','post'],'login',['as'=>'admin.account.login','uses'=>'AccountController@login']);

    /*用户退出*/
    Route::get('logout',['as'=>'admin.account.logout','uses'=>'AccountController@logout']);

    /*首页*/
    Route::resource('index', 'IndexController', ['only' => ['index']]);
    Route::get('index/sidebar',['as'=>'sidebar','uses'=>'IndexController@sidebar']);

    /*权限管理*/
    Route::resource('permission', 'PermissionController',['except' => ['show']]);

    /*角色管理*/
    Route::resource('role', 'RoleController',['except' => ['show']]);
    Route::post('role/permission',['as'=>'admin.role.permission','uses'=>'RoleController@permission']);

    /*用户管理*/
    Route::resource('user', 'UserController',['except' => ['show']]);

    /*站点设置*/
    Route::any('setting/website',['as'=>'admin.setting.website','uses'=>'SettingController@website']);
    /*时间设置*/
    Route::any('setting/time',['as'=>'admin.setting.time','uses'=>'SettingController@time']);
    /*积分设置*/
    Route::any('setting/credit',['as'=>'admin.setting.credit','uses'=>'SettingController@credit']);






//
//    Route::controllers([
//        'dashboard'=>'DashboardController',
//        'user'=>'UserController',
//        'role'=>'RoleController',
//        'permission'=>'PermissionController',
//        'menu'=>'MenuController',
//    ]);

   // Route::get('dashboard',['as'=>'admin.dashboard.index','uses'=>'DashboardController@getIndex']);

});


/*公共ajax异步加载*/
Route::get('ajax/loadCities/{province_id}',['as'=>'website.ajax.loadCities','uses'=>'AjaxController@loadCities'])->where(['province_id'=>'[0-9]+']);
Route::get('image/avatar/{avatar_name}',['as'=>'website.image.avatar','uses'=>'ImageController@avatar'])->where(['avatar_name'=>'[0-9]+_(small|big|middle)']);


