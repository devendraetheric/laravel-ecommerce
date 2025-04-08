<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/products', [FrontController::class, 'products'])->name('products.list');
Route::get('/product/{product}', [FrontController::class, 'productSingle'])->name('products.single');


Route::prefix('admin')
    ->as('admin.')
    ->group(base_path('routes/admin.php'));
