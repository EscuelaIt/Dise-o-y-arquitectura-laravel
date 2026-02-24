<?php

namespace App\Providers;

use App\Contracts\AppReportService;
use App\Http\Controllers\OrderController;
use App\Services\EmailReportService;
use App\Services\SlugGenerator;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
