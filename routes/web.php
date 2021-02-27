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


Route::get('/test', 'HomeController@test')->name('test');

Auth::routes();

// admin
Route::get('/fly', 'AdminController@dashboard')->name('admin');
Route::resource('fly/users', 'UserController');
Route::get('fly/users/{id}/revoke', 'UserController@revoke');
Route::get('fly/templates', 'TemplateController@admin')->name('admin.templates');
Route::get('fly/orders', 'OrderController@admin')->name('admin.orders');
Route::get('fly/designers', 'UserController@designers')->name('admin.designers');
Route::get('fly/needs', 'AdminController@needs')->name('admin.needs');


// user start trial process
Route::get('/start', 'TrialController@start')->name('start');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/profile', 'UserController@profile')->name('profile');
Route::resource('/templates', 'TemplateController');

Route::get('firms/{firm_id}/add_fb_page', 'FirmController@add_fb_page')->name('firms.add_fb_page');
Route::post('firms/update_fb_page', 'FirmController@update_fb_page')->name('firms.update_fb_page');
Route::resource('/firms', 'FirmController');
Route::get('/myfirms', 'FirmController@myfirms')->name('firms.myfirms');
Route::get('/firms/{id}/plans', 'FirmController@plans')->name('firms.plans');

Route::post('/payment_callback', 'OrderController@payment_callback');


Route::get('/firms/{id}/edit_assets/{asset_type_id}', 'FirmController@edit_assets')->name('firms.edit_assets');
Route::post('/firms/{id}/update_assets', 'FirmController@update_details')->name('firms.update_assets');
// Route::get('/firms/{id}/edit_details2', 'FirmController@edit_details2')->name('firms.edit_details2');
// Route::post('/firms/{id}/update_details2', 'FirmController@update_details2')->name('firms.update_details2');

Route::resource('/plans', 'PlanController');
Route::resource('/orders', 'OrderController');
Route::resource('/order_plans', 'OrderPlanController');
Route::get('/myplans', 'PlanController@myplans')->name('myplans');

Route::resource('/tags', 'TagController');

Route::get('/create_posts', 'CronController@create_posts')->name('create_posts');
Route::post('/recreate_post', 'PostController@recreate')->name('post.recreate');
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');

// CRON JOBS::
// this will create empty posts by given order_id
Route::get('/create_post_schedules', 'OrderController@create_post_schedules')->name('create_post_schedules');
Route::get('/generate_post_images', 'CronController@generate_post_images')->name('generate_post_images');
Route::get('/post_to_social_media', 'CronController@post_to_social_media')->name('post_to_social_media');


Route::get('/social_networks', 'SocialNetworkController@index')->name('social_networks');

// social login
Route::get('/redirect/{social_network}', 'SocialNetworkController@redirect')->name('redirect');
Route::get('/callback/{social_network}', 'SocialNetworkController@callback')->name('callback');
Route::get('/facebook/publish_to_page', 'SocialMedia\GraphController@publish_to_page');
Route::get('/facebook/pages', 'SocialMedia\GraphController@get_pages');

Route::get('/facebook/connect_pages', 'SocialNetworkController@connect_pages');
Route::get('/facebook/update_pages', 'SocialMedia\GraphController@update_pages')->name('update_pages');

// test routes
Route::get('/test_mail', 'TestController@mail');
Route::get('/test_event', 'TestController@event');
Route::get('/test_sms', 'TestController@sms');
