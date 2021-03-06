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
    return view('welcome');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/tweets', 'TweetsController@index')->name('home');
    Route::post('/tweets', 'TweetsController@store');
    Route::post('/tweets/{tweet}/like','TweetLikesController@store');
    Route::delete('/tweets/{tweet}/like','TweetLikesController@destroy');
    Route::delete('/tweets/{tweet}/tweet','TweetsController@destroy');
    Route::post('/profile/{user:username}/follow', 'FollowsController@store')->name('follow');
    Route::get('/profile/{id}/followers_notify', 'FollowersNotificationController@show')->name('followers_notify');
    //Route::get('/profile/{id}/read_notify', 'FollowersNotificationController@read')->name('read_notify');
    Route::get('/profile/{user:username}/edit', 'ProfilesController@edit');
    Route::patch('/profile/{user:username}', 'ProfilesController@update')->middleware('can:edit,user');
    //Route::get('/profile/{user:name}/edit', 'ProfilesController@edit')->middleware('can:edit,user');
    Route::get('/explore','ExploreController');
    Route::get('/messages','MessagesController')->name('messages');
});
Route::get('/profile/{user:username}','ProfilesController@show')->name('profile');

//Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

