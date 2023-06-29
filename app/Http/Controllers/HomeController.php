<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $checkRoleAdminAlready = Role::where('name', 'admin')->first();
        if (!$checkRoleAdminAlready) {
            Role::create(['name' => 'admin']);
            $findAndGetUserNow = Auth::user();
            $findAndGetUserNow->assignRole('admin');
        }

        $getUserLogin = $this->userService->getUserLogin();
        $getRoleAdmin = $this->userService->getRoleAdmin();
        $getAllPost = Post::with('likes')->latest()->paginate(5);

        return view('pages.blog.home.index', compact('getAllPost', 'getUserLogin', 'getRoleAdmin'));
    }

    public function about()
    {
        $getUserLogin = $this->userService->getUserLogin();
        $getRoleAdmin = $this->userService->getRoleAdmin();

        return view('pages.blog.about.index', compact('getUserLogin', 'getRoleAdmin'));
    }

    public function show($saveUuidFromRoute)
    {
        $getUserLogin = $this->userService->getUserLogin();
        $getRoleAdmin = $this->userService->getRoleAdmin();
        $findAndGetDataPost = Post::where('uuid', $saveUuidFromRoute)->first();

        return view('pages.blog.home.show', compact('findAndGetDataPost', 'getUserLogin', 'getRoleAdmin'));
    }

    public function favorite()
    {
        $getUserLogin = $this->userService->getUserLogin();
        $getRoleAdmin = $this->userService->getRoleAdmin();

        $getIdUserNow = Auth::id();
        $getFavoritePost = Like::with('posts')->where('user_id', $getIdUserNow)->latest()->paginate(5);

        return view('pages.blog.favorite.index', compact('getUserLogin', 'getRoleAdmin', 'getFavoritePost'));
    }
}
