<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\FrontController;
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
Route::get('/products', [FrontController::class, 'products'])->name('products.list');
Route::get('/product/{product:slug}', [FrontController::class, 'productSingle'])->name('products.single');

Route::post('/product/addToCart', [FrontController::class, 'addToCart'])->name('products.addToCart');

Route::get('/cart', [FrontController::class, 'cart'])->name('account.cart');
Route::get('/removeFromCart/{product_id}', [FrontController::class, 'removeFromCart'])->name('account.removeFromCart');

/**
 * After Login Pages
 */

Route::group(['middleware' => 'auth'], function () {
    Route::get('/addToWishlist/{product_id}', [AccountController::class, 'addToWishlist'])->name('account.addToWishlist');
    Route::get('/removeFromWishlist/{product_id}', [AccountController::class, 'removeFromWishlist'])->name('account.removeFromWishlist');

    Route::get('/account/wishlist', [AccountController::class, 'wishlist'])->name('account.wishlist');

    Route::get('/account/dashboard', [AccountController::class, 'index'])->name('account.dashboard');

    Route::resource('/account/addresses', AddressController::class)->except(['show'])->names('account.addresses');
});


Route::prefix('admin')
    ->as('admin.')
    ->group(base_path('routes/admin.php'));

Route::prefix('auth')
    ->group(base_path('routes/auth.php'));
