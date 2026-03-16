<?php

use App\Facades\PriceCalculator;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\GenerateCertificateController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Subscription\SubscriptionController;
use App\Http\Controllers\Tag\TagController;
use App\Models\Tag;
use App\Services\CountryService;
use App\Services\ServiceLogger;
use App\Services\SlugGenerator;
use Illuminate\Container\Attributes\Config;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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

Route::prefix(('/tags'))->group(function() {
    Route::get('/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/', [TagController::class, 'store'])->name('tags.store');
    Route::post('/{tag}', [TagController::class, 'update'])->name('tags.update');
});


Route::get('/openai/send-message', [OpenAIController::class, 'sendMessage'])->name('openai.send-message');

Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
Route::post('/subscription/{plan}', [SubscriptionController::class, 'subscribe'])->name('subscription.subscribe');

Route::get('create-slug', function() {
    $slugGenerator = App::makeWith(SlugGenerator::class, [
        'randomStringLength' => 6,
    ]);
    return $slugGenerator->generateSlug('test', Tag::class, 'slug');
});

Route::get('app-name', function(#[Config('app.name')] $appName, #[Log('payment')] $logger) {
    $logger->info('Hola Contextual Attributes');
    return $appName;
});

Route::get('use-facade', function() {
    return PriceCalculator::setTaxRate(0.10)->setDiscountRate(0.05)->calculate(1000);
});
