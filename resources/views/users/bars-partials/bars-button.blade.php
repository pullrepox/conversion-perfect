<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="button_type">Button</label>
            <select class="form-control" data-toggle="select" id="button_type" name="button_type"
                    @keydown="tabKeyPress('#button_location', true, $event)" @keypress="tabKeyPress('#button_location', true, $event)"
                    v-model="model.content.button_type" data-parent="content">
                <option value="none">None</option>
                <option value="square">Square</option>
                <option value="rounded">Rounded</option>
            </select>
        </div>
    </div>
    <div class="col-md-4" v-show="model.content.button_type !== 'none'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="button_location">Button Location</label>
            <select class="form-control" data-toggle="select" id="button_location" name="button_location"
                    @keydown="tabKeyPress('#button_label', false, $event)" @keypress="tabKeyPress('#button_label', false, $event)"
                    v-model="model.content.button_location" data-parent="content">
                <option value="right">Right</option>
                <option value="left">Left</option>
                <option value="below_text">Below Text</option>
            </select>
        </div>
    </div>
    <div class="col-md-4" v-show="model.content.button_type !== 'none'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="button_label">Button Label</label>
            <input type="text" id="button_label" name="button_label" data-parent="content" class="form-control @error('button_label') is-invalid @enderror"
                   v-model="model.content.button_label" @input="validationCheck('button_label', 'content')"/>
            @error('button_label')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
</div>
<div class="form-row" v-show="model.content.button_type !== 'none'">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="button_background_color">Button Background Color</label>
            <input class="jscolor form-control" name="button_background_color" id="button_background_color" v-model="model.content.button_background_color"
                   @change="updateJSColor('button_background_color', 'content')"
                   @keydown="tabKeyPress('#button_text_color', false, $event)" @keypress="tabKeyPress('#button_text_color', false, $event)"/>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="button_text_color">Button Label Color</label>
            <input class="jscolor form-control" name="button_text_color" id="button_text_color" v-model="model.content.button_text_color"
                   @change="updateJSColor('button_text_color', 'content')"
                   @keydown="tabKeyPress('#button_animation', true, $event)" @keypress="tabKeyPress('#button_animation', true, $event)"/>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="button_animation">Button Animation</label>
            <select class="form-control" data-toggle="select" id="button_animation" name="button_animation"
                    @keydown="tabKeyPress('#button_action', true, $event)" @keypress="tabKeyPress('#button_action', true, $event)"
                    v-model="model.content.button_animation" data-parent="content">
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
<div class="form-row" v-show="model.content.button_type !== 'none'">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="button_action">Button Action</label>
            <select class="form-control" data-toggle="select" id="button_action" name="button_action"
                    @keydown="tabKeyPress('#button_click_url', false, $event)" @keypress="tabKeyPress('#button_click_url', false, $event)"
                    v-model="model.content.button_action" data-parent="content">
                <option value="hide_bar">Hide Bar</option>
                <option value="open_click_url">Open Click URL</option>
            </select>
        </div>
    </div>
    <div class="col-md-4" v-show="model.content.button_action === 'open_click_url'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="button_click_url">Click URL</label>
            <input type="text" id="button_click_url" name="button_click_url" data-parent="content" class="form-control @error('button_click_url') is-invalid @enderror"
                   v-model="model.content.button_click_url" @input="changeStatusVal"/>
            @error('button_click_url')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" v-show="model.content.button_action === 'open_click_url'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="button_open_new">Open In New Window</label>
            <div class="radio ml-1">
                <label class="custom-toggle custom-toggle-light">
                    <input type="checkbox" id="button_open_new" name="button_open_new"
                           data-parent="content" v-model="model.content.button_open_new" @input="changeStatusVal">
                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                </label>
            </div>
        </div>
    </div>
</div>
