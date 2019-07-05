<div class="form-row" v-show="model.lead_capture.integration_type !== 'none'">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="opt_in_type">Opt-In Type</label>
            <select class="form-control" data-toggle="select" id="opt_in_type" name="opt_in_type"
                    v-model="model.lead_capture.opt_in_type" data-parent="lead_capture">
                <option value="standard">Standard</option>
                <option value="img-online">Image Online</option>
                <option value="img-upload">Image Upload</option>
                <option value="vid-youtube">Youtube</option>
                <option value="vid-vimeo">Vimeo</option>
                <option value="vid-other">Other</option>
            </select>
        </div>
    </div>
    <div class="col-md-4" v-if="model.lead_capture.opt_in_type === 'vid-youtube'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="opt_in_youtube_url">Youtube URL</label>
            <input type="text" class="form-control @error('opt_in_youtube_url') is-invalid @enderror"
                   id="opt_in_youtube_url" name="opt_in_youtube_url" @input="changeToUrl('opt_in_youtube_url', 'lead_capture')" data-parent="lead_capture"
                   v-model="model.lead_capture.opt_in_youtube_url" placeholder="https://www.youtube.com/embed/_UbDeqPdUek"/>
            @error('opt_in_youtube_url')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" v-if="model.lead_capture.opt_in_type === 'vid-vimeo'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="opt_in_vimeo_url">Vimeo URL</label>
            <input type="text" class="form-control @error('opt_in_vimeo_url') is-invalid @enderror"
                   id="opt_in_vimeo_url" name="opt_in_vimeo_url" @input="changeToUrl('opt_in_vimeo_url', 'lead_capture')" data-parent="lead_capture"
                   v-model="model.lead_capture.opt_in_vimeo_url" placeholder="https://player.vimeo.com/video/20732587"/>
            @error('opt_in_vimeo_url')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" v-if="model.lead_capture.opt_in_type === 'vid-other'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="opt_in_video_code">Video Embed Code</label>
            <textarea id="opt_in_video_code" name="opt_in_video_code" v-model="model.lead_capture.opt_in_video_code" data-parent="lead_capture"
                      class="form-control @error('opt_in_video_code') is-invalid @enderror" @input="changeStatusVal" rows="1"></textarea>
            @error('opt_in_video_code')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" v-if="model.lead_capture.opt_in_type === 'vid-youtube' || model.lead_capture.opt_in_type === 'vid-vimeo'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="opt_in_video_auto_play">Autoplay</label>
            <div class="radio ml-1">
                <label class="custom-toggle custom-toggle-light">
                    <input type="checkbox" id="opt_in_video_auto_play" name="opt_in_video_auto_play"
                           data-parent="button" v-model="model.lead_capture.opt_in_video_auto_play" @input="changeStatusVal">
                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-4" v-if="model.lead_capture.opt_in_type === 'img-online'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="image_url">Image URL</label>
            <input type="text" class="form-control @error('image_url') is-invalid @enderror"
                   id="image_url" name="image_url" @input="changeToUrl('image_url', 'lead_capture')" data-parent="lead_capture"
                   v-model="model.lead_capture.image_url"/>
            @error('image_url')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" v-if="model.lead_capture.opt_in_type === 'img-upload'">
        <div class="form-group">
            <label class="form-control-label ml-1">&nbsp;</label>
            <div class="w-100">
                <button type="button" class="btn btn-light btn-sm" @click="$refs.image_selector.click()">Upload Image</button>
                <input type="file" class="area-hidden" accept="image/*" ref="image_selector" @change="uploadImage($event)"/>
                <div class="progress mt-1" v-if="showUpload">
                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                         :aria-valuenow="uploadPercentage" aria-valuemin="0" :aria-valuemax="100"
                         :style="{'width': `${uploadPercentage}%`}"></div>
                </div>
                <input type="hidden" name="image-upload" v-model="model.lead_capture.image_upload"/>
            </div>
        </div>
    </div>
