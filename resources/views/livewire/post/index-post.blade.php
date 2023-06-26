<div class="table-responsive">
    <div class="card-header pb-0 p-3">
        <div>
            <div class="d-flex">
                <a href="post/create" class="btn bg-gradient-primary">Create Post</a>

                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Search User..." wire:model="search">
                    </div>
                </div>
            </div>

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-text d-flex justify-content-center text-white">
                        {{ session('success') }}
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <td>
                    <div class="ms-4">
                        <h6 class="text-sm">#</h6>
                    </div>
                </td>

                <td>
                    <div class="ms-4">
                        <h6 class="text-sm">Title</h6>
                    </div>
                </td>

                <td>
                    <div class="ms-4">
                        <h6 class="text-sm">Content</h6>
                    </div>
                </td>

                <td>
                    <div class="">
                        <h6 class="text-sm">Action</h6>
                    </div>
                </td>
            </tr>
        </thead>

        <tbody>
            @foreach ($getAllPost as $post)
                <tr>
                    <td>
                        <div class="ms-4">
                            <h6 class="text-sm mb-0">
                                {{ ($getAllPost->currentPage() - 1) * $getAllPost->perPage() + $loop->index + 1 }}
                            </h6>
                        </div>
                    </td>

                    <td>
                        <h6 class="text-sm mb-0">{{ Str::limit($post->title, 30) }}</h6>
                    </td>

                    <td>
                        <h6 class="text-sm mb-0">{{ Str::limit($post->content, 30) }}</h6>
                    </td>

                    <td>
                        <div class="col">
                            <a href="/post/{{ $post->uuid }}" class="bg-success p-1 border-radius-2xl ms-2">
                                <i class="bi bi-eye-fill text-white"></i>
                            </a>

                            <a href="/post/{{ $post->uuid }}/edit" class="bg-primary p-1 border-radius-2xl ms-2">
                                <i class="bi bi-pencil-square text-white"></i>
                            </a>

                            <a class="bg-danger p-1 border-radius-2xl ms-2" data-bs-toggle="modal"
                                data-bs-target="#deletePostModal{{ $post->uuid }}">
                                <i class="bi bi-trash-fill text-white"></i>
                            </a>

                            <div class="modal fade" id="deletePostModal{{ $post->uuid }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Delete Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="card align-items-center">
                                                <div class="card-body ">
                                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                        Are you sure to delete this post?
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn bg-gradient-secondary"
                                                data-bs-dismiss="modal">Close</button>

                                            <button wire:click="deletePost('{{ $post->uuid }}')"
                                                class="btn bg-gradient-primary" data-bs-dismiss="modal">Yes!</button>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ms-3">
        {!! $getAllPost->links() !!}
    </div>
</div>
