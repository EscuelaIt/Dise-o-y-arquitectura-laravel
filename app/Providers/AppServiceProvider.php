<?php

namespace App\Providers;

use App\Contracts\AppReportService;
use App\Http\Controllers\OrderController;
use App\Services\EmailReportService;
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

        $this->app
            ->when(OrderController::class)
            ->needs(AppReportService::class)
            ->give(EmailReportService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
