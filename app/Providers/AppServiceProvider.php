<?php

namespace App\Providers;

use App\Contracts\AppReportService;
use App\Http\Controllers\OrderController;
use App\Models\Tag;
use App\Observers\TagObserver;
use App\Services\EmailReportService;
use App\Services\OpenAIApiClient;
use App\Services\SlugGenerator;
use App\View\Composers\WelcomeComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Contracts\AppReportService::class,
            \App\Services\LogReportService::class
        );

        $this->app->bind(
            \App\Contracts\CertificateCreator::class,
            \App\Services\PDFCertificateCreator::class
        );

        $this->app
            ->when(OrderController::class)
            ->needs(AppReportService::class)
            ->give(EmailReportService::class);

        $this->app->bind(SlugGenerator::class, function() {
            return new SlugGenerator(4);
        });

        $this->app->bindIf(SlugGenerator::class, function() {
           return new SlugGenerator(8);
       });

       $this->app->scoped(OpenAIApiClient::class, function() {
           $client = new OpenAIApiClient(config('services.openai_api.key'));
           $client->configure('una configuración fina');
           return $client;
       });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       Tag::observe(TagObserver::class);
       View::composer('welcome', WelcomeComposer::class);
       Blade::if('name', function (string $value) {
            return 'EscuelaIT' === $value;
        });
    }
}
