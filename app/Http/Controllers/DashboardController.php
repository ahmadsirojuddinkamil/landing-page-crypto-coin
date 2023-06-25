<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $getUserLogin = $this->userService->getUserLogin();
        $getRoleAdmin = $this->userService->getRoleAdmin();

        return view('pages.dashboard.index', compact('getUserLogin', 'getRoleAdmin'));
    }
}
