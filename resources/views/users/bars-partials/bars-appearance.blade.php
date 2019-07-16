<div class="tab-pane fade" :class="{'show': model.sel_tab === 'appearance', 'active': model.sel_tab === 'appearance'}" id="tabs-appearance" role="tabpanel"
     aria-labelledby="tabs-appearance-tab">
    <div class="tabs-appearance tabs-data-entry">
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="drop_shadow">Show Drop Shadow</label>
                    <div class="radio ml-1">
                        <label class="custom-toggle custom-toggle-light">
                            <input type="checkbox" id="drop_shadow" name="drop_shadow"
                                   @keydown="tabKeyPress('#close_button', false, $event)" @keypress="tabKeyPress('#close_button', false, $event)"
                                   data-parent="appearance" v-model="model.appearance.drop_shadow" @input="changeStatusVal">
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
                                   data-parent="appearance" v-model="model.appearance.close_button" @input="changeStatusVal">
                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="opacity">Opacity</label>
                    <div class="form-row">
                        <div class="col-md-10 col-sm-9 pl-3">
                            <vue-slider :speed="1" :min="0" :max="100" v-model="model.appearance.opacity" id="opacity" @change="changeStatusVal"></vue-slider>
                        </div>
                        <div class="col-md-2 col-sm-3 mt--1">@{{ model.appearance.opacity }}%</div>
                        <input type="hidden" name="opacity" v-model="model.appearance.opacity"/>
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
                                   data-parent="appearance" v-model="model.appearance.background_gradient" @input="changeStatusVal">
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
                    <div class="form-row">
                        <div class="col-md-10 col-sm-9 pl-3">
                            <vue-slider :speed="1" :min="0" :max="360" v-model="model.appearance.gradient_angle" id="gradient_angle" @change="changeStatusVal"></vue-slider>
                        </div>
                        <div class="col-md-2 col-sm-3 mt--1">@{{ model.appearance.gradient_angle }}&deg;</div>
                        <input type="hidden" name="gradient_angle" v-model="model.appearance.gradient_angle"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="powered_by_position">Powered By Location</label>
                    <select class="form-control" data-toggle="select" id="powered_by_position" name="powered_by_position"
                            v-model="model.appearance.powered_by_position" data-parent="appearance">
                        <option value="bottom_right">Bottom Right</option>
                        <option value="bottom_left">Bottom Left</option>
                        <option value="top_left">Top Left</option>
                        @if (!is_null(auth()->user()->permissions))
                            @if (auth()->user()->permissions['remove-powered-by'])
                                <option value="hidden">Hidden</option>
                            @endif
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