</div>
<div class="form-row" v-show="model.lead_capture.integration_type !== 'none'">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="call_to_action">
                Call to Action Text
            </label>
            <div class="w-100 ql-editor-parent">
                <div id="call_to_action" data-parent="lead_capture" data-toggle="quill" data-quill-placeholder="Call To Action Text Here"></div>
                <input type="hidden" v-for="(c_t_a, c_t_i) in model.lead_capture.call_to_action" :key="`cToAction_${c_t_i}`" name="call_to_action[]"
                       :value="c_t_a.insert" v-if="c_t_a.insert.trim() != ''"/>
            </div>
            <span v-for="(c_t_a, c_t_i) in model.lead_capture.call_to_action" :key="`c_t_a_attr_${c_t_i}`" v-if="c_t_a.insert.trim() != ''">
                        <span v-if="c_t_a.attributes">
                            <input type="hidden" name="call_to_action_bold[]" :value="c_t_a.attributes.bold ? true : ''"/>
                            <input type="hidden" name="call_to_action_italic[]" :value="c_t_a.attributes.italic ? true : ''"/>
                            <input type="hidden" name="call_to_action_underline[]" :value="c_t_a.attributes.underline ? true : ''"/>
                            <input type="hidden" name="call_to_action_strike[]" :value="c_t_a.attributes.strike ? true : ''"/>
                        </span>
                        <span v-else>
                            <input type="hidden" name="call_to_action_bold[]" value=""/>
                            <input type="hidden" name="call_to_action_italic[]" value=""/>
                            <input type="hidden" name="call_to_action_underline[]" value=""/>
                            <input type="hidden" name="call_to_action_strike[]" value=""/>
                        </span>
                    </span>
            @error('call_to_action')
            <span class="invalid-feedback" style="display: block;" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="subscribe_text">
                Subscribe Text
            </label>
            <div class="w-100 ql-editor-parent">
                <div id="subscribe_text" data-parent="lead_capture" data-toggle="quill" data-quill-placeholder="Enter Your Name And Email Below..."></div>
                <input type="hidden" v-for="(s_t, s_t_i) in model.lead_capture.subscribe_text" :key="`s_text_${s_t_i}`" name="subscribe_text[]"
                       :value="s_t.insert" v-if="s_t.insert.trim() != ''"/>
            </div>
            <span v-for="(s_t, s_t_i) in model.lead_capture.subscribe_text" :key="`s_t__attr_${s_t_i}`" v-if="s_t.insert.trim() != ''">
                        <span v-if="s_t.attributes">
                            <input type="hidden" name="subscribe_text_bold[]" :value="s_t.attributes.bold ? true : ''"/>
                            <input type="hidden" name="subscribe_text_italic[]" :value="s_t.attributes.italic ? true : ''"/>
                            <input type="hidden" name="subscribe_text_underline[]" :value="s_t.attributes.underline ? true : ''"/>
                            <input type="hidden" name="subscribe_text_strike[]" :value="s_t.attributes.strike ? true : ''"/>
                        </span>
                        <span v-else>
                            <input type="hidden" name="subscribe_text_bold[]" value=""/>
                            <input type="hidden" name="subscribe_text_italic[]" value=""/>
                            <input type="hidden" name="subscribe_text_underline[]" value=""/>
                            <input type="hidden" name="subscribe_text_strike[]" value=""/>
                        </span>
                    </span>
            @error('subscribe_text')
            <span class="invalid-feedback" style="display: block;" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="subscribe_text_color">Subscribe Text Color</label>
            <input class="jscolor form-control" name="subscribe_text_color" id="subscribe_text_color" v-model="model.lead_capture.subscribe_text_color"
                   @change="updateJSColor('subscribe_text_color', 'opt_in')"/>
        </div>
    </div>
</div>
<div class="form-row" v-show="model.lead_capture.integration_type !== 'none'">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="panel_color">Panel Background Color</label>
            <input class="jscolor {required:false} form-control" name="panel_color" id="panel_color" v-model="model.lead_capture.panel_color"
                   @change="updateJSColor('panel_color', 'opt_in')"/>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="opt_in_button_type">Button Type</label>
            <select class="form-control" data-toggle="select" id="opt_in_button_type" name="opt_in_button_type"
                    v-model="model.lead_capture.opt_in_button_type" data-parent="lead_capture">
                <option value="match_main_button">Match Main Button</option>
                <option value="square">Square</option>
                <option value="rounded">Rounded</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="opt_in_button_label">Button Label</label>
            <input type="text" class="form-control"
                   id="opt_in_button_label" name="opt_in_button_label" @input="changeStatusVal" data-parent="lead_capture"
                   v-model="model.lead_capture.opt_in_button_label"/>
        </div>
    </div>
</div>
<div class="form-row" v-show="model.lead_capture.integration_type !== 'none' && model.lead_capture.opt_in_button_type !== 'match_main_button'">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="opt_in_button_bg_color">Button Color</label>
            <input class="jscolor form-control" name="opt_in_button_bg_color" id="opt_in_button_bg_color" v-model="model.lead_capture.opt_in_button_bg_color"
                   @change="updateJSColor('opt_in_button_bg_color', 'opt_in')"/>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="opt_in_button_label_color">Button Label Color</label>
            <input class="jscolor form-control" name="opt_in_button_label_color" id="opt_in_button_label_color"
                   v-model="model.lead_capture.opt_in_button_label_color" @change="updateJSColor('opt_in_button_label_color', 'opt_in')"/>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="opt_in_button_animation">Animation</label>
            <select class="form-control" data-toggle="select" id="opt_in_button_animation" name="opt_in_button_animation"
                    v-model="model.lead_capture.opt_in_button_animation" data-parent="lead_capture">
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
