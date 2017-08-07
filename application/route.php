<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

//设置路由公共参数 路由分组
Route::group('api/:version', function()
{
    //Banner控制器
    Route::get('/banner/:id','api/:version.Banner/getBanner');

    //主题组
    Route::group('/theme', function ()
    {
        //Theme控制器 获取主题信息
        Route::get('','api/:version.Theme/getSimpleList');

        //Theme控制器 获取主题及商品列表
        Route::get('/:id','api/:version.Theme/getComplexOne',[],['id'=>'\d+']);
    });

    //商品组
    Route::group('/product',function()
    {
        //获取某个商品详细信息
        Route::get('/:id','api/:version.Product/getOne',[],['id'=>'\d+']);

        //获取分类下商品
        Route::get('/by_category','api/:version.Product/getAllInCategory');

        //获取商品信息
        Route::get('/recent','api/:version.Product/getRecent');
    });

    //获取分类信息
    Route::get('/category/all','api/:version.Category/getAllCategories');

    //获取Token
    Route::post('/token/user','api/:version.Token/getToken');

    //创建或更新地址
    Route::post('/address','api/:version.Address/createOrUpdateAddress');

    //用户下单
    Route::post('/order','api/:version.Order/placeOrder');

    //订单详细信息
    Route::get('/order/:id', 'api/:version.Order/getDetail',[],['id'=>'\d+']);

    //订单简要信息
    Route::get('/order/by_user','api/:version.Order/getSummaryByUser');

    //支付组
    Route::group('/pay', function()
    {
        //订单预支付
        Route::post('/pre_order','api/:version.Pay/getPreOrder');

        //支付XDebug调试重定向
        Route::post('/notify', 'api/:version.Pay/receiveNotify');

        //订单支付重定向通知
        Route::post('/re_notify', 'api/:version.Pay/redirectNotify');
    });






});
