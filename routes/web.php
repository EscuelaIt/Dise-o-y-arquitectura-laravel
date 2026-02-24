<?php

use App\Http\Controllers\CountriesController;
use App\Http\Controllers\GenerateCertificateController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Tag\TagController;
use App\Services\CountryService;
use App\Services\ServiceLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/countries', [CountriesController::class, 'index'])->name('countries.index');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show')->middleware(['logrequest']);

Route::get('/mi_ip', function(Request $request, CountryService $service) {
    $result = $service->getCountries();
    return $result['data'][1]['name'] . ' Tu IP es: ' . $request->ip();
});

Route::get('/buy', [OrderController::class, 'order'])->middleware(['logrequest']);

Route::get('/log', function (ServiceLogger $service) {
    return $service->log("un mensaje...");

});

Route::get('/generate-cert', [GenerateCertificateController::class, 'generate']);

Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
Route::post('/tags', [TagController::class, 'store'])->name('tags.store');

Route::get('/openai/send-message', [OpenAIController::class, 'sendMessage'])->name('openai.send-message');
