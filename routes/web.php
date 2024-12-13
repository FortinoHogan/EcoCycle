<?php

use App\Http\Controllers\AddressController;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\CheckBuyer;
use App\Http\Middleware\CheckSeller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\EcoForumController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\EcoLearningController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ShopController;

Route::get('/', [HomeController::class, 'index'])->name('home.view');

Route::middleware([CheckAuth::class])->group(function () {
    Route::get('/login', [HomeController::class, 'index_login'])->name('login.view');
    Route::get('/register', [HomeController::class, 'index_register'])->name('register.view');
});

Route::get('/404', function () {
    return view('auth.404');
})->name('404');

Route::resource('ecoforum', EcoForumController::class);
Route::post('/ecoforum/{post}/toggle-like', [EcoForumController::class, 'toggleLike'])->name('ecoforum.toggle-like');
Route::get('/ecoforum/{post}/get-like-count', [EcoForumController::class, 'getLikeCount'])->name('ecoforum.get-like-count');
Route::post('/ecoforum/{postId}/comments', [EcoForumController::class, 'storeReply'])->name('ecoforum.reply');

Route::prefix('/buyer')->group(function () {
    Route::get('/logout', [BuyerController::class, 'logout_personal'])->name('logout_buyer');

    Route::middleware([CheckAuth::class])->group(function () {
        Route::post('/login', [BuyerController::class, 'login_personal'])->name('login_buyer.post');

        Route::post('/register', [BuyerController::class, 'register_personal'])->name('register_buyer.post');
    });

    Route::middleware([CheckBuyer::class])->group(function () {
        Route::get('/profile', [BuyerController::class, 'index'])->name('profile');
        Route::post('/profile/{id}', [BuyerController::class, 'update'])->name('profile.update');
        Route::post('/change-password', [BuyerController::class, 'change_password'])->name('change-password');

        Route::get('/shop', [BuyerController::class, 'shop'])->name('shop.view');
        Route::get('/detail/{product_id}', [TransactionController::class, 'detail_product'])->name("detail");
        Route::post('/detail/{product_id}', [TransactionController::class, 'detail_product'])->name("detail");

        Route::get('/cart', [TransactionController::class, 'cart'])->name("cart");
        Route::post('/cart/add', [TransactionController::class, 'add_to_cart'])->name('add-to-cart');
        Route::post('/cart/update-quantity', [TransactionController::class, 'update_quantity'])->name('update-quantity');
        Route::post('/cart/remove', [TransactionController::class, 'remove_from_cart'])->name('remove-from-cart');

        Route::post('/process-checkout', [TransactionController::class, 'process_checkout'])->name('process-checkout');
        Route::get('/checkout/{transaction_id}', [TransactionController::class, 'checkout'])->name('checkout');
        Route::post('/process-success', [TransactionController::class, 'process_success'])->name('process-success');
        Route::get('/success', [TransactionController::class, 'success'])->name('success');

        Route::post('/address', [AddressController::class, 'set_address'])->name('set-address');
        Route::post('/change-address', [AddressController::class, 'change_address'])->name('change-address');

        Route::get('/ecolearning', [EcoLearningController::class, 'index'])->name('ecolearning');
        Route::get('/article-detail/{id}', [EcoLearningController::class, 'detail'])->name('article_detail');

        Route::get('/history', [HistoryController::class, 'index'])->name('history');

        Route::get('/order-detail/{id}', [HistoryController::class, 'orderDetail'])->name('order_detail');
    });
});

Route::prefix('/seller')->group(function () {
    Route::get('/logout', [SellerController::class, 'logout_personal'])->name('logout_seller');

    Route::middleware([CheckAuth::class])->group(function () {
        Route::post('/login', [SellerController::class, 'login_personal'])->name('login_seller.post');

        Route::post('/register', [SellerController::class, 'register_personal'])->name('register_seller.post');
    });

    Route::middleware([CheckSeller::class])->group(function () {
        Route::resource('shop', ShopController::class);

        Route::get('/detail/{product_id}', [TransactionController::class, 'detail_product'])->name("detail_seller");
        Route::post('/detail/{product_id}', [ShopController::class, 'update'])->name("update_seller");
    });
});
