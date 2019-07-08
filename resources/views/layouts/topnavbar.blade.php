<nav class="navbar navbar-top navbar-expand navbar-dark bg-cp border-bottom" id="users-top-navbar">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Search form -->
{{--            <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">--}}
        {{--                <div class="form-group mb-0">--}}
        {{--                    <div class="input-group input-group-alternative input-group-merge">--}}
        {{--                        <div class="input-group-prepend">--}}
        {{--                            <span class="input-group-text"><i class="fas fa-search"></i></span>--}}
        {{--                        </div>--}}
        {{--                        <input class="form-control" placeholder="Search" type="text">--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">--}}
        {{--                    <span aria-hidden="true">×</span>--}}
        {{--                </button>--}}
        {{--            </form>--}}
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
{{--                <li class="nav-item d-sm-none">--}}
{{--                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">--}}
{{--                        <i class="ni ni-zoom-split-in"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
            <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(auth()->user()->email))) }}?s=36&d=mp&r=g">
                            </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
