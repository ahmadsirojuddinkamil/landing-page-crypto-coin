<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validateData = $request->validated();
        $validateData['user_id'] = Auth::id();
        $validateData['uuid'] = Uuid::uuid4()->toString();
        Post::create($validateData);
        return redirect('post')->with('success', 'Post has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show($saveUuidFromRoute)
    {
        $getDataPost = Post::where('uuid', $saveUuidFromRoute)->first();
        return view('pages.dashboard.post.show', compact('getDataPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($saveUuidFromRoute)
    {
        $getDataPost = Post::where('uuid', $saveUuidFromRoute)->first();
        return view('pages.dashboard.post.edit', compact('getDataPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $saveUuidFromRoute)
    {
        $validateData = $request->validated();
        Post::where('uuid', $saveUuidFromRoute)->update($validateData);
        return redirect('/post')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
    }
}
