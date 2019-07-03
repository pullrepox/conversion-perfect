<div class="card mt--3" v-show="bar_option.autoresponder">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Autoresponder</h3>
            <div class="col text-right">
                <button v-if="show_btn.autoresponder" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="saveOption('autoresponder')">
                    Save
                </button>
                <button v-if="!show_btn.autoresponder" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="toggleOption('autoresponder')">
                    Hide
                </button>
                <button type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal" @click="clearOptionConfirm('autoresponder')">
                    Clear
                </button>
                <input type="hidden" name="opt_autoresponder" v-model="bar_option.autoresponder"/>
            </div>
        </div>
    </div>
    <div class="card-body pb-0 pt-2">
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="integration_type">Autoresponder Service</label>
                    <select class="form-control" data-toggle="select" id="integration_type" name="integration_type"
                            @keydown="tabKeyPress('#list', true, $event)" @keypress="tabKeyPress('#list', true, $event)"
                            v-model="model.autoresponder.integration_type" data-parent="autoresponder">
                        @foreach($responder_list as $r_key => $r_row)
                            <option value="{{ $r_key }}">{{ $r_row }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4" v-show="model.autoresponder.integration_type !== 'none'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="list">List</label>
                    <select class="form-control" data-toggle="select" id="list" name="list"
                            @keydown="tabKeyPress('#after_submit', true, $event)" @keypress="tabKeyPress('#after_submit', true, $event)"
                            v-model="model.autoresponder.list" data-parent="autoresponder">
                        <option :value="l_item.key" v-for="(l_item, l_i) in model.auto_responder_list" :key="`list_${l_i}`">@{{ l_item.name }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row" v-show="model.autoresponder.integration_type !== 'none'">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="after_submit">After Submit</label>
                    <select class="form-control" data-toggle="select" id="after_submit" name="after_submit"
                            v-model="model.autoresponder.after_submit" data-parent="autoresponder">
                        <option value="show_message">Show Message</option>
                        <option value="show_message_hide_bar">Show Message and Hide Bar</option>
                        <option value="redirect">Redirect</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4" v-show="model.autoresponder.after_submit !== 'redirect'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="message">Message</label>
                    <textarea id="message" name="message" v-model="model.autoresponder.message" data-parent="autoresponder"
                              class="form-control" @input="showSaveBtn('autoresponder')" rows="1"></textarea>
                </div>
            </div>
            <div class="col-md-4" v-show="model.autoresponder.after_submit === 'show_message_hide_bar'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="autohide_delay_seconds">Hide Delay Seconds</label>
                    <div class="row">
                        <div class="col-md-10 col-sm-9">
                            <vue-slider :speed="1" :min="1" :max="10" v-model="model.autoresponder.autohide_delay_seconds" id="autohide_delay_seconds"
                                        @change="showSaveBtn('autoresponder')"></vue-slider>
                        </div>
                        <div class="col-md-2 col-sm-3 pl-0 mt--1">@{{ model.autoresponder.autohide_delay_seconds }}s</div>
                        <input type="hidden" name="autohide_delay_seconds" v-model="model.autoresponder.autohide_delay_seconds"/>
                    </div>
                </div>
            </div>
            <div class="col-md-4" v-show="model.autoresponder.after_submit === 'redirect'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="redirect_url">Redirect URL</label>
                    <input type="text" id="redirect_url" name="redirect_url" data-parent="autoresponder" class="form-control @error('redirect_url') is-invalid @enderror"
                           v-model="model.autoresponder.redirect_url" @input="changeVideoUrl('redirect_url', 'autoresponder')"/>
                </div>
            </div>
        </div>
    </div>
</div>
