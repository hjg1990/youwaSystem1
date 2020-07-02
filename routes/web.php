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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //后台登录路由
    Route::get('login','LoginController@login');
    //验证码路由
    Route::get('code','LoginController@code');
    //处理后台登录验证路由
    Route::post('dologin','LoginController@doLogin');
});

//路由后台组  定义中间件
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'isLogin'],function(){
    //后台首页路由
    Route::get('index','LoginController@index');
    //后台欢迎页面
    Route::get('welcome','LoginController@welcome');
    //后台退出登录路由
    Route::get('logout','LoginController@logout');

    //自定义根据多个管理员id删除多条数据
    Route::get('supervisor/dell','SupervisorController@dellALL');
    //管理员路由
    Route::resource('supervisor','SupervisorController');
    //角色路由
    Route::resource('role','RoleController');




    //自定义根据多个id删除多条数据
    Route::get('user/dell','UserController@dellALL');
    //后台用户模块相关路由
    Route::resource('user','UserController');
});
//加密算法
//  Route::get('admin/jiami','Admin\LoginController@jiami');

