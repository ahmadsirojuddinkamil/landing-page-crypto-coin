<?php

namespace App\Http\Livewire\Commentator;

use App\Models\{Comment, Post};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    // from mount
    public $findAndGetAllDataComment, $saveRoomUuidFromComponentCall, $getIdRoomPost;

    // for function
    public $saveContentFromInput;

    protected $rules = [
        'saveContentFromInput' => 'required|filled|string',
    ];

    public function mount($getUuidFromComponentCall)
    {
        $this->saveRoomUuidFromComponentCall = $getUuidFromComponentCall;
        $this->getIdRoomPost = Post::where('uuid', $this->saveRoomUuidFromComponentCall)->first();
    }

    public function render()
    {
        $this->findAndGetAllDataComment = Comment::with('users')->where('post_id', $this->getIdRoomPost->id)->latest()->get();
        return view('livewire.commentator.index');
    }

    public function store()
    {
        $this->validate();

        try {
            Comment::create([
                'user_id' => Auth::id(),
                'post_id' => $this->getIdRoomPost->id,
                'uuid' => $this->saveRoomUuidFromComponentCall,
                'content' => $this->saveContentFromInput,
            ]);

            $this->saveContentFromInput = '';
            session()->flash('success', 'Post Created Successfully!!');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }
}
