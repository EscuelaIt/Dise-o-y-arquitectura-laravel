<?php

namespace Tests\Feature;

use App\Models\Plan;
use App\Models\User;
use App\Services\PaymentGateway;
use App\Services\Responses\PaymentResponse;
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

        $paymentMock = $this->mock(PaymentGateway::class, function(MockInterface $mock) use ($user, $plan) {
            $mock->shouldReceive('processSubscription')
                ->once()
                ->with($user, $plan->id)
                ->andReturn(new PaymentResponse(
                    success: true,
                    message: 'Suscripcion creada',
                    transactionId: '123'
                ));
        });

        $this->app->instance(PaymentGateway::class, $paymentMock);

        $response = $this->actingAs($user)->post(route('subscription.subscribe', $plan->id));

        $response
            ->assertRedirect('/')
            ->assertSessionHas('success');
    }

    #[Test]
    public function it_cant_subscribe_user(): void
    {
        $plan = Plan::factory()->create();
        $user = User::factory()->create();

        $paymentMock = $this->mock(PaymentGateway::class, function(MockInterface $mock) use ($user, $plan) {
            $mock->shouldReceive('processSubscription')
                ->once()
                ->with($user, $plan->id)
                ->andReturn(new PaymentResponse(
                    success: false,
                    message: 'Error al crear...',
                ));
        });

        $this->app->instance(PaymentGateway::class, $paymentMock);

        $response = $this->actingAs($user)->post(route('subscription.subscribe', $plan->id));

        $response
            ->assertRedirect()
            ->assertSessionHas('error');
    }
}
