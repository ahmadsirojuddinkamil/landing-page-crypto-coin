<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $getAllPost = Post::latest()->paginate(5);

        return view('pages.blog.home.index', compact('getAllPost', 'getUserLogin', 'getRoleAdmin'));
    }

    public function about()
    {
        $getUserLogin = $this->userService->getUserLogin();
        $getRoleAdmin = $this->userService->getRoleAdmin();

        return view('pages.blog.about.index', compact('getUserLogin', 'getRoleAdmin'));
    }

    public function contact()
    {
        $getUserLogin = $this->userService->getUserLogin();
        $getRoleAdmin = $this->userService->getRoleAdmin();

        return view('pages.blog.contact.index', compact('getUserLogin', 'getRoleAdmin'));
    }
}
