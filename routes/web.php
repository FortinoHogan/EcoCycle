<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [homeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('login');
});

Route::prefix('/buyer')->group(function(){

});

Route::prefix('/seller')->group(function(){

});

