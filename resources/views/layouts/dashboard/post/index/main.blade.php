<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Post</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Post</h6>
            </nav>

            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here...">
                    </div>
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0">
                            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell cursor-pointer"></i>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                            aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="assetsDashboard/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New message</span> from Laur
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                13 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div>
                            <a href="post/create" class="btn bg-gradient-primary">Create Post</a>
                            @if (session()->has('success'))
                                <div id="alert-success">
                                    <div class="alert alert-success d-flex justify-content-center text-white"
                                        role="alert">
                                        {{ session('success') }}
                                    </div>
                                </div>

                                <script>
                                    setTimeout(function() {
                                        document.getElementById('alert-success').style.display = 'none';
                                    }, 5000);
                                </script>
                            @endif
                        </div>
                    </div>

                    <div class="table-responsive">
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
                                            <h6 class="text-sm mb-0">{{ $post->title }}</h6>
                                        </td>

                                        <td>
                                            <h6 class="text-sm mb-0">{{ Str::limit($post->content, 30) }}</h6>
                                        </td>

                                        <td>
                                            <div class="col">
                                                <a href="/post/{{ $post->uuid }}"
                                                    class="bg-success p-1 border-radius-2xl ms-2">
                                                    <i class="bi bi-eye-fill text-white"></i>
                                                </a>

                                                <a href="/post/{{ $post->uuid }}/edit"
                                                    class="bg-primary p-1 border-radius-2xl ms-2">
                                                    <i class="bi bi-pencil-square text-white"></i>
                                                </a>

                                                <a class="bg-danger p-1 border-radius-2xl ms-2" data-bs-toggle="modal"
                                                    data-bs-target="#deletePostModal{{ $post->uuid }}">
                                                    <i class="bi bi-trash-fill text-white"></i>
                                                </a>

                                                <div class="modal fade" id="deletePostModal{{ $post->uuid }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Delete Post</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card align-items-center">
                                                                    <div class="card-body ">
                                                                        <a href="javascript:;"
                                                                            class="card-title h5 d-block text-darker">
                                                                            Are you sure to delete this post?
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn bg-gradient-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button"
                                                                    class="btn bg-gradient-primary">Save
                                                                    changes</button>
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
                </div>
            </div>
        </div>
    </div>
</main>
