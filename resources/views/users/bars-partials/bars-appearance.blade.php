<div class="card mt--3" v-show="bar_option.appearance">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Appearance</h3>
            <div class="col text-right">
                <button v-if="show_btn.appearance" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="saveOption('appearance')">
                    Save
                </button>
                <button v-if="!show_btn.appearance" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="toggleOption('appearance')">
                    Hide
                </button>
                <button type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal" @click="clearOptionConfirm('appearance')">
                    Clear
                </button>
                <input type="hidden" name="opt_appearance" v-model="bar_option.appearance"/>
            </div>
        </div>
    </div>
    <div class="card-body pb-0 pt-2">
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="drop_shadow">Show Drop Shadow</label>
                    <div class="radio ml-1">
                        <label class="custom-toggle custom-toggle-light">
                            <input type="checkbox" id="drop_shadow" name="drop_shadow"
                                   @keydown="tabKeyPress('#close_button', false, $event)" @keypress="tabKeyPress('#close_button', false, $event)"
                                   data-parent="appearance" v-model="model.appearance.drop_shadow" @input="showSaveBtn('appearance')">
                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="close_button">Hide Close Button</label>
                    <div class="radio ml-1">
                        <label class="custom-toggle custom-toggle-light">
                            <input type="checkbox" id="close_button" name="close_button"
                                   @keydown="tabKeyPress('#background_gradient', false, $event)" @keypress="tabKeyPress('#background_gradient', false, $event)"
                                   data-parent="appearance" v-model="model.appearance.close_button" @input="showSaveBtn('appearance')">
                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="opacity">Opacity</label>
                    <div class="row">
                        <div class="col-md-10 col-sm-9">
                            <vue-slider :speed="1" :min="0" :max="100" v-model="model.appearance.opacity" id="opacity" @change="showSaveBtn('appearance')"></vue-slider>
                        </div>
                        <div class="col-md-2 col-sm-3 pl-0 mt--1">@{{ model.appearance.opacity }}%</div>
                        <input type="hidden" name="opacity" v-model="model.appearance.opacity"/>
                        @error('opacity')
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="background_gradient">Gradient</label>
                    <div class="radio ml-1">
                        <label class="custom-toggle custom-toggle-light">
                            <input type="checkbox" id="background_gradient" name="background_gradient"
                                   @keydown="tabKeyPress('#gradient_end_color', false, $event)" @keypress="tabKeyPress('#gradient_end_color', false, $event)"
                                   data-parent="appearance" v-model="model.appearance.background_gradient" @input="showSaveBtn('appearance')">
                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4" v-show="model.appearance.background_gradient">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="gradient_end_color">Gradient End Color</label>
                    <input class="jscolor form-control" name="gradient_end_color" id="gradient_end_color" v-model="model.appearance.gradient_end_color"
                           @keydown="tabKeyPress('#gradient_angle', false, $event)" @keypress="tabKeyPress('#gradient_angle', false, $event)"
                           @change="updateJSColor('gradient_end_color', 'appearance')"/>
                </div>
            </div>
            <div class="col-md-4" v-show="model.appearance.background_gradient">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="gradient_angle">Gradient Angle</label>
                    <div class="row">
                        <div class="col-md-10 col-sm-9">
                            <vue-slider :speed="1" :min="0" :max="360" v-model="model.appearance.gradient_angle" id="gradient_angle" @change="showSaveBtn('appearance')"></vue-slider>
                        </div>
                        <div class="col-md-2 col-sm-3 pl-0 mt--1">@{{ model.appearance.gradient_angle }}&deg;</div>
                        <input type="hidden" name="gradient_angle" v-model="model.appearance.gradient_angle"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="powered_by_position">Powered By Location</label>
                    <select class="form-control" data-toggle="select" id="powered_by_position" name="powered_by_position" required
                            v-model="model.appearance.powered_by_position" data-parent="appearance">
                        <option value="bottom_right">Bottom Right</option>
                        <option value="bottom_left">Bottom Left</option>
                        <option value="top_left">Top Left</option>
                        <option value="hidden">Hidden</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
