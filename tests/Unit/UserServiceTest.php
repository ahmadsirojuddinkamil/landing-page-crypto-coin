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

    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testGetRoleAdminReturnsAdminRole()
    {
        $adminRole = Role::where('name', 'admin')->first();

        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'admin']);
        }

        $userService = new UserService();
        $roleAdmin = $userService->getRoleAdmin();

        $this->assertInstanceOf(Role::class, $roleAdmin);
        $this->assertEquals($adminRole->id, $roleAdmin->id);
        $this->assertEquals('admin', $roleAdmin->name);
    }

    public function testCheckAndAssignAdminRole()
    {
        $adminRole = Role::where('name', 'admin')->first();
        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'admin']);
        }

        $user = User::factory()->create();
        $user->assignRole($adminRole);
        $userService = new UserService();
        $userService->checkAndAssignAdminRole();
        $user->refresh();

        $this->assertTrue($user->hasRole($adminRole));
    }
}
