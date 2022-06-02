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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
    Route::get('/', 'App\Http\Controllers\PostController@index')->name('index');
    Route::get('create', 'App\Http\Controllers\PostController@newPost')->name('newPost');
    Route::post('create', 'App\Http\Controllers\PostController@create')->name('create');
    Route::get('show/{id}', 'App\Http\Controllers\PostController@show')->name('show');
    Route::get('s', 'App\Http\Controllers\PostController@list')->name('list');
});
