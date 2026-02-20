<?php

namespace App\Http\Controllers;

use App\Contracts\AppReportService;
use App\Services\PaymentGateway;

class OrderController extends Controller
{
    protected PaymentGateway $paymentService;
    protected AppReportService $reporter;

    public function __construct(PaymentGateway $paymentService, AppReportService $reporter)
    {
        $this->paymentService = $paymentService;
        $this->reporter = $reporter;
    }

    public function order()
    {
        $quantity = 400;
        $this->paymentService->charge($quantity);
        $this->reporter->generate([$quantity]);
        return 'Compra realizada...';
    }
}
