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

{{-- <section class="gradient-custom">
    <div class="container my-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-7">
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4 pb-2">Comment</h4>

                        <div class="row">
                            <div class="col">
                                <div class="d-flex flex-start">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" alt="avatar"
                                        width="65" height="65" />

                                    <div class="flex-grow-1 flex-shrink-1">

                                        <div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-1">
                                                    Maria Smantha <span class="small">- 2 hours ago</span>
                                                </p>
                                                <a href="#!"><i class="fas fa-reply fa-xs"></i><span
                                                        class="small"> reply</span></a>
                                            </div>
                                            <p class="small mb-0">
                                                It is a long established fact that a reader will be distracted by
                                                the readable content of a page.
                                            </p>
                                        </div>

                                        <div class="d-flex flex-start mt-4">
                                            <a class="me-3" href="#">
                                                <img class="rounded-circle shadow-1-strong"
                                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp"
                                                    alt="avatar" width="65" height="65" />
                                            </a>

                                            <div class="flex-grow-1 flex-shrink-1">
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="mb-1">
                                                            Simona Disa <span class="small">- 3 hours ago</span>
                                                        </p>
                                                    </div>
                                                    <p class="small mb-0">
                                                        letters, as opposed to using 'Content here, content here',
                                                        making it look like readable English.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-start mt-4">
                                            <a class="me-3" href="#">
                                                <img class="rounded-circle shadow-1-strong"
                                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(32).webp"
                                                    alt="avatar" width="65" height="65" />
                                            </a>
                                            <div class="flex-grow-1 flex-shrink-1">
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="mb-1">
                                                            John Smith <span class="small">- 4 hours ago</span>
                                                        </p>
                                                    </div>
                                                    <p class="small mb-0">
                                                        the majority have suffered alteration in some form, by
                                                        injected humour, or randomised words.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                        <div class="d-flex flex-start w-100">
                            <div class="form-outline w-100">
                                <textarea class="form-control" id="textAreaExample" rows="6" style="background: #fff;" placeholder="Message ..."></textarea>
                            </div>
                        </div>
                        <div class="float-end mt-2 pt-1">
                            <button type="button" class="btn btn-primary btn-sm">Post
                                comment</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section> --}}
