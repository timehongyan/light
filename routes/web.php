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
// 前台首页
Route::get('/', function () {
    return view('home.index');
});
// 获取配置信息
Route::get('/config', function (){
	return Config::get('app.timezone');
});

//前台注册
Route::get('home/regist', 'Home\RegistController@regist');
//查看用户是否以存在
Route::get('home/checkuser', 'Home\RegistController@checkuser');
//手机验证码
Route::post('home/checkcode', 'Home\RegistController@checkcode');
Route::get('home/checknum', 'Home\RegistController@checknum');
Route::post('home/store', 'Home\RegistController@store');
//前台登录
Route::get('home/login', 'Home\RegistController@login');
//登录验证码
Route::get('home/captcha', 'Home\RegistController@captcha');
Route::post('home/dologin', 'Home\RegistController@dologin');
//退出登录
Route::get('home/logout', 'Home\RegistController@logout');

//前台
Route::group(['middleware'=>'/home/login'], function (){
	// 个人中心
	Route::get('home/geren', 'Home\GerenController@index');
	Route::post('home/usrelnfo', 'Home\GerenController@lnfo');
	// 修改个人信息
	Route::get('home/usrexglnfo', 'Home\GerenController@xglnfo');
	Route::post('home/usrexglnfo/{id}', 'Home\GerenController@xgfo');
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
	Route::get('admins/ajaxposlb','Admin\PosterController@ajaxposlb');
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
