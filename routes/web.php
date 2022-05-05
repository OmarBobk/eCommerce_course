<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\ProductCategoriesController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductCouponController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Mindscms\Entrust\Entrust;

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('testing', function () {
    dd(auth()->user()->ability('admin', ['manage_product_categories', 'show_product_categories'], ['validate_all' => true]));
});
Route::get('cart', [FrontendController::class, 'cart'])->name('frontend.cart');
Route::get('checkout', [FrontendController::class, 'checkout'])->name('frontend.checkout');
Route::get('detail', [FrontendController::class, 'detail'])->name('frontend.detail');
Route::get('shop', [FrontendController::class, 'shop'])->name('frontend.shop');

// Backend
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {

    Route::group([
        'middleware' => 'guest'
    ], function () {
        Route::get('/login', [
            BackendController::class,
            'login'
        ])
            ->name('login');

        Route::get('/forgot-password', [
            BackendController::class,
            'forgot_password'
        ])
            ->name('forgot_password');

    });

    Route::group([
        'middleware' => ['roles', 'role:admin|supervisor'],
    ], function() {
        Route::get('/', [
            BackendController::class,
            'index'
        ])
            ->name('index_route');

        Route::get('/index', [
            BackendController::class,
            'index'
        ])
            ->name('index');

        Route::post('/product_categories/remove-image', [
            ProductCategoriesController::class,
            'remove_image'
        ])
            ->name('product_categories.remove_image');
        Route::resource('product_categories', ProductCategoriesController::class);
        Route::resource('products', ProductController::class);
        Route::post('/products/remove_image', [
            ProductController::class, 'remove_image'
        ])->name('products.remove_image');
        Route::resource('tags', TagController::class);
        Route::resource('product_coupons', ProductCouponController::class);

    });
});

//Route::get('/testing', function () {
//    return view('backend.login');
//});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
