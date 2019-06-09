<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="ConversionPerfect is an interactive bar top of your websites to attract viewers attention.">
    <meta name="author" content="ConversionPerfect">
    <title>@yield('title',"Dashboard - Conversion Perfect")</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('/assets/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}"
          type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css/argon.css')}}" type="text/css">

    @yield('styles')
</head>

<body>
<!-- Sidenav -->
@include('backend.partials.sidenav')
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
@include('backend.partials.topnav')
<!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            @include('backend.partials.breadcrumb')
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        @yield('content')
        @include('backend.partials.footer')
    </div>
</div>

<script src="{{asset('/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/assets/vendor/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
<!-- Argon JS -->
<script src="{{asset('/assets/js/argon.js')}}"></script>

<script src="{{asset('/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{asset('/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
<!-- Argon JS -->
@yield('scripts')

</body>

</html>