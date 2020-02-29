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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/templates', 'TemplateController');
Route::resource('/firms', 'FirmController');
Route::get('/myfirms', 'FirmController@myfirms')->name('firms.myfirms');

Route::get('/firms/{id}/edit_details', 'FirmController@edit_details')->name('firms.edit_details');
Route::post('/firms/{id}/update_details', 'FirmController@update_details')->name('firms.update_details');
Route::get('/firms/{id}/edit_details2', 'FirmController@edit_details2')->name('firms.edit_details2');
Route::post('/firms/{id}/update_details2', 'FirmController@update_details2')->name('firms.update_details2');

Route::resource('/plans', 'PlanController');
Route::resource('/orders', 'OrderController');
Route::resource('/order_plans', 'OrderPlanController');
Route::get('/myplans', 'PlanController@myplans')->name('myplans');

Route::resource('/tags', 'TagController');

Route::get('/create_frames', 'CronController@create_frames')->name('create_frames');
Route::post('/recreate_frame', 'FrameController@recreate')->name('frame.recreate');
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');

// this will create empty frames by given order_id
Route::get('/create_frames/{id}', 'OrderController@create_frames')->name('create_frames');
