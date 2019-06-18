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

@push('scripts')
    <script src="{{asset('/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        $(function () {
            // Basic instantiation:
            $('#heading-color').colorpicker();
            $('#sub-heading-color').colorpicker();
            $('#bar-color').colorpicker();
            $('#bg-color-start').colorpicker();
            var data = 'hello world';
            $('#description').summernote('code', data);

            $('#heading-color').on('colorpickerChange', function (event) {
                bar.heading_color = event.color.toString();
            });

            $('#sub-heading-color').on('colorpickerChange', function (event) {
                bar.sub_heading_color = event.color.toString();
            });

            $('#bg-color-start').on('colorpickerChange', function (event) {
                bar.bg_color_start = event.color.toString();
            });
        });
    </script>
    <script>
            <?php
            if($isEdit){
            ?>
        var preFillData = {
                heading: "{{$slider->heading?$slider->heading:'Slider heading goes here'}}",
                sub_heading: "{{$slider->subheading?$slider->subheading:'Slider SubHeading goes here.'}}",
                description: 'Some message to appear for your bar',
                heading_color: "{{isset($slider->appearance['heading_color'])?$slider->appearance['heading_color']:'#ffffff'}}",
                sub_heading_color: '#fff',
                bg_color_start: '#fd5d22',
                bg_color_end: '#fd5d22',
                bg_gradient: false,
                bg_gradient_angle: 0,
                opacity: 1,
                video_code: '',
            };
            <?php
            } else {
            ?>
        var preFillData = {
                heading: 'Slider heading goes here',
                sub_heading: 'Slider SubHeading goes here.',
                description: 'Some message to appear for your bar',
                heading_color: "#ffffff",
                sub_heading_color: '#fff',
                bg_color_start: '#fd5d22',
                bg_color_end: '#fd5d22',
                bg_gradient: false,
                bg_gradient_angle: 0,
                opacity: 1,
                video_code: ''
            };
            <?php
            }
            ?>

        var bar = new Vue({
                el: '#slider',
                data: preFillData,
                computed: {

                    show_bg_color_end_container: () => {
                        if (this.bg_gradient) {
                            return true;
                        } else {
                            return false;
                        }
                    },
                },
                methods : {
                    updateSlider: () => {
                        console.log(this.data);
                    }
                },
            });
    </script>
@endpush

