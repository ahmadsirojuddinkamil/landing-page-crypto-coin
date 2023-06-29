<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">

            @foreach ($getFavoritePost as $favorite)
                <div class="post-preview">
                    <a href="/blog/{{ $favorite->posts->uuid }}">
                        <h2 class="post-title">{{ Str::limit($favorite->posts->title, 30) }}</h2>
                        <h3 class="post-subtitle">{{ Str::limit($favorite->posts->content, 100) }}</h3>
                    </a>
                    <p class="post-meta">
                        Posted by
                        <span class=" text-dark">Ahmad Sirojuddin Kamil</span>
                        on {{ $favorite->posts->created_at->format('F d, Y') }}
                    </p>
                </div>

                <hr class="my-4" />
            @endforeach

            <div class="ml-3 d-flex justify-content-center">
                {!! $getFavoritePost->links() !!}
            </div>

        </div>
    </div>
</div>
