<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $getAllPost = Post::latest()->paginate(5);
        return view('pages.blog.home.index', compact('getAllPost'));
    }
}
