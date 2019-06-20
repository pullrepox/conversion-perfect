<div class="row mt-3" id="button">
    <div class="col">
        <input name="type" id="section_type" type="hidden" value="settings"/>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="buttonType">Button Type</label>
                    <select class="form-control" v-model="button_type" id="button-type">
                        <option value="square">Square</option>
                        <option value="rounded">Rounded</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="buttonTextColor">Button Text Color</label>
                    <input type="text" v-model="button_text_color"
                           class="form-control color-picker"
                           id="button-text-color">
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label for="buttonBgcolor">Button Background Color</label>
                    <input type="text" v-model="button_bgcolor"
                           class="form-control color-picker"
                           id="button-bgcolor">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="buttonText">Button Text</label>
                    <input type="text" v-model="button_text"
                           class="form-control"
                           id="button-text">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="buttonLink">Button Link</label>
                    <input type="text" v-model="button_link"
                               class="form-control"
                               id="button-link">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="buttonTarget">Button Target</label>
                    <input type="text" v-model="button_target"
                               class="form-control"
                               id="button-target">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="buttonAnimation">Button Animation</label>
                    <select class="form-control" v-model="button_animation" id="button-animation">
                        <option value="none">None</option>
                        <option value="small_shake">Small Shake</option>
                        <option value="medium_shake">Medium Shake</option>
                        <option value="large_shake">Large Shake</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent

    <script>
        $(function () {
            $('#button-bgcolor').on('colorpickerChange', function (event) {
                button.button_bgcolor = event.color.toString();
            });
            $('#button-text-color').on('colorpickerChange', function (event) {
                button.button_text_color = event.color.toString();
            });
        });
        var button = new Vue({
            el: '#button',
            data: {
                button_type:'',
                button_text_color:'#fafafa',
                button_bgcolor:'#afafaf',
                button_text:'',
                button_link:'',
                button_target:'',
                button_animation:'',
                evergreen_hours:'',
                evergreen_minutes:'',
                fixed_date_time:'',
                fixed_time_zone:''
            },
            computed: {
                isGradDisabled() {
                    return true;
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
            $button = $slider->button;
            ?>

            button.button_type = "{{getArrayValue($button,'button_type','')}}";
            button.button_text_color = "{{getArrayValue($button,'button_text_color','')}}";
            button.button_bgcolor = "{{getArrayValue($button,'button_bgcolor','')}}";
            button.button_text = "{{getArrayValue($button,'button_text','')}}";
            button.button_link = "{{getArrayValue($button,'button_link','')}}";
            button.button_target = "{{getArrayValue($button,'button_target','')}}";
            button.button_animation = "{{getArrayValue($button,'button_animation',false)}}";
        @endif
    </script>
@endsection
