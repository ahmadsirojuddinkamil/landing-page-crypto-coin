<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserService
{
    public function getUserLogin()
    {
        return Auth::user();
    }

    public function getRoleAdmin()
    {
        return Role::where('name', 'admin')->first();
    }

    public function checkAndAssignAdminRole()
    {
        $getUserLogin = $this->getUserLogin();
        $getRoleAdmin = $this->getRoleAdmin();
        $getAllUser = User::latest()->get();
        $adminUser = $getAllUser->filter(function ($user) use ($getRoleAdmin) {
            return $user->hasRole($getRoleAdmin->name);
        })->first();

        if (!$adminUser) {
            $getUserLogin->assignRole($getRoleAdmin);
        }
    }
}
