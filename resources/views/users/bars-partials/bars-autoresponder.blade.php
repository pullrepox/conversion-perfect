<div class="tab-pane fade" :class="{'show': sel_tab === 'lead_capture', 'active': sel_tab === 'lead_capture'}" id="tabs-lead_capture" role="tabpanel"
     aria-labelledby="tabs-lead_capture-tab">
    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="integration_type">Autoresponder Service</label>
                <select class="form-control" data-toggle="select" id="integration_type" name="integration_type"
                        @keydown="tabKeyPress('#list', true, $event)" @keypress="tabKeyPress('#list', true, $event)"
                        v-model="model.lead_capture.integration_type" data-parent="lead_capture">
                    @foreach($responder_list as $r_key => $r_row)
                        <option value="{{ $r_key }}">{{ $r_row }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4" v-show="model.lead_capture.integration_type !== 'none'">
            <div class="form-group">
                <label class="form-control-label ml-1" for="list">List</label>
                <select class="form-control" data-toggle="select" id="list" name="list"
                        @keydown="tabKeyPress('#after_submit', true, $event)" @keypress="tabKeyPress('#after_submit', true, $event)"
                        v-model="model.lead_capture.list" data-parent="lead_capture">
                    <option :value="l_item.key" v-for="(l_item, l_i) in model.auto_responder_list" :key="`list_${l_i}`">@{{ l_item.name }}</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-row" v-show="model.lead_capture.integration_type !== 'none'">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="after_submit">After Submit</label>
                <select class="form-control" data-toggle="select" id="after_submit" name="after_submit"
                        v-model="model.lead_capture.after_submit" data-parent="lead_capture">
                    <option value="show_message">Show Message</option>
                    <option value="show_message_hide_bar">Show Message and Hide Bar</option>
                    <option value="redirect">Redirect</option>
                </select>
            </div>
        </div>
        <div class="col-md-4" v-show="model.lead_capture.after_submit !== 'redirect'">
            <div class="form-group">
                <label class="form-control-label ml-1" for="message">Message</label>
                <textarea id="message" name="message" v-model="model.lead_capture.message" data-parent="lead_capture"
                          class="form-control" @input="changed_status = true" rows="1"></textarea>
            </div>
        </div>
        <div class="col-md-4" v-show="model.lead_capture.after_submit === 'show_message_hide_bar'">
            <div class="form-group">
                <label class="form-control-label ml-1" for="autohide_delay_seconds">Hide Delay Seconds</label>
                <div class="row">
                    <div class="col-md-10 col-sm-9">
                        <vue-slider :speed="1" :min="1" :max="10" v-model="model.lead_capture.autohide_delay_seconds" id="autohide_delay_seconds"
                                    @change="changed_status = true"></vue-slider>
                    </div>
                    <div class="col-md-2 col-sm-3 pl-0 mt--1">@{{ model.lead_capture.autohide_delay_seconds }}s</div>
                    <input type="hidden" name="autohide_delay_seconds" v-model="model.lead_capture.autohide_delay_seconds"/>
                </div>
            </div>
        </div>
        <div class="col-md-4" v-show="model.lead_capture.after_submit === 'redirect'">
            <div class="form-group">
                <label class="form-control-label ml-1" for="redirect_url">Redirect URL</label>
                <input type="text" id="redirect_url" name="redirect_url" data-parent="lead_capture" class="form-control @error('redirect_url') is-invalid @enderror"
                       v-model="model.lead_capture.redirect_url" @input="changeToUrl('redirect_url', 'lead_capture')"/>
            </div>
        </div>
    </div>
    @include('users.bars-partials.bars-opt-in')
</div>
