<?php

namespace App\Contracts;

interface AppReportService
{
    public function generate(array $data): mixed;
}
