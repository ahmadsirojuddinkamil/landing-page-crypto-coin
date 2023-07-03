<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p style="white-space: pre-line;">{{ $findAndGetDataPost->content }}</p>
            </div>
        </div>
    </div>
</article>
@livewireStyles
@livewire('commentator.index', ['getUuidFromComponentCall' => $findAndGetDataPost->uuid])
@livewireScripts
