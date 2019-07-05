<div class="tab-pane fade" :class="{'show': sel_tab === 'main', 'active': sel_tab === 'main'}" id="tabs-main" role="tabpanel" aria-labelledby="tabs-main-tab">
    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="friendly_name" data-id="friendly_name">
                    Friendly Name
                </label>
                <input type="text" class="form-control @error('friendly_name') is-invalid @enderror" id="friendly_name" name="friendly_name"
                       v-model="model.friendly_name"
                       @keydown="tabKeyPress('#position', true, $event)" @keypress="tabKeyPress('#position', true, $event)"
                       placeholder="Friendly Name" required autocomplete="friendly_name" @input="changeStatusVal"/>
                @if ($errors->has('friendly_name'))
                    @error('friendly_name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                @else
                    <span class="invalid-feedback" role="alert">
                        Please insert correct value.
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="position">
                    Position
                </label>
                <select class="form-control @error('position') is-invalid @enderror" data-toggle="select" id="position" name="position" required
                        @keydown="tabKeyPress('#group_id', true, $event)" @keypress="tabKeyPress('#group_id', true, $event)"
                        v-model="model.position">
                    <option value="top_sticky">Top Sticky</option>
                    <option value="top">Top</option>
                    <option value="bottom">Bottom</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="group_id">
                    Group
                </label>
                <div class="input-group plus-group">
                    <select class="form-control @error('group_id') is-invalid @enderror" data-toggle="select" id="group_id" name="group_id" required
                            @keydown="tabKeyPress('#headline', false, $event)" @keypress="tabKeyPress('#headline', false, $event)"
                            v-model="model.group_id">
                        <option v-for="(g_item, g_i) in model.group_list" :key="`group_list_${g_i}`" :value="g_item.id">@{{ g_item.name }}</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-success bg-cp" type="button" data-toggle="modal" data-target="#group-add-modal"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="headline">
                    Headline Text
                </label>
                <div class="w-100 ql-editor-parent">
                    <div id="headline" data-toggle="quill" data-quill-placeholder="Headline Here."></div>
                    <input type="hidden" v-for="(h_l, h_i) in model.headline" :key="`hLine_${h_i}`" name="headline[]" :value="h_l.insert" v-if="h_l.insert.trim() != ''"/>
                </div>
                <span v-for="(h_l, h_i) in model.headline" :key="`hLine_attr_${h_i}`" v-if="h_l.insert.trim() != ''">
                        <span v-if="h_l.attributes">
                            <input type="hidden" name="headline_bold[]" :value="h_l.attributes.bold ? true : ''"/>
                            <input type="hidden" name="headline_italic[]" :value="h_l.attributes.italic ? true : ''"/>
                            <input type="hidden" name="headline_underline[]" :value="h_l.attributes.underline ? true : ''"/>
                            <input type="hidden" name="headline_strike[]" :value="h_l.attributes.strike ? true : ''"/>
                        </span>
                    <span v-else>
                            <input type="hidden" name="headline_bold[]" value=""/>
                            <input type="hidden" name="headline_italic[]" value=""/>
                            <input type="hidden" name="headline_underline[]" value=""/>
                            <input type="hidden" name="headline_strike[]" value=""/>
                        </span>
                    </span>
                @error('headline')
                <span class="invalid-feedback" style="display: block;" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="headline_color">
                    Headline Color
                </label>
                <input class="jscolor form-control" name="headline_color"
                       id="headline_color" v-model="model.headline_color" @change="updateJSColor('headline_color', false)"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="background_color">
                    Background Color
                </label>
                <input class="jscolor form-control" name="background_color"
                       id="background_color" v-model="model.background_color" @change="updateJSColor('background_color', false)"/>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="show_bar_type">Show Bar</label>
                <select class="form-control" data-toggle="select" id="show_bar_type" name="show_bar_type"
                        v-model="model.show_bar_type">
                    <option value="immediate">Immediate</option>
                    <option value="delay">Delay</option>
                    <option value="scroll">Scroll Point</option>
                    <option value="exit">Smart Exit Intent</option>
                </select>
            </div>
        </div>
        <div class="col-md-4" v-show="model.show_bar_type === 'delay'">
            <div class="form-group">
                <label class="form-control-label ml-1" for="delay_in_seconds">Delay in Seconds</label>
                <div class="row">
                    <div class="col-md-10 col-sm-9">
                        <vue-slider :speed="1" :min="1" :max="10" v-model="model.delay_in_seconds" id="delay_in_seconds" @change="changeStatusVal"></vue-slider>
                    </div>
                    <div class="col-md-2 col-sm-3 pl-0 mt--1">@{{ model.delay_in_seconds }}s</div>
                    <input type="hidden" name="delay_in_seconds" v-model="model.delay_in_seconds"/>
                </div>
            </div>
        </div>
        <div class="col-md-4" v-show="model.show_bar_type === 'scroll'">
            <div class="form-group">
                <label class="form-control-label ml-1" for="scroll_point_percent">Scroll Point Percent</label>
                <div class="row">
                    <div class="col-md-10 col-sm-9">
                        <vue-slider :speed="1" :min="0" :max="100" v-model="model.scroll_point_percent" id="scroll_point_percent" @change="changeStatusVal"></vue-slider>
                    </div>
                    <div class="col-md-2 col-sm-3 pl-0 mt--1">@{{ model.scroll_point_percent }}%</div>
                    <input type="hidden" name="scroll_point_percent" v-model="model.scroll_point_percent"/>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="frequency">Frequency</label>
                <select class="form-control" data-toggle="select" id="frequency" name="frequency"
                        v-model="model.frequency">
                    <option value="every">Every Visit</option>
                    <option value="day">Once a Day</option>
                    <option value="week">Once a Week</option>
                    <option value="once">Once</option>
                </select>
            </div>
        </div>
    </div>
</div>
