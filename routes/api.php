<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('login','LoginController@login');

Route::get('available_seats','ReservationController@available_seats');

Route::middleware('auth:api')->group(function () {
    Route::post('book_seat','ReservationController@book_seat');
});
