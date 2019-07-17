<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', "Conversion Perfect")</title>
    
    <meta name="keywords" content="{{ trans('meta.keyword') }}"/>
    <meta name="description" content="{{ trans('meta.og_description') }}"/>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png?v2', config('site.ssl_tf')) }}"/>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com"/>
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css', config('site.ssl_tf')) }}"/>
    <link rel="stylesheet" href="{{ asset('css/users.css', config('site.ssl_tf')) }}"/>
@section('styles')
@show
<!-- Scripts -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <script>
        window.laravel = '{!! json_encode(['csrfToken' => csrf_token()]) !!}';
        
        window._clickAppConfig = {
            BASE: '{{ request()->root() }}',
            Token: JSON.parse(window.laravel).csrfToken,
            alert: {
                success: '{{ ($successMessage = session('success')) ? $successMessage : '' }}',
                info: '{{ ($successMessage = session('info')) ? $successMessage : '' }}',
                warning: '{{ ($successMessage = session('warning')) ? $successMessage : '' }}',
                error: '{{ ($errorMessage = session('error')) ? $errorMessage : '' }}'
            },
            permissions: JSON.parse('{!! $permissions !!}'),
            upgrades: JSON.parse('{!! $upgrades !!}'),
        };
    </script>
</head>
<body class="users-area g-sidenav-show g-sidenav-pinned">
<div id="app">
    @include('layouts.sidebar')
    @include('layouts.topnavbar')
    @yield('content')
    @include('layouts.partials.modals')
</div>
{!! session(['success' => '']) !!}
{!! session(['info' => '']) !!}
{!! session(['warning' => '']) !!}
{!! session(['error' => '']) !!}
<script type="text/javascript" src="{{ url(mix('js/manifest.js')) }}"></script>
<script type="text/javascript" src="{{ url(mix('js/vendor.js')) }}"></script>
<script type="text/javascript" src="{{ url(mix('js/users.js')) }}"></script>
@section('scripts')
@show
</body>
</html>
