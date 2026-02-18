<?php

namespace App\Http\Controllers;

use App\Services\PaymentGateway;

class OrderController extends Controller
{
    protected PaymentGateway $paymentService;

    public function __construct(PaymentGateway $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function order()
    {
        $this->paymentService->charge(400);
        return 'Compra realizada...';
    }
}
