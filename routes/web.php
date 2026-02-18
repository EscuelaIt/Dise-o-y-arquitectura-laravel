<?php

use App\Http\Controllers\CountriesController;
use App\Http\Controllers\ProductController;
use App\Services\CountryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/countries', [CountriesController::class, 'index'])->name('countries.index');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/mi_ip', function(Request $request, CountryService $service) {
    $result = $service->getCountries();
    return $result['data'][1]['name'] . ' Tu IP es: ' . $request->ip();
});
