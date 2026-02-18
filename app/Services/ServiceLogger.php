<?php

namespace App\Services;

class ServiceLogger
{
    public function log(string $message): void
    {
        logger()->info($message);
    }
}
