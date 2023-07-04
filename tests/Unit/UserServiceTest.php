<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    // public function test_example(): void
    // {
    //     $this->assertTrue(true);
    // }

    public function testGetRoleAdminReturnsAdminRole()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userService = new UserService();
        $roleAdmin = $userService->getRoleAdmin();

        $this->assertInstanceOf(Role::class, $roleAdmin);
        $this->assertEquals($adminRole->id, $roleAdmin->id);
        $this->assertEquals('admin', $roleAdmin->name);
    }

    public function testCheckAndAssignAdminRole()
    {
        $user = User::factory()->create();
        $adminRole = Role::create(['name' => 'admin']);
        $user->assignRole($adminRole);
        $userService = new UserService();
        $userService->checkAndAssignAdminRole();
        $user->refresh();

        $this->assertTrue($user->hasRole($adminRole));
    }
}
