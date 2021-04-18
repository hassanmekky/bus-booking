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

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {

Route::get('trip/{id}/reserve','BookingController@reserve');
Route::post('trip/{id}/reserve','BookingController@post_reserve');
Route::get('/home','HomeController@home');
});
