<?php

namespace App\Services;

use App\Contracts\AppReportService;
use Illuminate\Support\Facades\Log;

class LogReportService implements AppReportService
{

    public function generate(array $data): array
    {
        // alternativa usando el service container directamente
        // $logInstance = app('log');
        // $logInstance->info('Report generated', [
        //     'data' => $data,
        //     'count' => count($data),
        //     'timestamp' => now()
        // ]);

        Log::info('Report generated', [
            'data' => $data,
            'count' => count($data),
            'timestamp' => now()
        ]);
        return $data;
    }
}
