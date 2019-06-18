@extends('backend.app')
@php
    $isEdit = isset($slider)?true:false;
@endphp
@section('content')
    <div class="row" id="slider">
        <div class="col">
            <div class="card-wrapper">

                <!-- Custom form validation -->
                <div class="card" style="position:relative;">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0 fa-pull-left">{{$isEdit?"Edit ":"Create "}} Slider</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-icon btn-3 btn-secondary" type="button">
                                    <span class="btn-inner--text">Appearance</span>
                                </button>
                                <button class="btn btn-icon btn-3 btn-secondary" type="button">
                                    <span class="btn-inner--text">Settings</span>
                                </button>
                                <button class="btn btn-icon btn-3 btn-secondary" type="button">
                                    <span class="btn-inner--text">Countdown</span>
                                </button>
                                <button class="btn btn-icon btn-3 btn-secondary" type="button">
                                    <span class="btn-inner--text">Button</span>
                                </button>
                                <button class="btn btn-icon btn-3 btn-secondary" type="button">
                                    <span class="btn-inner--text">Opt-In Appearance</span>
                                </button>
                                <button class="btn btn-icon btn-3 btn-secondary" type="button">
                                    <span class="btn-inner--text">Opt-In Settings</span>
                                </button>
                                <button class="btn btn-icon btn-3 btn-secondary" type="button">
                                    <span class="btn-inner--text">Pro Features</span>
                                </button>
                                @php
                                    $url = $isEdit?route('sliders.update',$slider->id):route('sliders.store');
                                @endphp
                                <form method="POST" action="{{$url}}" @submit.prevent="updateSlider()">
                                    @if($isEdit) @method ('PATCH') @endif
                                    {{csrf_field()}}
                                    @include('backend.sliders.shared.appearance')
                                </form>
                                @include('backend.sliders.shared.preview')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
