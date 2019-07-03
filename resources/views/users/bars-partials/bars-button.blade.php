<div class="card mt--3" v-show="bar_option.button">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Button</h3>
            <div class="col text-right">
                <button v-if="show_btn.button" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="saveOption('button')">
                    Save
                </button>
                <button v-if="!show_btn.button" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="toggleOption('button')">
                    Hide
                </button>
                <button type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal" @click="clearOptionConfirm('button')">
                    Clear
                </button>
                <input type="hidden" name="opt_button" v-model="bar_option.button"/>
            </div>
        </div>
    </div>
    <div class="card-body pb-0 pt-2">
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="button_type">Button</label>
                    <select class="form-control" data-toggle="select" id="button_type" name="button_type"
                            @keydown="tabKeyPress('#button_location', true, $event)" @keypress="tabKeyPress('#button_location', true, $event)"
                            v-model="model.button.button_type" data-parent="button">
                        <option value="none">None</option>
                        <option value="square">Square</option>
                        <option value="rounded">Rounded</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4" v-show="model.button.button_type !== 'none'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="button_location">Button Location</label>
                    <select class="form-control" data-toggle="select" id="button_location" name="button_location"
                            @keydown="tabKeyPress('#button_label', false, $event)" @keypress="tabKeyPress('#button_label', false, $event)"
                            v-model="model.button.button_location" data-parent="button">
                        <option value="right">Right</option>
                        <option value="left">Left</option>
                        <option value="below_text">Below Text</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4" v-show="model.button.button_type !== 'none'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="button_label">Button Text</label>
                    <input type="text" id="button_label" name="button_label" data-parent="button" class="form-control @error('button_label') is-invalid @enderror"
                           v-model="model.button.button_label" @input="validationCheck('button_label', 'button')"/>
                    @error('button_label')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row" v-show="model.button.button_type !== 'none'">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="button_background_color">Background Color</label>
                    <input class="jscolor form-control" name="button_background_color" id="button_background_color" v-model="model.button.button_background_color"
                           @change="updateJSColor('button_background_color', 'button')"
                           @keydown="tabKeyPress('#button_text_color', false, $event)" @keypress="tabKeyPress('#button_text_color', false, $event)"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="button_text_color">Text Color</label>
                    <input class="jscolor form-control" name="button_text_color" id="button_text_color" v-model="model.button.button_text_color"
                           @change="updateJSColor('button_text_color', 'button')"
                           @keydown="tabKeyPress('#button_animation', true, $event)" @keypress="tabKeyPress('#button_animation', true, $event)"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="button_animation">Shake</label>
                    <select class="form-control" data-toggle="select" id="button_animation" name="button_animation"
                            @keydown="tabKeyPress('#button_action', true, $event)" @keypress="tabKeyPress('#button_action', true, $event)"
                            v-model="model.button.button_animation" data-parent="button">
                        <option value="none">None</option>
                        <option value="on_load">On Load</option>
                        <option value="on_hover">On Hover</option>
                        <option value="on_load_on_hover">On Load and On Hover</option>
                        <option value="repeat_6_seconds">Repeat Every 6 Seconds</option>
                        <option value="repeat_6_seconds_on_hover">Repeat Every 6 Seconds and On Hover</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row" v-show="model.button.button_type !== 'none'">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="button_action">Action</label>
                    <select class="form-control" data-toggle="select" id="button_action" name="button_action"
                            @keydown="tabKeyPress('#button_click_url', false, $event)" @keypress="tabKeyPress('#button_click_url', false, $event)"
                            v-model="model.button.button_action" data-parent="button">
                        <option value="hide_bar">Hide Bar</option>
                        <option value="open_click_url">Open Click URL</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4" v-show="model.button.button_action === 'open_click_url'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="button_click_url">Click URL</label>
                    <input type="text" id="button_click_url" name="button_click_url" data-parent="button" class="form-control @error('button_click_url') is-invalid @enderror"
                           v-model="model.button.button_click_url" @input="showSaveBtn('button')"/>
                    @error('button_click_url')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4" v-show="model.button.button_action === 'open_click_url'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="button_open_new">Open In New Window</label>
                    <div class="radio ml-1">
                        <label class="custom-toggle custom-toggle-light">
                            <input type="checkbox" id="button_open_new" name="button_open_new"
                                   data-parent="button" v-model="model.button.button_open_new" @input="showSaveBtn('button')">
                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
