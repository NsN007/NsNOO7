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

//搭建后台模板
Route::get('/admin','AdminController@index');

//用户模块
Route::controller('/admin/user','UserController');

//分类模块
Route::controller('/admin/cate','CateController');

Event::listen('illuminate.query',function($query){
     var_dump($query);
 });
