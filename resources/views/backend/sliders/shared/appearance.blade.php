<div class="card" id="appearance-card" style="display: none;">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Appearance</h3>
            <div class="col text-right">
                <button type="button" class="btn mr--2 no-shadow-box text-underline hide-card-btn">
                    hide
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input v-model="appearance.heading" type="text" name="heading" class="form-control" id="heading">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subHeading">Sub Heading</label>
                            <input type="text" v-model="appearance.subheading" name="subheading" class="form-control"
                                   id="subheading">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="headingColor">Heading Color</label>
                            <input type="text" v-model="appearance.heading_color" class="form-control color-picker" id="heading-color">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subHeadingColor">Sub Heading Color</label>
                            <input type="text" v-model="appearance.subheading_color" class="form-control color-picker" id="sub-heading-color">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dropShadow">Background Gradient</label>
                        <div class="form-group">
                            <label class="custom-toggle mt-2">
                                <input v-model="appearance.bg_gradient" type="checkbox">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Background Color Start</label>
                            <input v-model="appearance.bg_color_start" type="text"
                                   class="form-control color-picker"
                                   id="bg-color-start">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Background Color End</label>
                            <input type="text" v-model="appearance.bg_color_end" value="#ffffff"
                                   :disabled=isGradDisabled
                                   class="form-control color-picker"
                                   id="bg-color-end" >
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Background Gradient Angle</label>
                            <input type="number" v-model="appearance.bg_gradient_angle" :disabled=isGradDisabled
                                   class="form-control"
                                   id="sub-color">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Opacity (@{{ appearance.opacity }})</label>
                            <input v-model="appearance.opacity" type="range" class="custom-range"
                                   min="0" max="1" step="0.1" id="customRange3">
                            <div class="d-flex justify-content-between bd-highlight mb-3">
                                <div class="p-2 bd-highlight">0</div>
                                <div class="p-2 bd-highlight">1</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Video Code</label>
                            <input type="text" v-model="appearance.video_code" class="form-control"
                                   id="video-code" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="dropShadow">Drop Shadow</label>
                        <div class="form-group">
                            <label class="custom-toggle mt-2">
                                <input v-model="appearance.drop_shadow" type="checkbox">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Video Autoplay</label>
                            <div class="form-group">
                                <label class="custom-toggle mt-2">
                                    <input v-model="appearance.video_auto_play" type="checkbox">
                                    <span class="custom-toggle-slider rounded-circle"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="subColor">Description</label>
                            <div data-toggle="quill"
                                 class="quilleditor"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
        <script>
            $(function () {
                // Basic instantiation:
                $('#heading-color').on('colorpickerChange', function (event) {
                    slider.appearance.heading_color = event.color.toString();
                });
                $('#sub-heading-color').on('colorpickerChange', function (event) {
                    slider.appearance.subheading_color = event.color.toString();
                });
                $('#bg-color-start').on('colorpickerChange', function (event) {
                    slider.appearance.bg_color_start = event.color.toString();
                });
                $('#bg-color-end').on('colorpickerChange', function (event) {
                    slider.appearance.bg_color_end = event.color.toString();
                });

                var editor = new Quill('.quilleditor', {
                    placeholder: 'Description goes here',
                });

                editor.on('text-change', function (delta, oldDelta, source) {
                    if (source == 'user') {
                        slider.appearance.description = editor.getText();
                    }
                });
                @if($isEdit)
                editor.setText("{{$slider->appearance['description']}}");
                        @endif
            });
        </script>
@endsection
