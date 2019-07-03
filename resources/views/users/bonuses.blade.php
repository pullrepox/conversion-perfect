@extends('layouts.base')
@section('title', 'Bonuses - ' . config('app.name'))
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
                @if ($bonuses)
                    @foreach($bonuses as $row)
                        <div class="col-md-4 mt-1">
                            <div class="card">
                                <!-- Card image -->
                                <img class="card-img-top" src="{{ $row->image_url }}" alt="Bonus Image">
                                <!-- Card body -->
                                <div class="card-body">
                                    <h5 class="h2 card-title mb-0">{{ $row->title }}</h5>
                                    <p class="card-text mt-4">{{ $row->description }}</p>
                                    <a href="{{ strpos($row->bonus_url, 'http') === false ? 'https://' . $row->bonus_url : $row->bonus_url }}" class="btn btn-link px-0"
                                       target="{{ $row->new_window ? '_blank' : '_self' }}">{{ $row->link_text }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
