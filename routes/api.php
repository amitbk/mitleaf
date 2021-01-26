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


Route::middleware('auth')->resource('posts', 'PostController');
Route::middleware('auth')->get('templates', 'TemplateController@index');
Route::middleware('auth')->get('plans', 'PlanController@index');
