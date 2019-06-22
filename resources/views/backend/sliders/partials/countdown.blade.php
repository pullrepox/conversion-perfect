<div class="card" id="ticker-card" style="display: none;">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Countdown</h3>
            <div class="col text-right">
                <button type="button" class="btn mr--2 no-shadow-box text-underline hide-card-btn">
                    hide
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="countdownCountdown">Countdown</label>
                    <select class="form-control" v-model="countdown.countdown" id="countdown-countdown">
                        <option value="none">None</option>
                        <option value="fixeddate">Fixed Date</option>
                        <option value="evergreen">Evergreen</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="countdownColor">Countdown Color</label>
                    <input type="text" v-model="countdown.countdown_color"
                           class="form-control color-picker"
                           v-if="countdown.countdown!='none'"
                           id="countdown-color">
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label for="countdownBgcolor">Countdown Background Color</label>
                    <input type="text" v-model="countdown.countdown_bgcolor"
                           v-if="countdown.countdown!='none'"
                           class="form-control color-picker"
                           id="countdown-bgcolor">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="expirationAction">On Expiration</label>
                    <select class="form-control" v-model="countdown.expiration_action" id="expiration-action">
                        <option value="hidebar">Hide Bar</option>
                        <option value="redirect">Redirect</option>
                        <option value="display_text">Display Text</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="expirationRedirectUrl">Expiration Redirect Url</label>
                    <input type="text" v-model="countdown.expiration_redirect_url"
                           class="form-control"
                           :disabled=countdown.expiration_action!='redirect'
                           id="expiration-redirect-url">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="expirationText">Expiration Text</label>
                    <input type="text" v-model="countdown.expiration_text"
                           class="form-control"
                           :disabled=countdown.expiration_action!='display_text'
                           id="expiration-text">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="evergreenDays">Countdown Days</label>
                    <input type="number" v-model="countdown.evergreen_days"
                           :disabled=countdown.countdown!='evergreen'
                           class="form-control"
                           id="evergreen-days">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="evergreenHours">Countdown Hour</label>
                    <input type="number" v-model="countdown.evergreen_hours"
                           :disabled=countdown.countdown!='evergreen'
                           class="form-control"
                           id="evergreen-hours">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="evergreenMinutes">Countdown Minutes</label>
                    <input type="number" v-model="countdown.evergreen_minutes"
                           :disabled=countdown.countdown!='evergreen'
                           class="form-control"
                           id="evergreen-minutes">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fixedDateTime">Fixed DateTime</label>
                    <input class="form-control"
                           type="datetime-local"
                           value="2018-11-23T10:30"
                           id="fixed-data-time"
                           :disabled=countdown.countdown!='fixeddate'
                           v-model="countdown.fixed_date_time"
                           >
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="fixedTimeZone">TimeZone</label>
                    <?php
                    $timezones = \App\Models\Utils::timeZones();
                    ?>
                    <select class="form-control select2-height-fix"
                            v-model="countdown.fixed_time_zone"
                            :disabled=countdown.countdown!='fixeddate'
                            id="fixed-time-zone" data-toggle="select">
                        @foreach($timezones as $key=>$timezone)
                            <option name="{{$key}}">{{$timezone}}</option>
                        @endforeach

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


        $('#countdown-color').on('colorpickerChange', function (event) {
            slider.countdown.countdown_color = event.color.toString();
        });

        $('#countdown-bgcolor').on('colorpickerChange', function (event) {
            slider.countdown.countdown_bgcolor = event.color.toString();
        });
    });
</script>
@endsection
