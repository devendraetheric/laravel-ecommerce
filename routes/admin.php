<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// CACHE CLEAR ROUTE
Route::get('cache-clear', function () {
    Artisan::call('optimize:clear');

    return redirect()->back()
        ->with('success', 'Successfully cache cleared.');
})->name('cache.clear');


Route::get('migrate', function () {
    Artisan::call('migrate');

    return redirect()->back()
        ->with('success', 'Successfully migrated.');
})->name('migrate');

Route::get('migrate-fresh', function () {
    Artisan::call('migrate:fresh --seed');

    return redirect()->back()
        ->with('success', 'Successfully migrated and seeded.');
})->name('migrate.refresh');


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest:admin');
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest:admin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard')->middleware('auth:admin');

Route::group(['middleware' => 'auth:admin'], function () {

    Route::resource('brands', BrandController::class)->except(['show']);
    Route::get('brands/search', [BrandController::class, 'search'])->name('brands.search');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::get('categories/search', [CategoryController::class, 'search'])->name('categories.search');

    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('products/search', [ProductController::class, 'search'])->name('products.search');

    Route::get('products/import', [ProductController::class, 'import'])->name('products.import');
    Route::post('products/import', [ProductController::class, 'importStore'])->name('products.import.store');

    Route::resource('orders', OrderController::class);


    /*  Route::resource('payments',PaymentController::class)->except('show'); */

    Route::post('payments/store/{order}', [PaymentController::class, 'store'])->name('payments.store');


    Route::get('users/search', [UserController::class, 'search'])->name('users.search');



    /**
     * Banner Route
     */
    Route::resource('banners', BannerController::class)->except(['show']);



    /**
     * Settings
     */
    Route::get('settings/general', [SettingController::class, 'general'])->name('settings.general');
    Route::post('settings/general', [SettingController::class, 'saveGeneralSettings'])->name('settings.saveGeneralSettings');


    Route::get('settings/socialMedia', [SettingController::class, 'socialMedia'])->name('settings.socialMedia');
    Route::post('settings/socialMedia', [SettingController::class, 'saveSocialMedia'])->name('settings.saveSocialMedia');

    Route::get('settings/company', [SettingController::class, 'company'])->name('settings.company');
    Route::post('settings/company', [SettingController::class, 'saveCompany'])->name('settings.saveCompany');

    Route::get('settings/prefix', [SettingController::class, 'prefix'])->name('settings.prefix');
    Route::post('settings/prefix', [SettingController::class, 'savePrefix'])->name('settings.savePrefix');

});
