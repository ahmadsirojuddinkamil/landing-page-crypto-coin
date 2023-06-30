<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">

            {{-- alert success apply admin --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-text d-flex justify-content-center text-dark">
                        {{ session('success') }}
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- check if you want to be admin --}}
            @if (!$usersWithAdminRole->count() > 0 && $getUserLogin)
                <button id="modalTriggerBtn" type="button" class="btn bg-gradient-primary" style="display: none;"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch demo modal
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Do you want to be an admin?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">No</button>
                                <a href="/createAdmin" class="btn bg-gradient-primary">Ya!</a>
                            </div>

                        </div>
                    </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Menampilkan modal saat halaman dimuat
                        $('#modalTriggerBtn').click();

                        // Mengatur waktu tampilan modal (opsional)
                        setTimeout(function() {
                            $('#exampleModal').modal('hide');
                        }, 20000); // Modal akan disembunyikan setelah 5 detik (5000 milidetik)
                    });
                </script>
            @endif

            @foreach ($getAllPost as $post)
                <div class=" d-flex justify-content-between">
                    <div class="post-preview">
                        <a href="/blog/{{ $post->uuid }}">
                            <h2 class="post-title">{{ Str::limit($post->title, 30) }}</h2>
                            <h3 class="post-subtitle">{{ Str::limit($post->content, 100) }}</h3>
                        </a>

                        <p class="post-meta">
                            Posted by
                            <span class=" text-dark">Ahmad Sirojuddin Kamil</span>
                            on {{ $post->created_at->format('F d, Y') }}
                        </p>
                    </div>

                    {{-- <i class="fas fa-star text-warning"></i> --}}
                    @if ($post->likes->contains('status', true))
                        <i class="fas fa-star text-warning"></i>
                    @endif
                </div>

                <hr class="my-4" />
            @endforeach

            <div class="ml-3 d-flex justify-content-center">
                {!! $getAllPost->links() !!}
            </div>

        </div>
    </div>
</div>
