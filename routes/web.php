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

Auth::routes();

Route::post('register', 'Auth\RegisterController@create')->name('register');
Route::post('login', 'Auth\LoginController@login')->name('login')->middleware('AdminLogin');

Route::get('resetPassword', 'Auth\ResetPassword@view')->name('resetPassword')->middleware('guest');
Route::post('resetPassword', 'Auth\ResetPassword@reset')->name('resetPassword')->middleware('guest');

Route::prefix('admin')->middleware('AdminPanel')->group(function() {
    Route::post('logout', 'Admin\AdminController@logout')->name('admin.logout');

    Route::get('/', 'ApplicationController@newApplications')->name('admin.index');

    Route::get('/application/{id}', 'ApplicationController@view')->name('admin.application.view.level');
    Route::post('/application/{id}', 'ApplicationController@updateApplication')->name('admin.updateApplication');

    Route::get('/applications', 'ApplicationController@getApplications')->name('admin.applications');

    Route::get('/engineers', 'Admin\EngineerController@index')->name('admin.engineers');

    Route::get('/engineers/add', 'Admin\EngineerController@add')->name('admin.engineers.new');
    Route::post('/engineers/create', 'Admin\EngineerController@create')->name('admin.engineers.create');

    Route::get('/engineers/edit/{id}', 'Admin\EngineerController@edit')->name('admin.engineers.edit');
    Route::post('/engineers/update/{id}', 'Admin\EngineerController@update')->name('admin.engineers.update');

    Route::post('/engineers/update/password/{id}', 'Admin\EngineerController@updatePassword')->name('admin.engineers.update.password');

    Route::get('/users', 'Admin\AdminController@getUsers')->name('admin.users');
    Route::get('/application/{id}', 'ApplicationController@getApplication')->name('admin.application.view');

});

Route::prefix('engineer')->middleware(['auth', 'DistributionGroups'])->group(function() {
    Route::get('/', 'Engineer\MainController@index')->name('engineer.index');

    Route::get('/acceptApplication/{id}', 'Engineer\MainController@accept')->name('engineer.application.accept');
    Route::get('/completeApplication/{id}', 'Engineer\MainController@complete')->name('engineer.application.complete');
    Route::get('/resumeApplication/{id}', 'Engineer\MainController@resume')->name('engineer.application.resume');
    Route::get('/cancelApplication/{id}', 'Engineer\MainController@cancel')->name('engineer.application.cancel');

    Route::get('/application/{id}', 'ApplicationController@getApplication')->name('engineer.application.view');

    Route::get('/myApplications', 'Engineer\MainController@myApplications')->name('engineer.application.my');

    Route::get('/profile', 'UserController@profile')->name('engineer.profile');
    Route::post('/profile/update', 'UserController@updateProfile')->name('engineer.profile.update');
    Route::post('/profile/update/password', 'UserController@updatePassword')->name('engineer.profile.update.password');
});

Route::prefix('')->middleware(['auth', 'DistributionGroups'])->group(function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/request', 'HomeController@showRequestFormAdd')->name('user.newApplication');
    Route::post('/request', 'ApplicationController@create')->name('user.createApplication');

    Route::get('/profile', 'UserController@profile')->name('user.profile');
    Route::post('/profile/update', 'UserController@updateProfile')->name('user.profile.update');
    Route::post('/profile/update/password', 'UserController@updatePassword')->name('user.profile.update.password');
});


Route::get('test', 'HomeController@index');