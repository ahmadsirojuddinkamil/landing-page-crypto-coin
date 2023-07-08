<?php

namespace Tests\Unit;

use App\Http\Livewire\Like\Index;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LikeIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testRenderAndGetLikePost()
    {
        $user = User::factory()->create();

        $dummyDataPost = [
            'user_id' => $user->id,
            'uuid' => '9f2bc0a8-328f-46c5-9bff-9df28298b2c8',
            'title' => 'hello like livewire',
            'content' => 'lorem ipsum',
        ];
        $post = Post::factory()->create($dummyDataPost);

        $dummyDataLike = [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'status' => 1,
        ];
        Like::factory()->create($dummyDataLike);

        Livewire::test(Index::class, ['getUuidFromComponentCall' => $dummyDataPost['uuid']])
            ->assertSee('text-warning');
    }

    public function testCreateLikeInThePost()
    {
        $user = User::factory()->create();

        $dummyDataPost = [
            'user_id' => $user->id,
            'uuid' => '26855d9f-3c5b-4d17-8e4a-4ef3494376dc',
            'title' => 'hello like livewire',
            'content' => 'lorem ipsum',
        ];
        $post = Post::factory()->create($dummyDataPost);

        Livewire::actingAs($user)
            ->test(Index::class, ['getUuidFromComponentCall' => $dummyDataPost['uuid']])
            ->call('store');

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'status' => 1,
        ]);
    }

    public function testDeleteLikeInThePost()
    {
        $user = User::factory()->create();

        $dummyDataPost = [
            'user_id' => $user->id,
            'uuid' => '853cca59-be0a-4a85-9f35-d96e700a4f48',
            'title' => 'hello delete livewire',
            'content' => 'lorem ipsum',
        ];
        $post = Post::factory()->create($dummyDataPost);

        $dummyDataLike = [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'status' => 1,
        ];
        Like::factory()->create($dummyDataLike);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'status' => 1,
        ]);

        Livewire::test(Index::class, ['getUuidFromComponentCall' => $dummyDataPost['uuid']])
            ->call('delete');

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'status' => 1,
        ]);
    }
}
