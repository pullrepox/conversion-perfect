<div class="card mt--3" v-show="bar_option.display">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Display</h3>
            <div class="col text-right">
                <button v-if="show_btn.display" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="saveOption('display')">
                    Save
                </button>
                <button v-if="!show_btn.display" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="toggleOption('display')">
                    Hide
                </button>
                <button type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal" @click="clearOptionConfirm('display')">
                    Clear
                </button>
                <input type="hidden" name="opt_display" v-model="bar_option.display"/>
            </div>
        </div>
    </div>
    <div class="card-body pb-0 pt-2">
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="show_bar_type">Show Bar</label>
                    <select class="form-control" data-toggle="select" id="show_bar_type" name="show_bar_type" required
                            v-model="model.display.show_bar_type" data-parent="display">
                        <option value="immediate">Immediate</option>
                        <option value="delay">Delay</option>
                        <option value="scroll">Scroll Point</option>
                        <option value="exit">Smart Exit Intent</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4" v-if="model.display.show_bar_type === 'delay'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="delay_in_seconds">Delay in Seconds</label>
                    <input type="number" class="form-control" id="delay_in_seconds" name="delay_in_seconds" v-model="model.display.delay_in_seconds" @input="showSaveBtn('display')"/>
                </div>
            </div>
            <div class="col-md-4" v-if="model.display.show_bar_type === 'scroll'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="scroll_point_percent">Scroll Point Percent</label>
                    <input type="number" class="form-control" id="scroll_point_percent" name="scroll_point_percent"
                           v-model="model.display.scroll_point_percent" @input="showSaveBtn('display')"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="frequency">Frequency</label>
                    <select class="form-control" data-toggle="select" id="frequency" name="frequency" required
                            v-model="model.display.frequency" data-parent="display">
                        <option value="every">Every Visit</option>
                        <option value="day">Once a Day</option>
                        <option value="week">Once a Week</option>
                        <option value="once">Once</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
