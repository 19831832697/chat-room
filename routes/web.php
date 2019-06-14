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

Route::get('reg','user\UserController@reg');//注册视图
Route::get('login','user\UserController@login');//登录视图
Route::post('regDo','user\UserController@regDo');//注册执行
Route::post('loginDo','user\UserController@loginDo');//登录执行
Route::get('chat','chat\ChatController@chat');
Route::post('chatDo','chat\ChatController@chatDo');
Route::post('getMessage','chat\ChatController@getMessage');
Route::get('index','chat\ChatController@index');

Route::get('insert','mongo\MongoController@insert');//添加
Route::get('show','mongo\MongoController@show');//展示
Route::get('update','mongo\MongoController@update');//修改
Route::get('del','mongo\MongoController@del');//删除
Route::get('insertAll','mongo\MongoController@insertAll');//循环添加数据
Route::get('a','mongo\MongoController@a');//循环添加数据