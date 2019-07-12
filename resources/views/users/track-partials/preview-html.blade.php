<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $bar->meta_title ? $bar->meta_title : 'Conversion Perfect' }}</title>
    <meta name="keywords" content="{{ $bar->meta_keywords ? $bar->meta_keywords : trans('meta.keyword') }}"/>
    <meta name="description" content="{{ $bar->meta_description ? $bar->meta_description : trans('meta.og_description') }}"/>
    <link rel="dns-prefetch" href="//fonts.gstatic.com"/>
    <!-- Scripts -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i|Open+Sans:300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet"/>
    <style type="text/css">
        body * {
            font-family: "Open Sans", sans-serif;
        }

        .disableSelection {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            outline: 0;
            color: inherit;
            opacity: 0.5;
            width: 90%;
        }
        
        .video-code-preview iframe {
            width: 280px !important;
            height: 158px !important;
        }
        
        .cta-preview--cp-bar {
            display: none;
        }
        
        .main-preview--cp-bar, .cta-preview--cp-bar {
            -webkit-transition: top .7s, bottom .7s;
            -moz-transition: top .7s, bottom .7s;
            -o-transition: top .7s, bottom .7s;
            transition: top .7s, bottom .7s;
        }
        
        input::-webkit-input-placeholder {
            color: inherit;
            opacity: .5;
        }
        
        input:-ms-input-placeholder {
            color: inherit;
            opacity: .5;
        }
        
        input::-ms-input-placeholder {
            color: inherit;
            opacity: .5;
        }
        
        input::placeholder {
            color: inherit;
            opacity: .5;
        }
        
        input:focus {
            outline: 0 !important;
            box-shadow: none;
        }
        
        .cp--bar--close-btn, button {
            cursor: pointer;
        }
        
        button:focus, button:active {
            outline: 0 !important;
        }
    </style>
</head>
<body style="padding: 0;margin: 0;">
@include('users.track-partials.preview-sample')
<div id="main-preview--cp-bar-{{ $bar->id }}" class="main-preview--cp-bar" style="width: 100%;margin: 0 !important;padding: 0 !important;z-index: 99999999;
    top: {{ $bar->position == 'top' || $bar->position == 'top_sticky' ? '-450px' : 'auto' }};
    bottom: {{ $bar->position == 'bottom' ? '-450px' : 'auto' }};
    left: 0; position: {{ $bar->position == 'top' ? 'relative' : 'fixed' }}">
    @include('users.track-partials.preview-main')
</div>
@if ($bar->integration_type != 'none')
    <div id="cta-preview--cp-bar-{{ $bar->id }}" class="cta-preview--cp-bar" style="width: 100%;margin: 0 !important;padding: 0 !important;z-index: 99999999;
        top: {{ $bar->position == 'top' || $bar->position == 'top_sticky' ? '-450px' : 'auto' }};
        bottom: {{ $bar->position == 'bottom' ? '-450px' : 'auto' }};
        left: 0; position: {{ $bar->position == 'top' ? 'relative' : 'fixed' }}">
        @if ($bar->opt_in_type == 'standard')
            @include('users.track-partials.preview-cta-standard')
        @else
            @include('users.track-partials.preview-cta-media')
        @endif
    </div>
@endif
<script type="text/javascript">
    window.__cp_bar_config = {
        '{{ $bar->id }}': {
            BASE: '{{ request()->root() }}',
            bar: eval({!! json_encode($bar) !!}),
            token: '{{ csrf_token() }}',
            countdown_target: '{{ $bar->countdown == 'none' ? '' : ($bar->countdown == 'calendar' ? (date('F d, Y', strtotime($bar->countdown_end_date)) . ' ' . $bar->countdown_end_time) :
            getCountdownTarget($bar->countdown_days, $bar->countdown_hours, $bar->countdown_minutes, $bar->created_at)) }}'
        },
        bar_id: '{{ $bar->id }}'
    };
</script>
<script type="text/javascript" src="{{ url(mix('js/manifest.js')) }}"></script>
<script type="text/javascript" src="{{ url(mix('js/vendor.js')) }}"></script>
<script type="text/javascript" src="{{ url(mix('js/html-bar.js')) }}"></script>
{{--<script data-cfasync="false" src="https://app.conversionperfect.com/cp-embed-script/8"></script>--}}
{{--<script data-cfasync="false" src="//localhost:3000/cp-embed-script/3"></script>--}}
</body>
</html>
