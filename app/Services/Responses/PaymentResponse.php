<?php

namespace App\Services\Responses;

class PaymentResponse
{
    public function __construct(
        public bool $success,
        public string $message,
        public ?string $transactionId = null,
    ) {}
}
