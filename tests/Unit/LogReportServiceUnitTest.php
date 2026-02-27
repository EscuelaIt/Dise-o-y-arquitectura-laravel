<?php

namespace Tests\Unit;

use App\Services\LogReportService;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\TestCase;

class LogReportServiceUnitTest extends TestCase
{
    public function test_generate_logs_and_returns_data()
    {
        $data = ['foo' => 123];

        Log::shouldReceive('info')->once();

        $service = new LogReportService();
        $result = $service->generate($data);

        $this->assertEquals($data, $result);
    }
}
