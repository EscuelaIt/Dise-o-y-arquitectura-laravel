<?php

namespace App\Services;

class PaymentGateway
{
    public function charge(int $amount): void
    {
        info('Vamos a cobrar de manera REAL ' . $amount);
    }

    public function processSubscription($user, $plan) {
        info("Vamos a cobrar una suscripción a $user con el plan $plan");
    }
}
