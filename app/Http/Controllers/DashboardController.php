<?php

namespace App\Http\Controllers;

use App\Models\{Comment, Like, Post, User};
use App\Services\UserService;

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

        $getTotalPost = Post::count();
        $getLatestPostDate = Post::max('created_at');

        $getTotalComment = Comment::count();
        $getLatestCommentDate = Comment::max('created_at');

        $getTotalLike = Like::count();
        $getLatestLikeDate = Like::max('created_at');

        $getTotalUser = User::count();
        $getLatestUserDate = User::max('created_at');

        return view('pages.dashboard.index', compact('getUserLogin', 'getRoleAdmin', 'getTotalPost', 'getLatestPostDate', 'getTotalComment', 'getLatestCommentDate', 'getTotalLike', 'getLatestLikeDate', 'getTotalUser', 'getLatestUserDate'));
    }
}
