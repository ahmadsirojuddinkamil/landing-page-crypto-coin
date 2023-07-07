<?php

namespace Tests\Unit;

use App\Http\Controllers\DashboardController;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testConstructorGetDataFromUserService()
    {
        $dashboardController = new DashboardController($this->createMock(UserService::class));
        $reflectionClass = new \ReflectionClass(DashboardController::class);
        $reflectionProperty = $reflectionClass->getProperty('userService');
        $reflectionProperty->setAccessible(true);
        $userService = $reflectionProperty->getValue($dashboardController);

        $this->assertInstanceOf(UserService::class, $userService);
    }

    public function testDisplayDataInDashboard()
    {
        $user = User::factory()->create();
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user->assignRole($adminRole);

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);

        $response->assertViewIs('pages.dashboard.index');
        $response->assertViewHas('getUserLogin');
        $response->assertViewHas('getRoleAdmin');
        $response->assertViewHas('getTotalPost');
        $response->assertViewHas('getLatestPostDate');
        $response->assertViewHas('getTotalComment');
        $response->assertViewHas('getLatestCommentDate');
        $response->assertViewHas('getTotalLike');
        $response->assertViewHas('getLatestLikeDate');
        $response->assertViewHas('getTotalUser');
        $response->assertViewHas('getLatestUserDate');
    }
}
