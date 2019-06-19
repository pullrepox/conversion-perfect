@push('styles')
    <link rel="stylesheet" href="{{asset('/css/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/vendor/quill/dist/quill.core.css')}}"/>
@endpush
<div class="row mt-3">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Appearance
            </div>
            <input name="type" id="section_type" type="hidden" value="appearance"/>
            @if($isEdit)
                <input name="id" id="slider_id" type="hidden" value="{{$slider->id}}"/>
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="sliderName">Slider Name</label>
                            <input type="text" class="form-control"
                                   value="{{$isEdit?$slider->name:''}}" id="slider-name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input v-model="heading" type="text" name="heading" class="form-control" id="heading">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subHeading">Sub Heading</label>
                            <input type="text" v-model="subheading" name="subheading" class="form-control"
                                   id="subheading">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="headingColor">Heading Color</label>
                            <input type="text" v-model="heading_color" class="form-control" id="heading-color">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subHeadingColor">Sub Heading Color</label>
                            <input type="text" v-model="subheading_color" class="form-control" id="sub-heading-color">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="dropShadow">Background Gradient</label>
                        <div class="form-group">
                            <label class="custom-toggle mt-2">
                                <input v-model="bg_gradient" type="checkbox">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Background Color Start</label>
                            <input v-model="bg_color_start" type="text" class="form-control" id="bg-color-start">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Background Color End</label>
                            <input type="text" v-model="bg_color_end" value="#ffffff" :disabled=isGradDisabled
                                   class="form-control"
                                   id="bg-color-end" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Background Gradient Angle</label>
                            <input type="number" v-model="bg_gradient_angle" :disabled=isGradDisabled
                                   class="form-control"
                                   id="sub-color" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Opacity (@{{ opacity }})</label>
                            <input v-model="opacity" type="range" class="custom-range"
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
                            <input type="text" v-model="video_code" class="form-control"
                                   id="video-code" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="dropShadow">Drop Shadow</label>
                        <div class="form-group">
                            <label class="custom-toggle mt-2">
                                <input v-model="drop_shadow" type="checkbox">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Video Autoplay</label>
                            <div class="form-group">
                                <label class="custom-toggle mt-2">
                                    <input v-model="video_auto_play" type="checkbox" >
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
            <div class="card-footer">
                <input type="submit" id="save-prev" class="btn btn-outline-default" value="Previous"/>
                <input type="submit" id="save-next" class="btn btn-outline-default" value="Next"/>
                <input type="submit" id="save-exit" class="btn btn-primary" value="Save & Exit"/>
                <a href="{{route('sliders.index')}}" class="btn btn-warning"> Cancel </a>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script src="{{asset('/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('/assets/vendor/quill/dist/quill.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script>
        $(function () {
            // Basic instantiation:
            $('#heading-color').colorpicker();
            $('#sub-heading-color').colorpicker();
            $('#bar-color').colorpicker();
            $('#bg-color-start').colorpicker();
            $('#bg-color-end').colorpicker();

            $('#heading-color').on('colorpickerChange', function (event) {
                bar.heading_color = event.color.toString();
            });

            $('#sub-heading-color').on('colorpickerChange', function (event) {
                bar.subheading_color = event.color.toString();
            });

            $('#bg-color-start').on('colorpickerChange', function (event) {
                bar.bg_color_start = event.color.toString();
            });

            $('#bg-color-end').on('colorpickerChange', function (event) {
                bar.bg_color_end = event.color.toString();
            });


            var editor = new Quill('.quilleditor',{
                placeholder:'Description goes here',
            });

            editor.on('text-change', function (delta, oldDelta, source) {
                if (source == 'user') {
                    bar.description = editor.getText();
                }
            });
            @if($isEdit)
            editor.setText("{{$slider->appearance['description']}}");
            @endif

            var target='';
            $('#save-prev').click(function(e){
                target='prev';
                submitForm();
            });
            $('#save-next').click(function(e){
                target='next';
                submitForm();
            });
            $('#save-exit').click(function(e){
                target='exit';
                submitForm();
            });

            function nextAction(){
                if('exit' == target){
                    window.location.href = "{{route('sliders.index')}}";
                }
            }

            function submitForm(){
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

                    if('exit' != target){
                        return;
                    }
                    Swal.fire(
                        'Successfully saved',
                        response.message,
                        'success'
                    ).then((result)=>{
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
        });
    </script>
    <script>
        var bar = new Vue({
            el: '#slider',
            data: {
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
            },
            computed: {
                isGradDisabled() {
                    return !this.bg_gradient;
                }
            },
            methods: {
                updateSlider: () => {
                    console.log(this.data);
                }
            },
        });
        @if($isEdit)
        <?php
        $appearance = $slider->appearance;
        ?>

            bar.heading = "{{getArrayValue($appearance,'heading','')}}";
        bar.subheading = "{{getArrayValue($appearance,'subheading','')}}";
        bar.description = "{{getArrayValue($appearance,'description','')}}";
        bar.heading_color = "{{getArrayValue($appearance,'heading_color','')}}";
        bar.subheading_color = "{{getArrayValue($appearance,'subheading_color','')}}";
        bar.bg_color_start = "{{getArrayValue($appearance,'bg_color_start','')}}";
        bar.bg_color_end = "{{getArrayValue($appearance,'bg_color_end','')}}";
        bar.bg_gradient = {{getArrayValue($appearance,'bg_gradient',false)}};
        bar.bg_gradient_angle = "{{getArrayValue($appearance,'bg_gradient_angle','')}}";
        bar.opacity = "{{getArrayValue($appearance,'opacity','')}}";
        bar.drop_shadow = {{getArrayValue($appearance,'drop_shadow',false)}};
        bar.video_code = "{!! getArrayValue($appearance,'video_code','')  !!}";
        bar.video_auto_play = {{getArrayValue($appearance,'video_auto_play',false)}};
        @endif
    </script>
@endpush
