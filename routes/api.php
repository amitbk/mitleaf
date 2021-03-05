<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/amit', function (Request $request) {
    return Auth::user();
    return $request->user();
});

Route::get('sessions1', 'HomeController@sessions');


Route::resource('posts', 'PostController');
Route::get('templates', 'TemplateController@index');
Route::get('plans', 'PlanController@index');

// create post from ui for user
Route::post('create_frame_by_template', 'PostController@create_frame_by_template');
Route::post('create_frame_by_userimage', 'PostController@create_frame_by_userimage');
