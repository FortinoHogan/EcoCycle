<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\ecoforumController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShopController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [homeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('login');
});

Route::get('/profile', [profileController::class, 'index'])->name('profile');

Route::resource('ecoforum',ecoforumController::class);


Route::prefix('/buyer')->group(function(){

});

Route::prefix('/seller')->group(function(){

});

Route::get('/payment/snap-token', [PaymentController::class, 'snapToken']);
Route::get('/payment', [PaymentController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);

