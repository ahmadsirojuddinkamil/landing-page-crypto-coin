<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Http\Controllers\HomeController;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Services\UserService;
use Faker\Core\Uuid;
use Mockery;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testConstructorGetDataFromUserService()
    {
        $homeController = new HomeController($this->createMock(UserService::class));
        $reflectionClass = new \ReflectionClass(HomeController::class);
        $reflectionProperty = $reflectionClass->getProperty('userService');
        $reflectionProperty->setAccessible(true);
        $userService = $reflectionProperty->getValue($homeController);

        $this->assertInstanceOf(UserService::class, $userService);
    }

    public function testCreateRoleAdmin()
    {
        $userService = Mockery::mock(UserService::class);
        $homeController = new HomeController($userService);
        Role::where('name', 'admin')->delete();
        $this->assertDatabaseMissing('roles', ['name' => 'admin']);
        $homeController->createRoleAdmin();
        $this->assertDatabaseHas('roles', ['name' => 'admin']);
    }

    public function testIndexReturnViewWithCorrectData()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('pages.blog.home.index');
        $response->assertViewHas('getAllPost');
        $response->assertViewHas('getUserLogin');
        $response->assertViewHas('getRoleAdmin');
        $response->assertViewHas('usersWithAdminRole');
    }

    public function testAssignRoleAdminToFirstUserLogin()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/assignRoleAdmin');
        $response->assertRedirect('/');
        $this->assertTrue(session('success') === "Congratulations you become admin!");
        $this->assertTrue($user->hasRole('admin'));
    }

    public function testAboutBlog()
    {
        $response = $this->get('/blog/about');
        $response->assertStatus(200);
        $response->assertViewHas('getUserLogin');
        $response->assertViewHas('getRoleAdmin');
        $response->assertViewIs('pages.blog.about.index');
    }

    public function testShowPostBlog()
    {
        $user = User::factory()->create();
        $user_id = $user->id;
        $dummyDataPost = [
            'user_id' => $user_id,
            'uuid' => '56906dee-4626-4b61-af28-04e030968614',
            'title' => 'hello show',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        ];
        Post::factory()->create($dummyDataPost);
        $response = $this->get('/blog/' . $dummyDataPost['uuid']);
        $response->assertStatus(200);
        $response->assertViewIs('pages.blog.home.show');
        $response->assertViewHas('findAndGetDataPost', function ($post) use ($dummyDataPost) {
            return $post->uuid === $dummyDataPost['uuid'];
        });
        $response->assertViewHas('getUserLogin');
        $response->assertViewHas('getRoleAdmin');
    }

    public function testFavoritePostBlog()
    {
        $user = User::factory()->create();

        $dummyDataPost = [
            'user_id' => $user->id,
            'uuid' => 'fbd66c8c-8163-440e-889f-b44c8643ccd5',
            'title' => 'hello favorite',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        ];
        $post = Post::factory()->create($dummyDataPost);

        $dummyDataLike = [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'status' => 1,
        ];
        $like = Like::factory()->create($dummyDataLike);

        $this->actingAs($user);
        $response = $this->get('/blog/favorite');
        $response->assertStatus(200);
        $response->assertViewIs('pages.blog.favorite.index');
        $response->assertViewHas('getFavoritePost', function ($favoritePosts) use ($user) {
            $getIdUserNow = $user->id;
            $expectedPosts = Like::with('posts')->where('user_id', $getIdUserNow)->latest()->paginate(5);

            return $favoritePosts->toJson() === $expectedPosts->toJson();
        });
        $response->assertViewHas('getUserLogin');
        $response->assertViewHas('getRoleAdmin');
    }
}
