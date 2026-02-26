<?php

namespace Tests\Feature;

use App\Models\Plan;
use App\Models\User;
use App\Services\PaymentGateway;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_subscribes_user(): void
    {
        $plan = Plan::factory()->create();
        $user = User::factory()->create();

        $this->app->instance(PaymentGateway::class, $this->mock(PaymentGateway::class, function(MockInterface $mock) {
            $mock->shouldReceive('processSubscription')->once();
        }));
        $response = $this->actingAs($user)->post(route('subscription.subscribe', $plan->id));

        $response
            ->assertRedirect('/')
            ->assertSessionHas('success');
    }
}
