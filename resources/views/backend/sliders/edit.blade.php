@extends('backend.app')
@php
    $isEdit = isset($slider)?true:false;
@endphp
@section('styles')
    <link rel="stylesheet" href="{{asset('/css/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendor/quill/dist/quill.core.css')}}"/>
    <link rel="stylesheet" href="{{asset('/assets/vendor/select2/dist/css/select2.min.css')}}"/>
    <style type="text/css">
        .select2-height-fix + span.select2 .select2-selection--single {
            height: calc(1.5em + 1.25rem + 2px) !important;
            border: none;
            border: 1px solid #dee2e6;
        }
    </style>
@endsection
@section('content')
    <div class="row" id="slider">
        <div class="col">
            <div class="card-wrapper">
                <div class="card" style="position:relative;">
                    <div class="card-header">
                        <div class="form-row">
                            <h3 class="mb-0 fa-pull-left">{{$isEdit?"Edit ":"Create "}} Slider</h3>
                            <div class="col text-right">
                                <button class="btn btn-icon btn-primary btn-sm" id="save" type="button">
                                    <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                                    <span class="btn-inner--text">Save</span>
                                </button>
                                <button class="btn btn-icon btn-primary btn-sm" id="save-exit" type="button">
                                    <span class="btn-inner--icon"><i class="ni ni-send"></i></span>
                                    <span class="btn-inner--text">Save & Exit</span>
                                </button>

                                <a href="{{route('sliders.index')}}" class="btn btn-warning btn-sm"> Cancel </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="sliderName">Slider Name *</label>
                                    <input type="text" class="form-control" value="{{$isEdit?$slider->name:''}}"
                                           id="slider-name" required>
                                    @if($isEdit)
                                        <input name="id" id="slider_id" type="hidden" value="{{$slider->id}}"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt--3">
                    <div class="card-header pt-2 pb-2 division-card-header">
                        <h3 class="mb-0 card-title">Options</h3>
                    </div>
                    <div class="card-body pt-3 pb-3">
                        <div class="form-row">
                            <div class="col mt--2">
                                <button id="appearance"
                                        class="btn btn-icon btn-outline-default btn-sm  option">
                                    <span class="btn-inner--icon"><i class="ni ni-camera-compact"></i></span>
                                    <span class="btn-inner--text">
                                        Appearance</span>
                                </button>

                                <button id="settings"
                                        class="btn btn-icon btn-outline-default btn-sm option">
                                    <span class="btn-inner--icon"><i class="ni ni-settings"></i></span>
                                    <span class="btn-inner--text">
                                        Settings</span>
                                </button>
                                <button id="ticker"
                                        class="btn btn-icon btn-outline-default btn-sm option">
                                    <span class="btn-inner--icon"><i class="ni ni-watch-time"></i></span>
                                    <span class="btn-inner--text">
                                        Countdown</span>
                                </button>
                                <button id="button"
                                        class="btn btn-icon btn-outline-default btn-sm option">
                                    <span class="btn-inner--icon"><i class="ni ni-controller"></i></span>
                                    <span class="btn-inner--text">
                                        Button</span>
                                </button>
                                <button id="opt-in-apperance"
                                        class="btn btn-icon btn-outline-default btn-sm option">
                                    <span class="btn-inner--icon"><i class="ni ni-single-02"></i></span>
                                    <span class="btn-inner--text">
                                        Opt-In Appearance</span>
                                </button>
                                <button id="opt-in-settings"
                                        class="btn btn-icon btn-outline-default btn-sm option">
                                    <span class="btn-inner--icon"><i class="ni ni-settings-gear-65"></i></span>
                                    <span class="btn-inner--text">
                                        Opt-In Settings</span>
                                </button>
                                <button id="pro-features"
                                        class="btn btn-icon btn-outline-default btn-sm option">
                                    <span class="btn-inner--icon"><i class="ni ni-diamond"></i></span>
                                    <span class="btn-inner--text">
                                        Pro Features</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="section-cards">
                    @include('backend.sliders.shared.appearance')
                    @include('backend.sliders.shared.settings')
                    @include('backend.sliders.shared.countdown')
                    @include('backend.sliders.shared.button')
                </div>

            </div>
            <div class="card preview">
                <div class="card-header">
                    <h3>Preview</h3>
                </div>
                <div class="card-body">
                    @include('backend.sliders.shared.preview')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('/assets/vendor/quill/dist/quill.min.js')}}"></script>
    <script src="{{asset('/assets/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script type="text/javascript">
        var target = '';
        $(function () {
            $('.color-picker').colorpicker();
            $('#save-exit').click(function (e) {
                target = 'exit';
                submitForm();
            });
            $('#save').click(function (e) {
                submitForm();
            });

            $('#section-cards').on('click', '.hide-card-btn', function (event) {
                var relatedCard = $(this).closest('.card');
                var cardId = $(relatedCard).attr('id');
                var relatedBtnId = cardId.replace('-card', '');
                $('#' + relatedBtnId).show();
                $(relatedCard).hide();
            });

            $('.option').on('click', function (event) {
                var relatedCard = '#' + $(this).attr('id') + '-card';
                $(relatedCard).show();
                $(this).hide();
            });
        });

        function validate($formData) {
            if ('' == $formData.slider_name.trim()) {
                return {
                    status: false,
                    message: 'Slider name can not be empty'
                }
            }
            return {
                status: true,
            }
        }

        function submitForm() {
            $formData = {};
            $formData.html = $('#previewbar').html();
            $formData.slider_id = $('#slider_id').val();
            $formData.slider_name = $('#slider-name').val();
            $formData.appearance = slider.$data.appearance;
            $formData.settings = slider.$data.settings;
            $formData.countdown = slider.$data.countdown;
            $formData.button = slider.$data.button;

            $result = validate($formData);
            if (!$result.status) {
                Swal.fire(
                    'Unable to proceed',
                    $result.message,
                    'error'
                );
                return 0;
            }

            $.ajax({
                url: "{{route('sliders.update.ajax')}}",
                method: "POST",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                data: $formData,
            }).done(function (response) {

                if ('exit' != target) {
                    return;
                }
                Swal.fire(
                    'Successfully saved',
                    response.message,
                    'success'
                ).then((result) => {
                    goToListing();
                });
            }).fail(function (error) {
                console.log(error);
                Swal.fire(
                    'Unable to save!',
                    error.message,
                    'error'
                );
            });
        }

        function goToListing() {
            window.location.href = "{{route('sliders.index')}}";
        }
    </script>
    {{--    Vue initilization--}}
    <script>
        var prefillData = {};

        @if($isEdit && ''!=$slider->appearance)
            prefillData.appearance = <?php echo json_encode($slider->appearance); ?>;
        @else
            prefillData.appearance = {
            heading: 'Slider heading goes here',
            subheading: 'Slider SubHeading goes here.',
            description: 'Slider description',
            heading_color: "#ffffff",
            subheading_color: '#ffffff',
            bg_color_start: '#fd5d22',
            bg_color_end: '#fd5d22',
            bg_gradient: false,
            bg_gradient_angle: 0,
            opacity: 1,
            drop_shadow: true,
            video_code: '',
            video_auto_play: true
        };
        @endif

        @if($isEdit && ''!=$slider->settings)
            prefillData.settings = <?php echo json_encode($slider->settings); ?>;
        @else
            prefillData.settings = {
            position: '',
            is_sticky: '',
            push_content_down: '',
            trigger: '',
            delay_seconds: '',
            delay_scroll: '',
            frequency: '',
            show_close_btn: '',
        };
        @endif

        @if($isEdit && ''!=$slider->countdown)
            prefillData.countdown = <?php echo json_encode($slider->countdown); ?>;
        @else
            prefillData.countdown = {
            countdown: '',
            countdown_color: '#fafafa',
            countdown_bgcolor: '#afafaf',
            expiration_action: '',
            expiration_redirect_url: '',
            expiration_text: '',
            evergreen_days: '',
            evergreen_hours: '',
            evergreen_minutes: '',
            fixed_date_time: '',
            fixed_time_zone: ''
        };
        @endif

        @if($isEdit && ''!=$slider->button)
            prefillData.button = <?php echo json_encode($slider->button); ?>;
        @else
            prefillData.button = {
            button_type: '',
            button_text_color: '#fafafa',
            button_bgcolor: '#afafaf',
            button_text: '',
            button_link: '',
            button_target: '',
            button_animation: '',
            evergreen_hours: '',
            evergreen_minutes: '',
            fixed_date_time: '',
            fixed_time_zone: ''
        };
        @endif

        var slider = new Vue({
            el: '#slider',
            data: prefillData,
            computed: {
                isGradDisabled() {
                    return !this.appearance.bg_gradient;
                }
            },
            methods: {
                updateSlider: () => {
                    console.log(this.data);
                }
            },
        });
    </script>
@endsection
