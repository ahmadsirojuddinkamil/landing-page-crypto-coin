<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class IndexPost extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;

    public function render()
    {
        $getAllPost = Post::query()->when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })
            ->latest()
            ->paginate(6);

        return view('livewire.post.index-post', compact('getAllPost'));
    }

    public function deletePost($saveUuidFromWireClick)
    {
        try {
            Post::where('uuid', $saveUuidFromWireClick)->delete();
            session()->flash('success', "Post Deleted Successfully!");
        } catch (\Exception $failedToDelete) {
            session()->flash('error', "Something goes wrong!!");
        }
    }

    public function search()
    {
        $this->resetPage();
    }
}
