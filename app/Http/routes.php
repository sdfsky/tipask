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
    /*我的金币*/
    Route::get('people/{user_id}/coins',['as'=>'auth.space.coins','uses'=>'SpaceController@coins'])->where(['user_id'=>'[0-9]+']);
    /*我的经验*/
    Route::get('people/{user_id}/credits',['as'=>'auth.space.credits','uses'=>'SpaceController@credits'])->where(['user_id'=>'[0-9]+']);


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

        /*我的通知*/

        Route::controller('notifications','NotificationController',[
            'getIndex' => 'auth.notification.index',
            'getReadAll' => 'auth.notification.readAll',
        ]);


        /*收藏问题、文章*/

        Route::get('collect/{source_type}/{source_id}',['as'=>'auth.collection.store','uses'=>'CollectionController@store'])->where(['source_type'=>'(question|article)','source_id'=>'[0-9]+']);
        Route::get('collection/{source_type}',['as'=>'auth.collection.sources','uses'=>'CollectionController@sources'])->where(['source_type'=>'(questions|articles)']);

        /*关注问题、人、标签*/
        Route::get('follow/{source_type}/{source_id}',['as'=>'auth.attention.store','uses'=>'AttentionController@store'])->where(['source_type'=>'(question|tag|article)','source_id'=>'[0-9]+']);
        Route::get('attention/{source_type}',['as'=>'auth.attention.sources','uses'=>'AttentionController@sources'])->where(['source_type'=>'(questions|tags|articles)']);


    });





});

/*前台显示部分*/
Route::Group(['namespace'=>'Ask'],function(){


    /*动态*/
    Route::get('doings/{name?}',['as'=>'ask.doing.index','uses'=>'DoingsController@index'])->where(['name'=>'[all]?']);

    /*全局搜索*/
    Route::get('search',['as'=>'ask.search.index','uses'=>'SearchController@index']);

    /*问题查看*/
    Route::get('question/{id}',['as'=>'ask.question.detail','uses'=>'QuestionController@detail'])->where(['id'=>'[0-9]+']);
    Route::get('question/create',['as'=>'ask.question.create','uses'=>'QuestionController@create']);
    Route::post('question/store',['middleware' =>'auth','as'=>'ask.question.store','uses'=>'QuestionController@store']);

    /*问题修改*/
    Route::get('question/edit/{id}',['as'=>'ask.question.edit','uses'=>'QuestionController@edit'])->where(['id'=>'[0-9]+']);
    Route::post('question/update',['as'=>'ask.question.update','uses'=>'QuestionController@update']);

    Route::post('answer/store',['middleware' =>'auth','as'=>'ask.answer.store','uses'=>'AnswerController@store']);

    /*标签模块*/
    Route::get('topic/{name}',['as'=>'ask.tag.index','uses'=>'TagController@index']);



    /*评论模块*/
    Route::post('comment/store',['middleware' =>'auth','as'=>'ask.comment.store','uses'=>'CommentController@store']);
    Route::get('{source_type}/{source_id}/comments',['as'=>'ask.comment.show','uses'=>'CommentController@show'])->where(['source_type'=>'(question|answer|article)','source_id'=>'[0-9]+']);


});


/*后台管理部分处理*/
Route::Group(['prefix'=>'admin','namespace'=>'Admin','middleware' =>'auth'],function(){


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
    Route::any('setting/credits',['as'=>'admin.setting.credits','uses'=>'SettingController@credits']);






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
Route::get('image/show/{image_name}',['as'=>'website.image.show','uses'=>'ImageController@show']);

Route::Group(['middleware'=>'auth'],function(){
    Route::post('image/upload',['as'=>'website.image.upload','uses'=>'ImageController@upload']);
});
