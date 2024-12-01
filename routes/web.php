<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\buyerController;
use App\Http\Controllers\sellerController;

use App\Http\Controllers\ecoforumController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\EcoLearningController;

Route::get('/', [homeController::class, 'index'])->name('home.view');

Route::resource('ecoforum', ecoforumController::class);

Route::prefix('/buyer')->group(function(){
    Route::get('/logout', [buyerController::class, 'logout_personal'])->name('logout_buyer');

    Route::get('/login', [buyerController::class, 'index_login_personal'])->name('buyerLogin.view');
    Route::post('/login', [buyerController::class, 'login_personal'])->name('login_buyer.post');

    Route::get('/register', [buyerController::class, 'index_register_personal'])->name('buyerRegister.view');
    Route::post('/register', [buyerController::class, 'register_personal'])->name('register_buyer.post');

    Route::get('/profile', [buyerController::class, 'index'])->name('buyerProfile');

    Route::get('/shop', [ShopController::class, 'index'])->name('shop.view');

    Route::post('/detail/{product_id}', [TransactionController::class, 'detail_product'])->name("detail");
    Route::post('/cart/add', [TransactionController::class, 'add_to_cart'])->name('add-to-cart');
    Route::post('/cart/update-quantity', [TransactionController::class, 'update_quantity'])->name('update-quantity');
    Route::post('/cart/remove', [TransactionController::class, 'remove_from_cart'])->name('remove-from-cart');
    Route::get('/success', [PaymentController::class, 'success'])->name("checkout-success");
    Route::post('/checkout/{product_id}', [PaymentController::class, 'process'])->name("checkout-process");
    Route::get('/cart', [TransactionController::class, 'cart'])->name("cart");
    Route::get('/success', [PaymentController::class, 'success'])->name("checkout-success");
    Route::get('/payment', [PaymentController::class, 'index']);

    Route::get('/ecolearning', [EcoLearningController::class, 'index'])->name('ecolearning');

    Route::get('/profile', [buyerController::class, 'index'])->name('profile');
});

Route::prefix('/seller')->group(function(){
    Route::get('/logout', [sellerController::class, 'logout_personal'])->name('logout_seller');

    Route::get('/login', [sellerController::class, 'index_login_personal'])->name('sellerLogin.view');
    Route::post('/login', [sellerController::class, 'login_personal'])->name('login_seller.post');

    Route::get('/register', [sellerController::class, 'index_register_personal'])->name('sellerRegister.view');
    Route::post('/register', [sellerController::class, 'register_personal'])->name('register_seller.post');
});




