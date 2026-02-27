<?php

namespace Tests\Feature;

use App\Services\LogReportService;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LogReportServiceTest extends TestCase
{
    public function test_generate_logs_and_returns_data()
    {
        $data = ['foo' => 'bar', 'baz' => 123];

        Log::shouldReceive('info')->once();

        $service = new LogReportService();
        $result = $service->generate($data);

        $this->assertEquals($data, $result);
    }
}
