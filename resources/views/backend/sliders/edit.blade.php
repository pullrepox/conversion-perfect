@extends('backend.app')
@php
    $isEdit = isset($slider)?true:false;
@endphp
@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
@endpush
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
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="appearance-tab" data-toggle="tab"
                                           href="#appearance" role="tab" aria-controls="appearance"
                                           aria-selected="true">Appearance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="settings-tab" data-toggle="tab" href="#settings"
                                           role="tab" aria-controls="settings" aria-selected="true">Settings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="countdown-tab" data-toggle="tab" href="#countdown"
                                           role="tab" aria-controls="countdown" aria-selected="true">Countdown</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="button-tab" data-toggle="tab" href="#button" role="tab"
                                           aria-controls="button" aria-selected="true">Button</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="opt-in-appearance-tab" data-toggle="tab"
                                           href="#opt-in-appearance" role="tab" aria-controls="opt-in-appearance"
                                           aria-selected="true">Opt-In Appearance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="opt-in-settings-tab" data-toggle="tab"
                                           href="#opt-in-settings" role="tab" aria-controls="opt-in-settings"
                                           aria-selected="true">Opt-In Settings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="pro-features-tab" data-toggle="tab"
                                           href="#pro-features" role="tab" aria-controls="pro-features"
                                           aria-selected="true">Pro Features</a>
                                    </li>
                                </ul>
                                {{--                                <button class="btn btn-icon btn-3 btn-secondary" type="button">--}}
                                {{--                                    <span class="btn-inner--text">Pro Features</span>--}}
                                {{--                                </button>--}}
                                @php
                                    $url = $isEdit?route('sliders.update',$slider->id):route('sliders.store');
                                @endphp
                                <form method="POST" action="{{$url}}" @submit.prevent="updateSlider()">
                                    @if($isEdit)
                                        @method ('PATCH')
                                        <input name="id" id="slider_id" type="hidden" value="{{$slider->id}}"/>
                                    @endif
                                    {{csrf_field()}}

                                    <div class="tab-content" id="tabContent">
                                        <div class="tab-pane fade show active" id="appearance" role="tabpanel"
                                             aria-labelledby="appearance-tab">
                                            @include('backend.sliders.shared.appearance')
                                        </div>
                                        <div class="tab-pane fade" id="settings" role="tabpanel"
                                             aria-labelledby="settings-tab">
                                            @include('backend.sliders.shared.settings')
                                        </div>
                                        <div class="tab-pane fade" id="countdown" role="tabpanel"
                                             aria-labelledby="countdown-tab">
                                            @include('backend.sliders.shared.settings')
                                        </div>
                                        <div class="tab-pane fade" id="button" role="tabpanel"
                                             aria-labelledby="button-tab">
                                            @include('backend.sliders.shared.settings')
                                        </div>
                                        <div class="tab-pane fade" id="opt-in-appearance" role="tabpanel"
                                             aria-labelledby="opt-in-appearance-tab">
                                            @include('backend.sliders.shared.settings')
                                        </div>
                                        <div class="tab-pane fade" id="opt-in-settings" role="tabpanel"
                                             aria-labelledby="opt-in-settings-tab">
                                            @include('backend.sliders.shared.settings')
                                        </div>
                                        <div class="tab-pane fade" id="pro-features" role="tabpanel"
                                             aria-labelledby="pro-features-tab">
                                            @include('backend.sliders.shared.settings')
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">

                                <button class="btn btn-icon btn-primary" id="save-prev" type="button">
                                    <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
                                    <span class="btn-inner--text">Previous</span>
                                </button>
                                <button class="btn btn-icon btn-primary" id="save-next" type="button">
                                    <span class="btn-inner--icon"><i class="ni ni-bold-right"></i></span>
                                    <span class="btn-inner--text">Next</span>
                                </button>
                                <button class="btn btn-icon btn-primary" id="save-exit" type="button">
                                    <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                                    <span class="btn-inner--text">Save & Exit</span>
                                </button>
                                <a href="{{route('sliders.index')}}" class="btn btn-warning"> Cancel </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @include('backend.sliders.shared.preview')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script type="text/javascript">
        var tabs = ['appearance', 'settings', 'countdown', 'button', 'opt-in-appearance', 'opt-in-settings', 'pro-features'];
        var activeTab = 0;
        var len = tabs.length;

        var target = '';

        function submitForm() {
            $inputData = bar.$data;

            $inputData.html = $('#previewbar').html();

            $inputData.section_type = $('#section_type').val();
            $inputData.slider_id = $('#slider_id').val();
            $inputData.slider_name = $('#slider-name').val();
            $.ajax({
                url: "{{route('sliders.update.ajax')}}",
                method: "POST",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                data: bar.$data,
            }).done(function (response) {

                if ('exit' != target) {
                    return;
                }
                Swal.fire(
                    'Successfully saved',
                    response.message,
                    'success'
                ).then((result) => {
                    nextAction();
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

        $('#save-prev').click(function () {
            var targetTab = (activeTab + (len - 1)) % len;
            $('#' + tabs[targetTab] + '-tab').tab('show');
            activeTab = targetTab;
            // submitForm();
        });
        $('#save-next').click(function () {
            var targetTab = (activeTab + 1) % len;
            $('#' + tabs[targetTab] + '-tab').tab('show');
            activeTab = targetTab;
            // submitForm();
        });
        $('#save-exit').click(function (e) {
            target = 'exit';
            // submitForm();
        });

        function nextAction() {
            if ('exit' == target) {
                window.location.href = "{{route('sliders.index')}}";
            }
        }
    </script>
@endpush
