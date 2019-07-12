<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $bar->meta_title ? $bar->meta_title : 'Conversion Perfect' }}</title>
    <meta name="keywords" content="{{ $bar->meta_keywords ? $bar->meta_keywords : trans('meta.keyword') }}"/>
    <meta name="description" content="{{ $bar->meta_description ? $bar->meta_description : trans('meta.og_description') }}"/>
    <style>
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
    </style>
</head>
<body style="padding: 0;margin: 0;">
@include('users.track-partials.preview-layout')
@include('users.track-partials.preview-sample')
</body>
</html>
