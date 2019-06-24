<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{asset('/img/logo.png')}}" class="navbar-brand-img" alt="...">
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
        @php
        $routeGroup = routeGroup();
        @endphp
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{$routeGroup==='dashboard'?'active':''}}" href="{{route('dashboard')}}">
                            <i class="ni ni-shop text-green"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$routeGroup==='slider'?'active':''}}"
                           href="#navbar-slider" data-toggle="collapse" role="button" aria-expanded="{{$routeGroup==='slider'?'true':'false'}}" aria-controls="navbar-slider">
                            <i class="ni ni-credit-card text-cp"></i>
                            <span class="nav-link-text">Slider</span>
                        </a>
                        <div class="collapse {{$routeGroup==='slider'?'show':''}}" id="navbar-slider">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('sliders.index')}}" class="nav-link">Bars</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Pages</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Groups</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$routeGroup==='reports'?'active':''}}" href="#navbar-reports" data-toggle="collapse" role="button"  aria-expanded="{{$routeGroup==='reports'?'true':'false'}}" aria-controls="navbar-reports">
                            <i class="ni ni-chart-pie-35 text-cp"></i>
                            <span class="nav-link-text">Reports</span>
                        </a>
                        <div class="collapse {{$routeGroup==='reports'?'show':''}}" id="navbar-reports">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Bars</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Pages</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Emails</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$routeGroup==='settings'?'active':''}}" href="#navbar-Settings" data-toggle="collapse" role="button"  aria-expanded="{{$routeGroup==='settings'?'true':'false'}}" aria-controls="navbar-Settings">
                            <i class="fas fa-cogs text-cp"></i>
                            <span class="nav-link-text">Settings</span>
                        </a>
                        <div class="collapse {{$routeGroup==='settings'?'show':''}}" id="navbar-Settings">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Domain</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Integrations</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <hr class="my-3">
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{$routeGroup==='bonuses'?'active':''}}" href="#">
                            <i class="ni ni-money-coins text-cp"></i>
                            <span class="nav-link-text">Bonuses</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{$routeGroup==='support'?'active':''}}" href="#navbar-support" data-toggle="collapse" role="button"  aria-expanded="{{$routeGroup==='support'?'true':'false'}}" aria-controls="navbar-support">
                            <i class="ni ni-support-16 text-cp"></i>
                            <span class="nav-link-text">Support</span>
                        </a>
                        <div class="collapse {{$routeGroup==='support'?'show':''}}" id="navbar-support">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Tutorials</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Tickets</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{$routeGroup==='account'?'active':''}}" >
                            <i class="ni ni-single-02 text-cp"></i>
                            <span class="nav-link-text">Account</span>
                        </a>
                    </li>
                    <li class="nav-item">

                        <form action="{{route('logout')}}" method="POST">
                            {{csrf_field()}}
                            <a href="#" class="nav-link logout">
                                <i class="fas fa-sign-out-alt text-cp"></i>
                                <span class="nav-link-text">Logout</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>