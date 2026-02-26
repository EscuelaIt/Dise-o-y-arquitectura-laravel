<?php

namespace App\Services;

use App\Services\Responses\PaymentResponse;

class PaymentGateway
{
    public function processSubscription($user, $planId): PaymentResponse
    {
        $success = rand(1, 100) > 50;

        if ($success) {
            return new PaymentResponse(
                success: true,
                message: 'Pago procesado exitosamente',
                transactionId: 'txn_' . uniqid()
            );
        }

        return new PaymentResponse(
            success: false,
            message: 'Error en el procesamiento del pago. Intenta de nuevo.'
        );
    }
}
