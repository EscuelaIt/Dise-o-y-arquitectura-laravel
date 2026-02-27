<?php

namespace Tests\Feature\Tag;

use App\Models\Tag;
use Facades\App\Services\SlugGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_a_tag(): void
    {
        SlugGenerator::shouldReceive('generateSlug')
            ->once()
            ->with('test', Tag::class, 'slug')
            ->andReturn('testando');

        $response = $this->post('/tags', ['nombre' => 'test']);

        $response->assertRedirect();
        $this->assertDatabaseHas('tags', ['nombre' => 'test', 'slug' => 'testando']);
    }
}
