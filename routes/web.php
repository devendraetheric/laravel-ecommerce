<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/fetch-states', function (Request $request) {
    $data = State::where('country_id', $request->country_id)
        ->orderBy('name', 'ASC')
        ->get(['name', 'id'])
        ->pluck('id', 'name');

    return response()->json($data);
})->name('fetchState');


Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/import-products', [FrontController::class, 'importProducts'])->name('importProducts');

/**
 * Product Routes
 */
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{category:slug}', [ProductController::class, 'byCategory'])->name('products.byCategory');
Route::get('/brand/{brand:slug}', [ProductController::class, 'byBrand'])->name('products.byBrand');

/**
 * Cart Routes
 */
Route::get('/cart', [CartController::class, 'index'])->name('account.cart');
Route::post('/cart/addToCart', [CartController::class, 'addToCart'])->name('products.addToCart');
Route::get('/cart/removeFromCart/{product_id}', [CartController::class, 'removeFromCart'])->name('account.removeFromCart');

/**
 * After Login Pages
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/account/dashboard', [AccountController::class, 'index'])->name('account.dashboard');

    /**
     * Wishlist Routes
     */
    Route::get('/addToWishlist/{product_id}', [AccountController::class, 'addToWishlist'])->name('account.addToWishlist');
    Route::get('/removeFromWishlist/{product_id}', [AccountController::class, 'removeFromWishlist'])->name('account.removeFromWishlist');
    Route::get('/account/wishlist', [AccountController::class, 'wishlist'])->name('account.wishlist');

    /**
     * Address Routes
     */
    Route::resource('/account/addresses', AddressController::class)->except(['show'])->names('account.addresses');
    Route::get('/account/addresses/set-default/{address}', [AddressController::class, 'setDefault'])->name('account.addresses.setDefault');

    /**
     * Order Routes
     */
    Route::resource('/account/orders', OrderController::class)->except(['store'])->names('account.orders');
    Route::get('/account/checkout', [OrderController::class, 'checkout'])->name('account.checkout');
    Route::post('/account/checkout/store', [OrderController::class, 'store'])->name('account.checkout.store');
});

/**
 * Admin Routes
 */
Route::prefix('admin')
    ->as('admin.')
    ->group(base_path('routes/admin.php'));

/**
 * Auth Routes
 */
Route::prefix('auth')
    ->group(base_path('routes/auth.php'));
