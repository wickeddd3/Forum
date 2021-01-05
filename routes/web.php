<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Auth::routes();

Route::get('/threads', 'ThreadsController@index');
Route::get('/threads/{channel}', 'ThreadsController@index');
Route::get('/thread/create', 'ThreadsController@create');
Route::post('/threads', 'ThreadsController@store');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show');
Route::get('/threads/{channel}/{thread}/edit', 'ThreadsController@edit');
Route::put('/threads/{channel}/{thread}/update', 'ThreadsController@update');

Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::patch('/replies/{reply}', 'RepliesController@update');
Route::delete('/replies/{reply}', 'RepliesController@destroy');

Route::post('/profile', 'ProfilesController@store')->name('profile.store');
Route::get('/{username}/profile', 'ProfilesController@index')->name('profile.index');
Route::post('/{username}/profile', 'ProfilesController@profile')->name('profile');

Route::post('/threads/{channel}/{thread}/follows', 'ThreadFollowsController@index')->middleware('auth');
Route::delete('/threads/{channel}/{thread}/follows', 'ThreadFollowsController@destroy')->middleware('auth');

Route::post('/replies/{reply}/likes', 'LikesController@store');
Route::delete('/replies/{reply}/likes', 'LikesController@destroy');

Route::get('/{username}/notifications', 'UserNotificationsController@notifications');
Route::get('/profiles/{user}/notifications', 'UserNotificationsController@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy');
