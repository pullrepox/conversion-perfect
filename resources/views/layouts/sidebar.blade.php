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
                    <li class="nav-item {{ isActiveResource('bars', false) }}">
                        <a class="nav-link {{ isActiveResource('bars', false) }}" href="{{ secure_redirect(route('bars')) }}">
                            <i class="ni ni-credit-card text-cp"></i>
                            <span class="nav-link-text text-capitalize">Conversion Bars</span>
                        </a>
                    </li>
                    <li class="nav-item {{ isActiveResource('split-tests', false) }}">
                        <a class="nav-link {{ isActiveResource('split-tests', false) }}" href="javascript: void(0)"
                           data-href="{{ secure_redirect(route('split-tests')) }}" id="split_test_nav">
                            <i class="ni ni-single-copy-04 text-cp"></i>
                            <span class="nav-link-text text-capitalize">Split Tests</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript: void(0)" data-href="" id="multi_bar_nav">
                            <i class="ni ni-books text-cp"></i>
                            <span class="nav-link-text text-capitalize">Multi Bar</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-reports" data-toggle="collapse" role="button"
                           aria-expanded="false" aria-controls="navbar-reports">
                            <i class="ni ni-chart-pie-35 text-cp"></i>
                            <span class="nav-link-text">Reports</span>
                        </a>
                        <div class="collapse" id="navbar-reports">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-capitalize">
                                        Bars
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-capitalize">Emails</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ isActiveResource(['groups', 'email-lists', 'autoresponder.index']) }}">
                        <a class="nav-link {{ isActiveResource(['groups', 'email-lists', 'autoresponder.index']) }}" href="#navbar-settings" data-toggle="collapse" role="button"
                           aria-expanded="{{ isExpendResource(['groups', 'email-lists', 'autoresponder.index']) }}" aria-controls="navbar-settings">
                            <i class="fas fa-cogs text-cp"></i>
                            <span class="nav-link-text text-capitalize">Settings</span>
                        </a>
                        <div class="collapse {{ isActiveResource(['groups', 'email-lists', 'autoresponder.index', 'autoresponder.create', 'autoresponder.edit'], true, 'show') }}"
                             id="navbar-settings">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item {{ isActiveRoute(['autoresponder.index', 'autoresponder.create', 'autoresponder.edit']) }}">
                                    <a href="{{route('autoresponder.index')}}"
                                       class="nav-link text-capitalize {{ isActiveRoute(['autoresponder.index', 'autoresponder.create', 'autoresponder.edit']) }}">Autoresponders</a>
                                </li>
                                <li class="nav-item {{ isActiveResource(['email-lists']) }}">
                                    <a href="{{ secure_redirect(route('email-lists')) }}" class="nav-link text-capitalize {{ isActiveResource(['email-lists']) }}">Email Lists</a>
                                </li>
                                <li class="nav-item {{ isActiveResource(['groups']) }}">
                                    <a href="{{ secure_redirect(route('groups')) }}" class="nav-link text-capitalize {{ isActiveResource(['groups']) }}">Groups</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <!-- Divider -->
                        <hr class="my-3">
                    </li>
                    <li class="nav-item {{ isActiveRoute('training') }}">
                        <a class="nav-link {{ isActiveRoute('training') }}" href="#navbar-support" data-toggle="collapse" role="button"
                           aria-expanded=" {{ isExpendRoute('training') }}" aria-controls="navbar-support">
                            <i class="ni ni-support-16 text-cp"></i>
                            <span class="nav-link-text text-capitalize">Support</span>
                        </a>
                        <div class="collapse {{ isActiveRoute('training', 'show') }}" id="navbar-support">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-capitalize">FAQ</a>
                                </li>
                                <li class="nav-item {{ isActiveRoute('training') }}">
                                    <a href="{{ secure_redirect(route('training')) }}" class="nav-link text-capitalize {{ isActiveRoute('training') }}">Training</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://control.im.tools/" target="_blank" class="nav-link text-capitalize">Get Support</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ isActiveRoute('account') }}">
                        <a href="{{ secure_redirect(route('account')) }}" class="nav-link text-capitalize {{ isActiveRoute('account') }}">
                            <i class="ni ni-single-02 text-cp"></i>
                            <span class="nav-link-text text-capitalize">Account</span>
                        </a>
                    </li>
                    <li class="nav-item {{ isActiveRoute('bonuses') }}">
                        <a class="nav-link {{ isActiveRoute('bonuses') }}" href="{{ secure_redirect(route('bonuses')) }}">
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
