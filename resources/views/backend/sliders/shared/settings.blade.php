<div class="row mt-3" id="settings">
    <div class="col">
        <input name="type" id="section_type" type="hidden" value="settings"/>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="position">Position</label>
                    <select class="form-control" v-model="position" id="position">
                        <option value="top">Top</option>
                        <option value="bottom">Bottom</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label for="isSticky">Sticky</label>
                <div class="form-group">
                    <label class="custom-toggle mt-2">
                        <input v-model="is_sticky" type="checkbox" id="is-sticky">
                        <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <label for="pushcontentdown">Push content Down</label>
                <div class="form-group">
                    <label class="custom-toggle mt-2">
                        <input v-model="push_content_down" type="checkbox" id="pushcontentdown">
                        <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <label for="showCloseBtn">Show Close Button</label>
                <div class="form-group">
                    <label class="custom-toggle mt-2">
                        <input v-model="show_close_btn" type="checkbox" id="show-close-btn">
                        <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="trigger">Trigger</label>
                    <select class="form-control" v-model="trigger" id="trigger">
                        <option value="instant">Instant</option>
                        <option value="xseconds">After Delay</option>
                        <option value="xscroll">After Scroll</option>
                        <option value="onexit">On Exit</option>
                    </select>
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label for="delaySeconds">Seconds Delay</label>
                    <input type="number" v-model="delay_seconds"
                           :disabled=trigger!='xseconds'
                           class="form-control"
                           id="delay-seconds" placeholder="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="delayScroll">Scroll Delay</label>
                    <input type="number"
                           v-model="delay_scroll"
                           :disabled=trigger!='xscroll'
                           class="form-control"
                           id="delay-scroll" placeholder="">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="frequency">Frequency</label>
                    <select class="form-control" v-model="frequency" id="frequency">
                        <option value="visit">Every Visit</option>
                        <option value="daily">Once per day</option>
                        <option value="weekly">Once per week</option>
                        <option value="once">Once</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var settings = new Vue({
            el: '#settings',
            data: {
                position: '',
                is_sticky: '',
                push_content_down: '',
                trigger: '',
                delay_seconds: '',
                delay_scroll: '',
                frequency: '',
                show_close_btn: '',
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
            $settings = $slider->settings;
            ?>

            {{--    settings.position = "{{getArrayValue($settings,'position','')}}";--}}
            {{--settings.is_sticky = "{{getArrayValue($settings,'is_sticky','')}}";--}}
            {{--settings.push_content_down = "{{getArrayValue($settings,'push_content_down','')}}";--}}
            {{--settings.trigger = "{{getArrayValue($settings,'trigger','')}}";--}}
            {{--settings.delay_seconds = "{{getArrayValue($settings,'delay_seconds','')}}";--}}
            {{--settings.delay_scroll = "{{getArrayValue($settings,'bg_color_enddelay_scroll,delay_scroll')}}";--}}
            {{--settings.frequency = {{getArrayValue($settings,'frequency',false)}};--}}
            {{--settings.show_close_btn = "{{getArrayValue($settings,'show_close_btn','')}}";--}}
        @endif
    </script>
@endpush
