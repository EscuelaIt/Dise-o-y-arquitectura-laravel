<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Services\PaymentGateway;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index() {
        $plans = Plan::all();
        return view('subscription.index')->with([
            'plans' => $plans,
        ]);
    }

    public function subscribe(Request $request, Plan $plan)
    {
        $user = $request->user();
        $paymentService = new PaymentGateway();
        $paymentService->processSubscription($user, $plan->id);
        return redirect('/')->with('success', 'Suscripción a ' . $plan->name . ' activada!');
    }

}
