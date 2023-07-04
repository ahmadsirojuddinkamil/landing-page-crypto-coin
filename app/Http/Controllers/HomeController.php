<?php

namespace App\Http\Controllers;

use App\Models\{Like, Post, User};
use App\Services\UserService;
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
        $this->createRoleAdmin();

        // check all users if already have admin role
        $usersWithAdminRole = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->pluck('id');

        $getUserLogin = $this->userService->getUserLogin();
        $getRoleAdmin = $this->userService->getRoleAdmin();
        $getAllPost = Post::with('likes')->latest()->paginate(5);

        return view('pages.blog.home.index', compact('getAllPost', 'getUserLogin', 'getRoleAdmin', 'usersWithAdminRole'));
    }

    public function createRoleAdmin()
    {
        $checkRoleAdminAlready = Role::where('name', 'admin')->first();
        if (!$checkRoleAdminAlready) {
            Role::create(['name' => 'admin']);
        }
    }

    public function assignRoleAdmin()
    {
        $findAndGetUserNow = Auth::user();
        $findAndGetUserNow->assignRole('admin');

        return redirect('/')->with('success', "Congratulations you become admin!");
    }

    public function about()
    {
        $getUserLogin = $this->userService->getUserLogin();
        $getRoleAdmin = $this->userService->getRoleAdmin();

        return view('pages.blog.about.index', compact('getUserLogin', 'getRoleAdmin'));
    }

    public function show($saveUuidFromRoute)
    {
        $findAndGetDataPost = Post::where('uuid', $saveUuidFromRoute)->first();
        $getUserLogin = $this->userService->getUserLogin();
        $getRoleAdmin = $this->userService->getRoleAdmin();

        return view('pages.blog.home.show', compact('findAndGetDataPost', 'getUserLogin', 'getRoleAdmin'));
    }

    public function favorite()
    {
        $getIdUserNow = Auth::id();
        $getFavoritePost = Like::with('posts')->where('user_id', $getIdUserNow)->latest()->paginate(5);

        $getUserLogin = $this->userService->getUserLogin();
        $getRoleAdmin = $this->userService->getRoleAdmin();

        return view('pages.blog.favorite.index', compact('getUserLogin', 'getRoleAdmin', 'getFavoritePost'));
    }
}
