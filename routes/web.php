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

Route::prefix('back')->group(function(){
    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/index','Admin\IndexController');
    Route::resource('/user','Admin\UserController');
    Route::resource('/category','Admin\CategoryController');
    Route::resource('/banner','Admin\BannerController');
    Route::resource('/photoWall','Admin\PhotoWallController');
});


