<?php

/**
 * 后台路由
 */

/**后台模块**/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::get('login', 'AdminsController@showLoginForm')->name('login');  //后台登陆页面

    Route::post('login-handle', 'AdminsController@loginHandle')->name('login-handle'); //后台登陆逻辑

    Route::get('logout', 'AdminsController@logout')->name('admin.logout'); //退出登录

    /**需要登录认证模块**/
    Route::middleware(['auth:admin', 'rbac'])->group(function () {

        Route::resource('index', 'IndexsController', ['only' => ['index']]);  //首页

        Route::get('index/main', 'IndexsController@main')->name('index.main'); //首页数据分析
        Route::get('index/mainData', 'IndexsController@mainData')->name('index.mainData'); //首页数据动态获取

        Route::get('admins/status/{statis}/{admin}', 'AdminsController@status')->name('admins.status');

        Route::get('admins/delete/{admin}', 'AdminsController@delete')->name('admins.delete');

        Route::resource('admins', 'AdminsController', ['only' => ['index', 'create', 'store', 'update', 'edit']]); //管理员

        Route::get('roles/access/{role}', 'RolesController@access')->name('roles.access');

        Route::post('roles/group-access/{role}', 'RolesController@groupAccess')->name('roles.group-access');

        Route::resource('roles', 'RolesController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);  //角色

        Route::get('rules/status/{status}/{rules}', 'RulesController@status')->name('rules.status');

        Route::resource('rules', 'RulesController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);  //权限

        Route::resource('actions', 'ActionLogsController', ['only' => ['index', 'destroy']]);  //日志
        /* 礼品卡 start */
        Route::resource('giftCardType', 'GiftCardTypeController', ['only' => ['index', 'create', 'store', 'update', 'edit']]); //礼品卡类型
        Route::get('giftCardType/push/{admin}', 'GiftCardTypeController@push')->name('giftCardType.push');
        Route::get('giftCardType/explodeData', 'GiftCardTypeController@explodeData')->name('giftCardType.explodeData');

        Route::resource('gifts', 'GiftsController', ['only' => ['index', 'create', 'store', 'update', 'edit']]); //礼品卡
        Route::get('gifts/status/{statis}/{admin}', 'GiftsController@status')->name('gifts.status');
        Route::get('gifts/delete/{admin}', 'GiftsController@delete')->name('gifts.delete');

        Route::resource('giftGoods', 'GiftGoodsController', ['only' => ['index', 'create', 'store', 'update', 'edit']]); //商品
        Route::post('giftGoods/upload', 'GiftGoodsController@upload')->name('giftGoods.upload');
        Route::get('giftGoods/status/{statis}/{admin}', 'GiftGoodsController@status')->name('giftGoods.status');
        Route::get('giftGoods/delete/{admin}', 'GiftGoodsController@delete')->name('giftGoods.delete');

        Route::resource('giftGoodCats', 'GiftGoodCatsController', ['only' => ['index', 'create', 'store', 'update', 'edit']]); //商品分类
        Route::get('giftGoodCats/status/{statis}/{admin}', 'GiftGoodCatsController@status')->name('giftGoodCats.status');
        Route::get('giftGoodCats/delete/{admin}', 'GiftGoodCatsController@delete')->name('giftGoodCats.delete');

        Route::resource('giftGroup', 'GiftGroupController', ['only' => ['index', 'create', 'store', 'update', 'edit']]); //商品套餐组合
        Route::get('giftGroup/status/{statis}/{admin}', 'GiftGroupController@status')->name('giftGroup.status');
        Route::get('giftGroup/delete/{admin}', 'GiftGroupController@delete')->name('giftGroup.delete');

        Route::resource('giftCompany', 'GiftCompanyController', ['only' => ['index', 'create', 'store', 'update', 'edit']]); //公司
        Route::get('giftCompany/status/{statis}/{admin}', 'GiftCompanyController@status')->name('giftCompany.status');

        /*订单管理 start*/
        Route::resource('order', 'OrderController', ['only' => ['index']]);
        Route::get('order/status/{statis}/{admin}', 'OrderController@status')->name('order.status');

        Route::resource('express', 'ExpressController', ['only' => ['index', 'create', 'store']]); //物流
        Route::get('express/expressDetail', 'ExpressController@expressDetail')->name('express.expressDetail');

        /* 通用*/
        Route::post('{module}/{action}', function ($module, $action) {
            $class = App::make("\\App\\Http\\Controllers\\Admin\\" . $module . 'Controller');
            return $class->$action();
        });
    });
});


//前台路由
Route::group(['prefix' => 'home'], function () {
    Route::get('login', function () {
        return view('home/index/index');
    });
    Route::get('{module}/{action}', function ($module, $action) {
        return view('home/' . $module . '/' . $action);
    });
});

//接口
Route::group(['prefix' => 'mctApi'], function () {
    /*礼品卡中心*/
    Route::group(['prefix' => 'gift'], function () {
        Route::group(['namespace' => 'Api\Gift'], function () {
            Route::post('checkCard', 'CardController@checkCard');
        });
        //需要登录验证的接口
        Route::middleware(['giftLogin'])->group(function () {
            Route::group(['namespace' => 'Api\Gift'], function () {
                Route::post('add', 'CardController@add');
                Route::post('isLogin', 'CardController@isLogin');
                Route::post('goods', 'CardController@goods');
                Route::post('goodInfo', 'CardController@goodInfo');
                Route::post('list', 'CardController@list');
                Route::post('userOrder', 'CardController@userOrder');
                Route::post('expressDetail', 'CardController@expressDetail');
                Route::post('expressDetail', 'CardController@expressDetail');
                Route::post('sendSms', 'CardController@sendSms');
                Route::post('checkModile', 'CardController@checkModile');
            });
        });
    });
});