<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


// CACHE CLEAR ROUTE
Route::get('cache-clear', function () {
    Artisan::call('optimize:clear');
    request()->session()->flash('success', 'Successfully cache cleared.');
    return redirect()->back();
})->name('cache.clear');



Route::get('/', function () {
    return view('welcome');
})->name('home');
