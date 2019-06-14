@extends('backend.app')
@push('styles')
    <link rel="stylesheet" href="{{asset('/css/bootstrap-colorpicker.min.css')}}">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
@endpush
@php
    $isEdit = isset($slider)?true:false;
@endphp
@section('content')
    <div class="row" id="slider">
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
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        $(function () {
            // Basic instantiation:
            $('#headline-color').colorpicker();
            $('#sub-headline-color').colorpicker();
            $('#bar-color').colorpicker();
            $('#bg-color-start').colorpicker();
            var data = 'hello world';
            $('#description').summernote('code',data);

            $('#headline-color').on('colorpickerChange', function(event) {
                bar.headline_color = event.color.toString();
            });

            $('#sub-headline-color').on('colorpickerChange', function(event) {
                bar.sub_headline_color = event.color.toString();
            });

            $('#bg-color-start').on('colorpickerChange', function(event) {
                bar.bg_color_start = event.color.toString();
            });
        });
    </script>
    <script>
        var bar = new Vue({
            el: '#slider',
            data: {
                headline: 'Your headline goes here !!!',
                sub_headline: 'You sub headline goes here !!!',
                description: 'Some message to appear for your bar',
                headline_color: '#fff',
                sub_headline_color: '#fff',
                bg_color_start: '#fd5d22',
                bg_color_end: '#fd5d22',
                bg_gradient: false,
                bg_gradient_angle: 0,
                opacity: 1,
            },

            computed:{

                show_bg_color_end_container: () => {
                    if (this.bg_gradient){
                        return true;
                    } else {
                        return false;
                    }
                },
            }
        });
    </script>
@endpush

