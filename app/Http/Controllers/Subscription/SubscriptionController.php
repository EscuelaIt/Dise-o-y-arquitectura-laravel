<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use App\Services\PaymentGateway;
use Illuminate\Container\Attributes\CurrentUser;

class SubscriptionController extends Controller
{
    public function index() {
        $plans = Plan::all();
        return view('subscription.index')->with([
            'plans' => $plans,
        ]);
    }

    public function subscribe(#[CurrentUser()] ?User $user, Plan $plan, PaymentGateway $paymentService)
    {
        $paymentService->processSubscription($user, $plan->id);
        return redirect('/')->with('success', 'Suscripción a ' . $plan->name . ' activada!');
    }

}
