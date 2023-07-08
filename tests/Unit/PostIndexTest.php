<?php

namespace Tests\Unit;

use App\Http\Livewire\Post\Index;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;

class PostIndexTest extends TestCase
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
        Post::factory()->create($dummyDataPost);

        Livewire::test(Index::class)
            ->assertSee($dummyDataPost['title'])
            ->assertSee($dummyDataPost['content'])
            // ->assertSeeLivewirePagination($dummyDataPost['title'])
            ->set('search', 'hello')
            ->assertSee($dummyDataPost['title']);
    }

    public function testDeletePost()
    {
        $user = User::factory()->create();
        $dummyDataPost = [
            'user_id' => $user->id,
            'uuid' => 'b2a464b0-9a10-4864-95bb-11cb460cba6d',
            'title' => 'hello delete livewire',
            'content' => 'lorem ipsum',
        ];
        Post::factory()->create($dummyDataPost);

        Livewire::actingAs($user)
            ->test(Index::class)
            ->call('deletePost', $dummyDataPost['uuid'])
            // ->assertSessionHas('success', 'Post Deleted Successfully!')
        ;

        $this->assertDatabaseMissing('posts', [
            'uuid' => $dummyDataPost['uuid'],
        ]);
    }
}
