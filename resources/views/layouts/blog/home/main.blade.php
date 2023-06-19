<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">

            @foreach ($getAllPost as $post)
                <div class="post-preview">
                    <a href="post.html">
                        <h2 class="post-title">{{ $post->title }}</h2>
                        <h3 class="post-subtitle">{{ Str::limit($post->content, 100) }}</h3>
                    </a>
                    <p class="post-meta">
                        Posted by
                        <a href="#!">Ahmad Sirojuddin Kamil</a>
                        on {{ $post->created_at->format('F d, Y') }}
                    </p>
                </div>

                <hr class="my-4" />
            @endforeach

            <div class="ml-3 d-flex justify-content-center">
                {!! $getAllPost->links() !!}
            </div>

        </div>
    </div>
</div>
