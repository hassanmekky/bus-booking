<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;

Route::get('login',[AdminAuthController::class, 'getLogin'])->name('adminLogin');
Route::post('login', 'AdminAuthController@postLogin')->name('adminLoginPost');
Route::get('logout', 'AdminAuthController@logout')->name('adminLogout');


// authenticated routes 	
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');