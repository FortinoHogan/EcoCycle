<?php

use App\Http\Controllers\AddressController;
use App\Http\Middleware\CheckAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\EcoForumController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\EcoLearningController;
use App\Http\Controllers\ShopController;

Route::get('/', [HomeController::class, 'index'])->name('home.view');

Route::middleware([CheckAuth::class])->group(function () {
    Route::get('/login', [HomeController::class, 'index_login'])->name('login.view');
    Route::get('/register', [HomeController::class, 'index_register'])->name('register.view');
});

Route::resource('ecoforum', EcoForumController::class);

Route::prefix('/buyer')->group(function () {
    Route::get('/logout', [BuyerController::class, 'logout_personal'])->name('logout_buyer');

    Route::middleware([CheckAuth::class])->group(function () {
        Route::post('/login', [BuyerController::class, 'login_personal'])->name('login_buyer.post');

        Route::post('/register', [BuyerController::class, 'register_personal'])->name('register_buyer.post');
    });

    Route::get('/profile', [BuyerController::class, 'index'])->name('buyerProfile');

    Route::get('/shop', [BuyerController::class, 'shop'])->name('shop.view');
    Route::get('/detail/{product_id}', [TransactionController::class, 'detail_product'])->name("detail");
    Route::get('/cart', [TransactionController::class, 'cart'])->name("cart");
    Route::post('/detail/{product_id}', [TransactionController::class, 'detail_product'])->name("detail");

    Route::post('/cart/add', [TransactionController::class, 'add_to_cart'])->name('add-to-cart');
    Route::post('/cart/update-quantity', [TransactionController::class, 'update_quantity'])->name('update-quantity');
    Route::post('/cart/remove', [TransactionController::class, 'remove_from_cart'])->name('remove-from-cart');

    Route::post('/process-checkout', [TransactionController::class, 'process_checkout'])->name('process-checkout');
    Route::get('/checkout/{transaction_id}', [TransactionController::class, 'checkout'])->name('checkout');
    Route::post('/process-success', [TransactionController::class, 'process_success'])->name('process-success');
    Route::get('/success', [TransactionController::class, 'success'])->name('success');

    Route::get('/cart', [TransactionController::class, 'cart'])->name("cart");

    Route::post('/address', [AddressController::class, 'set_address'])->name('set-address');
    Route::post('/change-address', [AddressController::class, 'change_address'])->name('change-address');

    Route::get('/ecolearning', [EcoLearningController::class, 'index'])->name('ecolearning');
    Route::get('/articleDetail/{id}', [EcoLearningController::class, 'detail'])->name('articleDetail');

    Route::get('/profile', [BuyerController::class, 'index'])->name('profile');
});

Route::prefix('/seller')->group(function () {
    Route::get('/logout', [SellerController::class, 'logout_personal'])->name('logout_seller');

    Route::middleware([CheckAuth::class])->group(function () {
        Route::post('/login', [SellerController::class, 'login_personal'])->name('login_seller.post');

        Route::post('/register', [SellerController::class, 'register_personal'])->name('register_seller.post');
    });

    Route::resource('/shop', ShopController::class);

    Route::get('/detail/{product_id}', [TransactionController::class, 'detail_product'])->name("detail_seller");
    Route::post('/detail/{product_id}', [ShopController::class, 'update'])->name("update_seller");
});
