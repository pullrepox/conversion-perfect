@extends('backend.app')
@push('styles')
    <link rel="stylesheet" href="{{asset('/css/bootstrap-colorpicker.min.css')}}">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
@endpush
@php
    $isEdit = isset($slider)?true:false;
@endphp
@section('content')
    <div class="row">
        <div class="col">
            <div class="card-wrapper">
                <!-- Custom form validation -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0 fa-pull-left">{{$isEdit?"Edit ":"Create "}} Slider</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if($isEdit)
                                    Lets Edit
                                @else
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

                                    @include('backend.sliders.shared.appearance')

                                    @include('backend.sliders.shared.preview')


                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

    <script>
        $(function () {
            // Basic instantiation:
            $('#text-color').colorpicker();
            $('#sub-color').colorpicker();
            $('#bar-color').colorpicker();
            $('#bar-text').summernote();
            // Example using an event, to change the color of the .jumbotron background:
            // $('#text-color').on('colorpickerChange', function(event) {
            //     $('.jumbotron').css('background-color', event.color.toString());
            // });
        });
    </script>
@endpush

