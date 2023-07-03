<div>
    <!-- Post Content-->
    <section class="gradient-custom">
        <div class="container my-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-7">
                    <div class="card">
                        {{-- list comment --}}
                        <div class="card-body p-4">
                            <h4 class="text-center mb-4 pb-2">Comment</h4>

                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-text d-flex justify-content-center">
                                        {{-- {{ session('success') }} --}}
                                        {{ session()->get('success') }}
                                    </span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col" style="height: 550px; overflow-y: scroll;">
                                    @foreach ($findAndGetAllDataComment as $comment)
                                        <div class="d-flex flex-start">
                                            <img class="rounded-circle shadow-1-strong me-3"
                                                src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                                alt="avatar" width="65" height="65" />

                                            <div class="flex-grow-1 flex-shrink-1">
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="mb-1">
                                                            {{ $comment->users->name }} <span class="small">-
                                                                {{ $comment->created_at }}</span>
                                                        </p>
                                                    </div>

                                                    <p class="small mb-0">
                                                        {{ $comment->content }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- input comment --}}
                        @if (auth()->check())
                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                <form>
                                    <div class="form-group mb-3">
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                            wire:model="saveContentFromInput" placeholder="Message ..." rows="5"></textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button wire:click.prevent="store()"
                                            class="btn btn-success btn-block">Send</button>
                                    </div>
                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
