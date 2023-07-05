<?php

namespace Tests\Unit;

use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testConstructorGetDataFromUserService()
    {
        $postController = new PostController($this->createMock(UserService::class));
        $reflectionClass = new \ReflectionClass(PostController::class);
        $reflectionProperty = $reflectionClass->getProperty('userService');
        $reflectionProperty->setAccessible(true);
        $userService = $reflectionProperty->getValue($postController);

        $this->assertInstanceOf(UserService::class, $userService);
    }

    public function testIndexReturnViewWithCorrectData()
    {
        $user = User::factory()->create();
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user->assignRole($adminRole);
        $response = $this->actingAs($user)->get('/post');
        $response->assertStatus(200);
        $response->assertViewIs('pages.dashboard.post.index');
        $response->assertViewHas('getUserLogin');
        $response->assertViewHas('getRoleAdmin');
    }

    public function testDisplayCreatePost()
    {
        $user = User::factory()->create();
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user->assignRole($adminRole);
        $response = $this->actingAs($user)->get('/post/create');
        $response->assertStatus(200);
        $response->assertViewIs('pages.dashboard.post.create');
        $response->assertViewHas('getUserLogin');
        $response->assertViewHas('getRoleAdmin');
    }

    public function testCreateNewPost()
    {
        $user = User::factory()->create();
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user->assignRole($adminRole);
        $dummyDataPost = [
            'user_id' => $user->id,
            'uuid' => '76a6af13-16bb-4e42-a837-81076fba02b6',
            'title' => 'hello Post',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        ];
        $response = $this->actingAs($user)->post('/post', $dummyDataPost);
        $response->assertStatus(302);
        $response->assertRedirect('/post');

        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'title' => 'hello Post',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        ]);
    }

    public function testShowDetailPost()
    {
        $user = User::factory()->create();
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user->assignRole($adminRole);

        $dummyDataPost = [
            'user_id' => $user->id,
            'uuid' => '126c117a-479b-49fa-a440-c17151b1ed39',
            'title' => 'hello Post',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        ];
        Post::factory()->create($dummyDataPost);

        $response = $this->actingAs($user)->get('/post/' . $dummyDataPost['uuid']);
        $response->assertStatus(200);
        $response->assertViewIs('pages.dashboard.post.show');
        $response->assertViewHas('getDataPost', function ($post) use ($dummyDataPost) {
            return $post->uuid === $dummyDataPost['uuid'];
        });
        $response->assertViewHas('getUserLogin');
        $response->assertViewHas('getRoleAdmin');
    }

    public function testDisplayEditPost()
    {
        $user = User::factory()->create();
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user->assignRole($adminRole);

        $dummyDataPost = [
            'user_id' => $user->id,
            'uuid' => '66269f35-9373-4f75-b736-a341305954be',
            'title' => 'hello edit post',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        ];
        Post::factory()->create($dummyDataPost);

        $response = $this->actingAs($user)->get('/post/' . $dummyDataPost['uuid'] . '/edit');
        $response->assertStatus(200);
        $response->assertViewIs('pages.dashboard.post.edit');
        $response->assertViewHas('getDataPost');
        $response->assertViewHas('getDataPost', function ($post) use ($dummyDataPost) {
            return $post->uuid === $dummyDataPost['uuid'];
        });
        $response->assertViewHas('getUserLogin');
        $response->assertViewHas('getRoleAdmin');
    }

    public function testUpdateDataPost()
    {
        $user = User::factory()->create();
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user->assignRole($adminRole);

        $dummyDataPost = [
            'user_id' => $user->id,
            'uuid' => 'e657c1d3-53bd-47ce-bb69-aa7fb4447da3',
            'title' => 'hello update post',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        ];
        Post::factory()->create($dummyDataPost);

        $dummyDataUpdate = [
            'title' => 'success updated title',
            'content' => 'success updated content',
        ];

        $response = $this->actingAs($user)->put('/post/' . $dummyDataPost['uuid'], $dummyDataUpdate);
        $response->assertStatus(302);
        $response->assertRedirect('/post');

        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'uuid' => $dummyDataPost['uuid'],
            'title' => 'success updated title',
            'content' => 'success updated content',
        ]);
    }
}
