<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 获取配置信息
Route::get('/config', function (){
	return Config::get('app.timezone');
});



//后台登录
Route::get('/admins/login', 'Admin\LoginController@login');
Route::post('admins/dologin', 'Admin\LoginController@dologin');
Route::get('admins/captcha', 'Admin\LoginController@captcha');


//后台管理
//后台中间件
Route::group(['middleware'=>'/admins/login'], function (){
	//后台首页
	Route::any('/admins', 'Admin\IndexController@index');


	//后台用户
	Route::resource('/admins/user', 'Admin\UserController');
	//修改头像
	Route::get('admins/header', 'Admin\LoginController@header');
	Route::post('admins/upload', 'Admin\LoginController@upload');
	//修改密码
	Route::get('admins/pass', 'Admin\LoginController@pass');
	Route::post('admin/dopass', 'Admin\LoginController@dopass');
	//后台退出
	Route::get('admins/logout', 'Admin\LoginController@logout');


	//用户详情
	Route::get('admins/user/info/{id}', 'Admin\InfoController@create');
	Route::post('admins/user/store', 'Admin\InfoController@store');
	Route::get('admins/user/edit/{id}', 'Admin\InfoController@edit');
	Route::any('admins/users/infoupdate', 'Admin\InfoController@infoupdate');
	//修改用户图片
	Route::get('admins/users/header/{id}', 'Admin\InfoController@header');
	Route::post('admins/users/uploads', 'Admin\InfoController@uploads');
	//ajax修改状态
	Route::get('admins/ajaxs', 'Admin\AjaxController@ajaxs');
	Route::get('admins/alink', 'Admin\AjaxController@alink');


	//角色管理
	Route::resource('admins/role', 'Admin\RoleController');


	//商品分类查看
	Route::resource('/admin/type', 'Admin\TypeController');
	// 分类状态路由
	Route::get('/admin/ajaxup', 'Admin\TypeController@ajaxup');


	// ajax请求路由
	//商品名称无刷新修改
	Route::get('/admin/goods/ajaxgs', 'Admin\GoodsController@ajaxgs');
	//商品图片ajax删除
	Route::get('/admin/goods/ajaxdelete', 'Admin\GoodsController@ajaxdelete');
	//商品详情
	Route::resource('/admin/goods', 'Admin\GoodsController');
	//广告管理
	Route::resource('admins/poster','Admin\PosterController');
	Route::get('admins/ajaxposter','Admin\PosterController@ajaxposter');
	//订单管理
	Route::resource('admins/orders','Admin\OrdersController');
	Route::get('admins/ajaxorders','Admin\OrdersController@ajaxorders');
	//订单详情
	Route::get('admins/detail/{oid}','Admin\OrdersController@detail');
	//后台友情链接
	Route::resource('admin/link','Admin\LinkController');
	//轮播图
	Route::resource('admin/lunbo','Admin\LunboController');
});




// 前台首页
Route::get('/','Home\IndexController@index');

Route::group([], function (){
	//前台友情链接
	Route::get('home/link', 'Home\LinkController@index');
	Route::get('home/create', 'Home\LinkController@create');
	Route::post('home/store', 'Home\LinkController@store');
	Route::get('home/link/list', 'Home\LinkController@list');
	//购物车
	Route::get('home/cart','Home\CartController@cartinfo');
	Route::post('/home/remcart','Home\CartController@remcart');

});