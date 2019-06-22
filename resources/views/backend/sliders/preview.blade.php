@extends('frontend.app')
@section('title','Preview - Conversion Perfect')

{{--

This should call js which should do the html rendering on top of the content of page

--}}
@section('content')

    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div id="htmlBlock">
            {!! $slider->html !!}
            </div>
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-white">Welcome!</h1>
                        <p class="text-lead text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <img src="{{asset('assets/img/mockup.gif')}}" alt="" style="width: 100%">
                <img src="{{asset('assets/img/mockup.gif')}}" alt="" style="width: 100%">
                <img src="{{asset('assets/img/mockup.gif')}}" alt="" style="width: 100%">
                <img src="{{asset('assets/img/mockup.gif')}}" alt="" style="width: 100%">
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        #htmlBlock {
            border:1px solid red;
            align-content: initial;
            align-items: initial;
            align-self: initial;
            alignment-baseline: initial;
            animation: initial;
            backface-visibility: initial;
            background: initial;
        }
    </style>
@endsection
