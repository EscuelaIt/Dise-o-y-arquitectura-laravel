<?php

namespace Tests\Feature\Tag;

use App\Models\Tag;
use App\Models\User;
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
        $user = User::factory()->create();

        SlugGenerator::shouldReceive('generateSlug')
            ->once()
            ->with('test', Tag::class, 'slug')
            ->andReturn('testando');

        $response = $this->actingAs($user)->post('/tags', ['nombre' => 'test']);

        $response->assertRedirect();
        $this->assertDatabaseHas('tags', ['nombre' => 'test', 'slug' => 'testando']);
    }

    #[Test]
    public function it_canot_creates_a_tag_without_user(): void
    {
        $response = $this->post('/tags', ['nombre' => 'test']);

        $response->assertForbidden();
    }

    #[Test]
    public function it_canot_update_a_tag_without_user(): void
    {
        $tag = Tag::factory()->create();
        $response = $this->post('/tags/' . $tag->id, ['nombre' => 'actualizando']);

        $response->assertForbidden();
    }

    #[Test]
    public function it_can_update_a_tag(): void
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create();
        $response = $this->actingAs($user)->post('/tags/' . $tag->id, ['nombre' => 'actualizando', 'slug' => 'probando']);
        $this->assertDatabaseHas('tags', ['nombre' => 'actualizando', 'slug' => 'probando']);
        $response->assertRedirect();
    }

    #[Test]
    public function it_cannot_update_a_tag_with_single_character_slug(): void
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create();
        $response = $this->actingAs($user)->post('/tags/' . $tag->id, ['nombre' => 'actualizando', 'slug' => 'a']);

        $response->assertSessionHasErrors('slug');
    }
}
