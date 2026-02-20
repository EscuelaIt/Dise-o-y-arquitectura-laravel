<?php

namespace App\Services;

use App\Contracts\AppReportService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class EmailReportService implements AppReportService
{
    public function generate(array $data): array
    {
        Config::set('mail.from.address', 'noreply@example.com');
        Config::set('mail.from.name', 'Report Service');

        Mail::raw(
            "Report Data:\n" . json_encode($data, JSON_PRETTY_PRINT),
            function ($message) {
                $message->to('admin@example.com')
                        ->subject('Generated Report - ' . now()->format('Y-m-d H:i'));
            }
        );

        return $data;
    }
}
