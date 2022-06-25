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

Route::get('/', 'App\Http\Controllers\PostController@list')->name('welcome');

/**
 * /login -> login page
 */
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'login' => false,
    'confirm' => false
]);

/**
 * Customize auth
 */
Route::get('login/{key}', 'App\Http\Controllers\AuthController@showLoginForm')->name('showLoginForm');
Route::post('login/{key}', 'App\Http\Controllers\AuthController@login')->name('login');
Route::get('password/confirm/{key}', 'App\Http\Controllers\AuthController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm/{key}', 'App\Http\Controllers\AuthController@confirm');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
    Route::get('/', 'App\Http\Controllers\PostController@list')->name('index');
    Route::get('create', 'App\Http\Controllers\PostController@newPost')->name('newPost')->middleware('auth');
    Route::post('create', 'App\Http\Controllers\PostController@create')->name('create')->middleware('auth');
    Route::get('show/{id}', 'App\Http\Controllers\PostController@show')->name('show');
    Route::get('s', 'App\Http\Controllers\PostController@list')->name('list');
    Route::get('edit/{id}', 'App\Http\Controllers\PostController@edit')->name('edit')->middleware('auth');
    Route::post('{id}', 'App\Http\Controllers\PostController@update')->name('update')->middleware('auth');
    Route::delete('{id}', 'App\Http\Controllers\PostController@delete')->name('delete')->middleware('auth');
});
