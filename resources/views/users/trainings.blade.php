@extends('layouts.base')
@section('title', 'Training - ' . config('app.name'))
@section('content')
    <div class="main-content">
        @include('layouts.page-header', ['data' => $header_data])
        {{-- Page content --}}
        <div class="container-fluid mt--8">
{{--            <div class="row">--}}
{{--                <div class="col">--}}
{{--                    <div class="card">--}}
{{--                        <!-- Card header -->--}}
{{--                        <div class="card-header border-0">--}}
{{--                            <div class="row">--}}
{{--                                <h3 class="mb-0 col">{{ $header_data['main_name'] }}</h3>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="form-row">
                @if ($trainings)
                    @foreach($trainings as $row)
                        <div class="col-md-6 mt-1">
                            <div class="card">
                                <!-- Card image -->
                                <div class="card-img-top embed-responsive embed-responsive-16by9">
                                    <iframe class="card-img-top embed-responsive-item"
                                            src="{{ $row->video_url }}" allow="autoplay; fullscreen;" allowfullscreen></iframe>
                                </div>
                                <!-- Card body -->
                                <div class="card-body" style="height: 175px;">
                                    <h5 class="h2 card-title mb-0">{{ $row->title }}</h5>
                                    <p class="card-text mt-4">{{ $row->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
