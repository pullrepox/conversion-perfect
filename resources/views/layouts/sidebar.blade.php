<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('img/logo.png', config('site.ssl_tf')) }}" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block active" data-action="sidenav-unpin" data-target="#sidenav-main">
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
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item {{ isActiveRoute('customer.dashboard') }}">
                        <a class="nav-link {{ isActiveRoute('customer.dashboard') }}" href="/">
                            <i class="ni ni-shop text-cp"></i>
                            <span class="nav-link-text text-capitalize">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ isActiveResource(['bars'], true) }}">
                        <a class="nav-link {{ isActiveResource(['bars'], true) }}" href="{{ secure_redirect(route('bars')) }}">
                            <i class="ni ni-credit-card text-cp"></i>
                            <span class="nav-link-text text-capitalize">Conversion Bars</span>
                        </a>
                    </li>
                    <li class="nav-item {{ isActiveRoute(['bars.show']) }}">
                        <a class="nav-link {{ isActiveRoute(['bars.show']) }}" href="#navbar-reports" data-toggle="collapse" role="button"
                           aria-expanded="{{ isExpendRoute(['bars.show']) }}" aria-controls="navbar-reports">
                            <i class="ni ni-chart-pie-35 text-cp"></i>
                            <span class="nav-link-text">Reports</span>
                        </a>
                        <div class="collapse {{ isActiveRoute(['bars.show'], 'show') }}" id="navbar-reports">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item {{ isActiveRoute('bars.show') }}">
                                    <a href="{{ secure_redirect(route('bars.show', ['tracker' => 1])) }}" class="nav-link text-capitalize {{ isActiveRoute('bars.show') }}">
                                        Bars
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-capitalize">Emails</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ isActiveRoute(['groups', 'groups.create', 'autoresponder.index']) }}">
                        <a class="nav-link {{ isActiveRoute(['groups', 'groups.create', 'autoresponder.index']) }}" href="#navbar-settings" data-toggle="collapse" role="button"
                           aria-expanded="{{ isExpendRoute(['groups', 'groups.create', 'autoresponder.index']) }}" aria-controls="navbar-settings">
                            <i class="fas fa-cogs text-cp"></i>
                            <span class="nav-link-text text-capitalize">Settings</span>
                        </a>
                        <div class="collapse {{ isActiveRoute(['groups', 'groups.create', 'autoresponder.index'], 'show') }}" id="navbar-settings">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item {{ isActiveRoute(['autoresponder.index']) }}">
                                    <a href="{{route('autoresponder.index')}}" class="nav-link text-capitalize">Autoresponders</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-capitalize">Domains</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-capitalize">Email Lists</a>
                                </li>
                                <li class="nav-item {{ isActiveResource(['groups'], true) }}">
                                    <a href="{{ secure_redirect(route('groups')) }}" class="nav-link text-capitalize {{ isActiveResource(['groups'], true) }}">Groups</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <!-- Divider -->
                        <hr class="my-3">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-support" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-support">
                            <i class="ni ni-support-16 text-cp"></i>
                            <span class="nav-link-text text-capitalize">Support</span>
                        </a>
                        <div class="collapse" id="navbar-support">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-capitalize">FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-capitalize">Tutorials</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-capitalize">Get Support</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-capitalize">
                            <i class="ni ni-single-02 text-cp"></i>
                            <span class="nav-link-text text-capitalize">Account</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="ni ni-money-coins text-cp"></i>
                            <span class="nav-link-text text-capitalize">Bonuses</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ secure_redirect(route('logout')) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt text-cp"></i>
                            <span class="nav-link-text text-capitalize">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ secure_redirect(route('logout')) }}" method="POST" class="opacity-1 w-1">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
