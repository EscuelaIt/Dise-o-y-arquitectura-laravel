<?php

namespace Tests\Feature;

use App\Contracts\CertificateCreator;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Fakes\FakeCertificateCreator;
use Tests\TestCase;

class GenerateCertificateControllerTest extends TestCase
{
    #[Test]
    public function it_generates_certificate(): void
    {
        $this->app->bind(CertificateCreator::class, FakeCertificateCreator::class);
        $response = $this->get('/generate-cert');
        $response->assertStatus(200);
    }
}
