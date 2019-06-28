<div class="card mt--3" v-show="bar_option.countdown">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Countdown</h3>
            <div class="col text-right">
                <button v-if="show_btn.countdown" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="saveOption('countdown')">
                    Save
                </button>
                <button v-if="!show_btn.content" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="toggleOption('countdown')">
                    Hide
                </button>
                <button type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal" @click="clearOptionConfirm('countdown')">
                    Clear
                </button>
                <input type="hidden" name="opt_countdown" v-model="bar_option.countdown"/>
            </div>
        </div>
    </div>
    <div class="card-body pb-0 pt-2">
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="countdown">Countdown</label>
                    <select class="form-control" data-toggle="select" id="countdown" name="countdown" required
                            @keydown="tabKeyPress('#button_location', true, $event)" @keypress="tabKeyPress('#button_location', true, $event)"
                            v-model="model.countdown.countdown" data-parent="button">
                        <option value="none">None</option>
                        <option value="square">Square</option>
                        <option value="rounded">Rounded</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
