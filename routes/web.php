<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\buyerController;
use App\Http\Controllers\sellerController;

Route::get('/', [homeController::class, 'index'])->name('home.view');

Route::prefix('/buyer')->group(function(){
    Route::get('/logout', [buyerController::class, 'logout_personal'])->name('logout_buyer');

    Route::get('/login', [buyerController::class, 'index_login_personal'])->name('buyerLogin.view');
    Route::post('/login', [buyerController::class, 'login_personal'])->name('login_buyer.post');

    Route::get('/register', [buyerController::class, 'index_register_personal'])->name('buyerRegister.view');
    Route::post('/register', [buyerController::class, 'register_personal'])->name('register_buyer.post');

    Route::get('/profile', [buyerController::class, 'index'])->name('buyerProfile');
});

Route::prefix('/seller')->group(function(){
    Route::get('/logout', [sellerController::class, 'logout_personal'])->name('logout_seller');

    Route::get('/login', [sellerController::class, 'index_login_personal'])->name('sellerLogin.view');
    Route::post('/login', [sellerController::class, 'login_personal'])->name('login_seller.post');

    Route::get('/register', [sellerController::class, 'index_register_personal'])->name('sellerRegister.view');
    Route::post('/register', [sellerController::class, 'register_personal'])->name('register_seller.post');
});

