<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">

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
