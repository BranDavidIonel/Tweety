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
    Route::post('/profile/{user:name}/follow', 'FollowsController@store');
    Route::get('/profile/{user:name}/edit', 'ProfilesController@edit');
    //Route::get('/profile/{user:name}/edit', 'ProfilesController@edit')->middleware('can:edit,user');
});
Route::get('/profile/{user:name}','ProfilesController@show')->name('profile');
//Route::get('/profiles/{user:name}', 'ProfilesController@show')->name('profile');
//Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

