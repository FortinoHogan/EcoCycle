<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\EcoForumController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\EcoLearningController;

Route::get('/', [homeController::class, 'index'])->name('home.view');

Route::resource('ecoforum', ecoforumController::class);

Route::prefix('/buyer')->group(function(){
    Route::get('/logout', [BuyerController::class, 'logout_personal'])->name('logout_buyer');

    Route::get('/login', [BuyerController::class, 'index_login_personal'])->name('buyerLogin.view');
    Route::post('/login', [BuyerController::class, 'login_personal'])->name('login_buyer.post');

    Route::get('/register', [BuyerController::class, 'index_register_personal'])->name('buyerRegister.view');
    Route::post('/register', [BuyerController::class, 'register_personal'])->name('register_buyer.post');

    Route::get('/profile', [BuyerController::class, 'index'])->name('buyerProfile');
    Route::get('/shop', [BuyerController::class, 'shop'])->name('shop.view');


    Route::post('/detail/{product_id}', [TransactionController::class, 'detail_product'])->name("detail");
    
    Route::post('/cart/add', [TransactionController::class, 'add_to_cart'])->name('add-to-cart');
    Route::post('/cart/update-quantity', [TransactionController::class, 'update_quantity'])->name('update-quantity');
    Route::post('/cart/remove', [TransactionController::class, 'remove_from_cart'])->name('remove-from-cart');
    
    Route::post('/process-checkout', [TransactionController::class, 'process_checkout'])->name('process-checkout');
    Route::get('/checkout/{transaction_id}', [TransactionController::class, 'checkout'])->name('checkout');
    
    Route::get('/payment/{transaction_id}', [PaymentController::class, 'payment'])->name('payment');
    Route::get('/cart', [TransactionController::class, 'cart'])->name("cart");

    Route::get('/ecolearning', [EcoLearningController::class, 'index'])->name('ecolearning');

    Route::get('/profile', [BuyerController::class, 'index'])->name('profile');
});

Route::prefix('/seller')->group(function(){
    Route::get('/logout', [SellerController::class, 'logout_personal'])->name('logout_seller');

    Route::get('/login', [SellerController::class, 'index_login_personal'])->name('sellerLogin.view');
    Route::post('/login', [SellerController::class, 'login_personal'])->name('login_seller.post');

    Route::get('/register', [SellerController::class, 'index_register_personal'])->name('sellerRegister.view');
    Route::post('/register', [SellerController::class, 'register_personal'])->name('register_seller.post');
});




