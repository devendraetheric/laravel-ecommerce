<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// CACHE CLEAR ROUTE
Route::get('cache-clear', function () {
    Artisan::call('optimize:clear');

    return redirect()->back()
        ->with('success', 'Successfully cache cleared.');
})->name('cache.clear');


Route::get('migrate', function () {
    Artisan::call('migrate --seed');

    return redirect()->back()
        ->with('success', 'Successfully migrated and seeded.');
})->name('migrate');

Route::get('migrate-refresh', function () {
    Artisan::call('migrate:refresh --seed');

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
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
});
