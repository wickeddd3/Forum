<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->middleware('guest');

Auth::routes(['verify' => true]);

Route::get('/threads', 'ThreadController@index');
Route::get('/threads/{channel}', 'ThreadController@index');
Route::get('/thread/create', 'ThreadController@create');
Route::post('/threads', 'ThreadController@store');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show');
Route::get('/threads/{channel}/{thread}/edit', 'ThreadController@edit');
Route::put('/threads/{channel}/{thread}/update', 'ThreadController@update');

Route::put('/threads/{channel}/{thread}/bestreply', 'ThreadController@markAsBestReply');
Route::put('/threads/{channel}/{thread}/closethread', 'ThreadController@closeThread');
Route::put('/threads/{channel}/{thread}/openthread', 'ThreadController@openThread');

Route::post('/threads/{channel}/{thread}/follows', 'ThreadFollowController@index')->middleware('auth');
Route::delete('/threads/{channel}/{thread}/follows', 'ThreadFollowController@destroy')->middleware('auth');

Route::get('/threads/{channel}/{thread}/replies', 'ReplyController@index');
Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store');
Route::patch('/replies/{reply}', 'ReplyController@update');
Route::delete('/replies/{reply}', 'ReplyController@destroy');

Route::post('/replies/{reply}/likes', 'LikeController@store');
Route::delete('/replies/{reply}/likes', 'LikeController@destroy');

Route::post('/profile', 'ProfileController@store')->name('profile.store');
Route::get('/{username}/profile', 'ProfileController@index')->name('profile.index');
Route::post('/{username}/profile', 'ProfileController@profile')->name('profile');

Route::get('/{username}/notifications', 'UserNotificationController@notifications');
Route::get('/profiles/{user}/notifications', 'UserNotificationController@index');
Route::post('/profiles/{user}/notifications', 'UserNotificationController@destroy');
