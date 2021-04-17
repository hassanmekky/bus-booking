<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CityController;

Route::get('login',[AdminAuthController::class, 'getLogin'])->name('adminLogin');
Route::post('login', 'AdminAuthController@postLogin')->name('adminLoginPost');
Route::get('logout', 'AdminAuthController@logout')->name('adminLogout');


// authenticated routes 
Route::group(['middleware' => 'adminauth'], function () {

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('adminDashboard');
Route::resource('cities', 'CityController')->only(['index','store','update','destroy']);

});