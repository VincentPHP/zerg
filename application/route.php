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

//Banner控制器 路由
Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');

//Theme控制器 获取主题信息 路由
Route::get('api/:version/theme','api/:version.Theme/getSimpleList');

//Theme控制器 获取主题及商品列表 路由
Route::get('api/:version/theme/:id','api/:version.Theme/getComplexOne');

//获取商品信息 路由
Route::get('api/:version/product/recent','api/:version.Product/getRecent');

//获取分类下商品 路由
Route::get('api/:version/product/by_category','api/:version.Product/getAllInCategory');

//获取分类信息 路由
Route::get('api/:version/category/all','api/:version.Category/getAllCategories');

Route::post('api/:version/token/user','api/:version.Token/getToken');
