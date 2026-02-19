<?php

namespace App\Services;

use App\Contracts\AppReportService;
use Illuminate\Support\Facades\Log;

class LogReportService implements AppReportService
{

    public function generate(array $data): array
    {
        Log::info('Report generated', [
            'data' => $data,
            'count' => count($data),
            'timestamp' => now()
        ]);
        return $data;
    }
}
