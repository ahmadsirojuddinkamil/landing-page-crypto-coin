<!-- Page Header-->
<header class="masthead" style="background-image: url('assetsBlog/assets/img/post-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1>{{ $findAndGetDataPost->title }}</h1>
                    <h2 class="subheading">{{ Str::limit($findAndGetDataPost->content, 50) }}</h2>
                    <span class="meta d-flex justify-content-between">
                        Posted by Ahmad Sirojuddin Kamil on {{ $findAndGetDataPost->created_at->format('F d, Y') }}
                        <div>
                            @livewire('like.index', ['getUuidFromComponentCall' => $findAndGetDataPost->uuid])
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
