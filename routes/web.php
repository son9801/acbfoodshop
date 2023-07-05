<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

//Home page

    Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/collections', 'categories');
        Route::get('/collections/{category_slug}', 'products');
        Route::get('/collections/{category_slug}/{product_slug}', 'productView');
        Route::get('/new-arrivals', 'newArrival');
        Route::get('/sale', 'sale');
        Route::get('/trending', 'trending');
        Route::get('search', 'searchProducts');
        Route::post('/addToCart', 'addToCart');
    });



//Cart
Route::middleware(['auth'])->group(function () {
    Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);

    Route::get('orders', [App\Http\Controllers\Frontend\OrderController::class, 'index']);
    Route::get('orders/{orderId}', [App\Http\Controllers\Frontend\OrderController::class, 'show']);

    Route::get('profile', [App\Http\Controllers\Frontend\UserController::class, 'index']);
    Route::post('profile', [App\Http\Controllers\Frontend\UserController::class, 'updateUserDetails']);
    Route::get('change-password', [App\Http\Controllers\Frontend\UserController::class, 'password']);
    Route::post('change-password', [App\Http\Controllers\Frontend\UserController::class, 'changePassword']);
});

Route::get('thank-you', [App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('dashboard', [App\Http\Controllers\Admin\DashBoardController::class, 'index'])->name('dashboard');
    Route::get('adminSearch', [App\Http\Controllers\Admin\DashBoardController::class, 'search'])->name('dashboard.adminSearch');
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index']);
    Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'store']);
    Route::get('revenue', [App\Http\Controllers\Admin\RevenueController::class, 'index'])->name('revenue.index');
    Route::get('revenueMonth', [App\Http\Controllers\Admin\RevenueController::class, 'indexMonth'])->name('revenue.index');
    Route::get('revenueYear', [App\Http\Controllers\Admin\RevenueController::class, 'indexYear'])->name('revenue.index');

    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');
    });

    //quan ly san pham
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/product', 'index')->name('product.index');
        Route::get('/product/create', 'create');
        Route::post('product', 'store');
        Route::get('/product/{product}/edit', 'edit');
        Route::put('/product/{product}', 'update');
        Route::get('product/{product_id}/delete', 'delete');

        Route::get('/product-image/{product_image_id}/delete', 'destroyImage');
    });

    //quan ly anh thanh truot
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('/slider', 'index');
        Route::get('/slider/create', 'create');
        Route::post('/slider', 'store');
        Route::get('/slider/{slider}/edit', 'edit');
        Route::put('/slider/{slider}', 'update');
    });

    //quan ly don hang
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{orderId}', 'show');
        Route::put('/orders/{orderId}', 'updateOrderStatus');
        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');
    });

    //Quan ly nguoi dung
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{user_id}/edit', 'edit');
        Route::put('/users/{user_id}', 'update');
    });
});
