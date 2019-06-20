<div class="row mt-3" id="countdown">
    <div class="col">
        <input name="type" id="section_type" type="hidden" value="settings"/>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="countdown">Countdown</label>
                    <select class="form-control" v-model="countdown" id="countdown">
                        <option value="none">None</option>
                        <option value="fixeddate">Fixed Date</option>
                        <option value="evergreen">Evergreen</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="countdownColor">Countdown Color</label>
                    <input type="text" v-model="countdown_color" class="form-control color-picker" id="countdown-color">
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label for="countdownBgcolor">Countdown Background Color</label>
                    <input type="text" v-model="countdown_bgcolor" value="#ffffff"
                           class="form-control color-picker"
                           id="countdown-bgcolor">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="expirationAction">On Expiration</label>
                    <select class="form-control" v-model="expiration_action" id="expiration-action">
                        <option value="hidebar">Hide Bar</option>
                        <option value="redirect">Redirect</option>
                        <option value="display_text">Display Text</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="expirationRedirectUrl">Expiration Redirect Url</label>
                    <input type="text" v-model="expiration_redirect_url"
                               class="form-control" :disable=expiration_action!='redirect'
                               id="expiration-redirect-url" placeholder="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="expirationText">Expiration Text</label>
                    <input type="text" v-model="expiration_text"
                               class="form-control"
                                :disabled=expiration_action!='display_text'
                               id="expiration-text" placeholder="">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="evergreenDays">Countdown Days</label>
                    <input type="number" v-model="evergreen_days"
                           :disabled=countdown!='evergreen'
                           class="form-control"
                           id="evergreen-days" placeholder="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="evergreenHours">Countdown Hour</label>
                    <input type="number" v-model="evergreen_hours"
                           :disabled=countdown!='evergreen'
                           class="form-control"
                           id="evergreen-hours" placeholder="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="evergreenMinutes">Countdown Minutes</label>
                    <input type="number" v-model="evergreen_minutes"
                           :disabled=countdown!='evergreen'
                           class="form-control"
                           id="evergreen-minutes" placeholder="">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                    <div class="form-group">
                        <label for="fixedDateTime">Fixed DateTime</label>
                        <input class="form-control datepicker"
                               placeholder="Select date"
                               type="text"
                               id="fixed-data-time"
                               v-model="fixed_date_time"
                               value="06/20/2018">
                    </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fixedTimeZone">TimeZone</label>
                    <?php
                    $timezones = \App\Models\Utils::timeZones();
                    ?>
                    <form>
                    <select class="form-control select2-height-fix"
                            v-model="fixed_time_zone"
                            id="fixed-time-zone" data-toggle="select">
                        @foreach($timezones as $key=>$timezone)
                            <option name="{{$key}}">{{$timezone}}</option>
                        @endforeach

                    </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(function () {
            $('#countdown-color').on('colorpickerChange', function (event) {
                countdown.countdown_color = event.color.toString();
            });

            $('#countdown-bgcolor').on('colorpickerChange', function (event) {
                countdown.countdown_bgcolor = event.color.toString();
            });
        });

        var countdown = new Vue({
            el: '#countdown',
            data: {
                countdown:'',
                countdown_color:'#fafafa',
                countdown_bgcolor:'#afafaf',
                expiration_action:'',
                expiration_redirect_url:'',
                expiration_text:'',
                evergreen_days:'',
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
            $countdown = $slider->countdown;
            ?>

            countdown.countdown = "{{getArrayValue($countdown,'countdown','')}}";
            countdown.countdown_color = "{{getArrayValue($countdown,'countdown_color','')}}";
            countdown.countdown_bgcolor = "{{getArrayValue($countdown,'countdown_bgcolor','')}}";
            countdown.expiration_action = "{{getArrayValue($countdown,'expiration_action','')}}";
            countdown.expiration_redirect_url = "{{getArrayValue($countdown,'expiration_redirect_url','')}}";
            countdown.expiration_text = "{{getArrayValue($countdown,'expiration_text','')}}";
            countdown.evergreen_days = "{{getArrayValue($countdown,'evergreen_days',false)}}";
            countdown.evergreen_hours = "{{getArrayValue($countdown,'evergreen_hours','')}}";
            countdown.evergreen_minutes = "{{getArrayValue($countdown,'evergreen_minutes','')}}";
            countdown.fixed_date_time = "{{getArrayValue($countdown,'fixed_date_time','')}}";
            countdown.fixed_time_zone = "{{getArrayValue($countdown,'fixed_time_zone','')}}";
        @endif
    </script>
@endsection
