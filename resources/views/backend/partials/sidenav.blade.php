<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{asset('/assets/img/brand/blue.png')}}" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard')}}">
                            <i class="ni ni-app text-green"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-account" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-account">
                            <i class="ni ni-single-02"></i>
                            <span class="nav-link-text">Account</span>
                        </a>
                        <div class="collapse" id="navbar-account">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Integrations</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Invoices</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Affiliates</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Bonuses</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="ni ni-single-copy-04"></i>
                            <span class="nav-link-text">Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="ni ni-image"></i>
                            <span class="nav-link-text">Sliders</span>
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">Support</h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#" target="_blank">
                            <i class="ni ni-spaceship"></i>
                            <span class="nav-link-text">Tutorials</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" target="_blank">
                            <i class="ni ni-books"></i>
                            <span class="nav-link-text">FAQ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" target="_blank">
                            <i class="ni ni-ungroup"></i>
                            <span class="nav-link-text">Tickets</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" target="_blank">
                            <i class="ni ni-fat-add"></i>
                            <span class="nav-link-text">New Ticket</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>