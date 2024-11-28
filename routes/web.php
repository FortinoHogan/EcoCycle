<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\ecoforumController;

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

