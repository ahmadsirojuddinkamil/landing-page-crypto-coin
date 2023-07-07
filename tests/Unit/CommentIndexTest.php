<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Http\Livewire\Commentator\Index;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CommentIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testRenderAndGetListPost()
    {
        $user = User::factory()->create();

        $dummyDataPost = [
            'user_id' => $user->id,
            'uuid' => '89f56154-8361-4467-b644-149b948362b8',
            'title' => 'hello post livewire',
            'content' => 'lorem ipsum',
        ];
        $post = Post::factory()->create($dummyDataPost);

        $dummyDataComment = [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'uuid' => 'fc5ef9fa-40df-4b35-b395-36a5e802f9f4',
            'content' => 'hi comment',
        ];
        Comment::factory()->create($dummyDataComment);

        Livewire::test(Index::class, ['getUuidFromComponentCall' => $dummyDataPost['uuid']])
            ->assertSee($dummyDataComment['user_id'])
            ->assertSee($dummyDataComment['content']);
    }

    public function testCreateComment()
    {
        $user = User::factory()->create();

        $dummyDataPost = [
            'user_id' => $user->id,
            'uuid' => '2e624a98-a098-486a-b8ea-82f5b47f4380',
            'title' => 'hello create livewire',
            'content' => 'lorem ipsum',
        ];
        $post = Post::factory()->create($dummyDataPost);

        $dummyDataComment = [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'uuid' => '0a81f1fa-eedd-405e-ae43-ec6e9adbb6dc',
            'content' => 'hi create comment',
        ];

        Livewire::actingAs($user)
            ->test(Index::class, ['getUuidFromComponentCall' => $dummyDataPost['uuid']])
            ->set('saveContentFromInput', $dummyDataComment['content'])
            ->call('store');

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'uuid' => $dummyDataPost['uuid'],
            'content' => $dummyDataComment['content'],
        ]);
    }
}
