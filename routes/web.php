<?php

use App\Http\Controllers\CountriesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/countries', [CountriesController::class, 'index'])->name('countries.index');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
