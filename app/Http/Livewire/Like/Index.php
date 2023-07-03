<?php

namespace App\Http\Livewire\Like;

use App\Models\{Like, Post};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    // from mount
    public $saveRoomUuidFromComponentCall, $getIdRoomPost;

    // for function
    public $statusLikeOrNot, $saveChangeLikeOrNot;

    public function mount($getUuidFromComponentCall)
    {
        $this->saveRoomUuidFromComponentCall = $getUuidFromComponentCall;
        $this->getIdRoomPost = Post::where('uuid', $this->saveRoomUuidFromComponentCall)->first();
    }

    public function render()
    {
        $this->statusLikeOrNot = Like::with('users')->where('post_id', $this->getIdRoomPost->id)->first();
        return view('livewire.like.index');
    }

    public function store()
    {
        try {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $this->getIdRoomPost->id,
                'status' => 1,
            ]);
            session()->flash('success', 'Like Created Successfully!!');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function delete()
    {
        try {
            Like::where('post_id', $this->getIdRoomPost->id)->delete();
            session()->flash('success', "Post Deleted Successfully!");
        } catch (\Exception $failedToDelete) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
