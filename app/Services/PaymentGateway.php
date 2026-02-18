<?php

namespace App\Services;

class PaymentGateway
{
    public function charge(int $amount): void
    {
        info('Vamos a cobrar de manera REAL ' . $amount);
    }
}
