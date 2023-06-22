<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class IndexPost extends Component
{
    public function render()
    {
        $getAllPost = Post::latest()->paginate(6);
        return view('livewire.post.index-post', compact('getAllPost'));
    }

    public function deletePost($saveUuidFromWireClick)
    {
        try {
            Post::where('uuid', $saveUuidFromWireClick)->delete();
            session()->flash('success', "Post Deleted Successfully!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
