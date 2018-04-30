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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::post('register', 'Auth\RegisterController@create')->name('register');
Route::post('login', 'Auth\LoginController@login')->name('login')->middleware('AdminLogin');

Route::prefix('admin')->middleware('AdminPanel')->group(function() {
    Route::post('logout', 'AdminController@logout')->name('admin.logout');

    Route::get('/', 'RequestController@newRequests')->name('admin.index');

});