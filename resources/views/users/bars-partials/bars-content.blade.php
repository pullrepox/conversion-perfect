<div class="card mt--3" v-show="bar_option.content">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Content</h3>
            <div class="col text-right">
                <button v-if="show_btn.content" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="saveOption('content')">
                    Save
                </button>
                <button v-if="!show_btn.content" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="toggleOption('content')">
                    Hide
                </button>
                <button type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal" @click="clearOptionConfirm('content')">
                    Clear
                </button>
                <input type="hidden" name="opt_content" v-model="bar_option.content"/>
            </div>
        </div>
    </div>
    <div class="card-body pb-0 pt-2">
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="sub_headline">
                        Sub Headline
                    </label>
                    <div id="sub_headline" data-parent="content" data-toggle="quill" data-quill-placeholder="Your Subheadline Text Here."></div>
                    <input type="hidden" v-for="(s_h_l, h_i) in model.content.sub_headline" :key="`s_hLine_${h_i}`" name="sub_headline[]" :value="s_h_l.insert"
                           v-if="s_h_l.insert.trim() != ''"/>
                    <span v-for="(s_h_l, h_i) in model.content.sub_headline" :key="`s_hLine_attr_${h_i}`" v-if="s_h_l.insert.trim() != ''">
                        <span v-if="s_h_l.attributes">
                            <input type="hidden" name="sub_headline_bold[]" :value="s_h_l.attributes.bold ? true : ''"/>
                            <input type="hidden" name="sub_headline_italic[]" :value="s_h_l.attributes.italic ? true : ''"/>
                            <input type="hidden" name="sub_headline_underline[]" :value="s_h_l.attributes.underline ? true : ''"/>
                            <input type="hidden" name="sub_headline_strike[]" :value="s_h_l.attributes.strike ? true : ''"/>
                        </span>
                        <span v-else>
                            <input type="hidden" name="sub_headline_bold[]" value=""/>
                            <input type="hidden" name="sub_headline_italic[]" value=""/>
                            <input type="hidden" name="sub_headline_underline[]" value=""/>
                            <input type="hidden" name="sub_headline_strike[]" value=""/>
                        </span>
                    </span>
                    @error('sub_headline')
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="sub_headline_color">
                        Sub Headline Color
                    </label>
                    <input class="jscolor form-control" name="sub_headline_color"
                           id="sub_headline_color" v-model="model.content.sub_headline_color" @change="updateJSColor('sub_headline_color', 'content')"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="sub_background_color">
                        Sub Headline Highlight Color
                    </label>
                    <input class="jscolor form-control" name="sub_background_color" id="sub_background_color" v-model="model.content.sub_background_color"
                           @change="updateJSColor('sub_background_color', 'content')"
                           @keydown="tabKeyPress('#media', true, $event)" @keypress="tabKeyPress('#media', true, $event)"/>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div
                :class="{'col-md-3': model.content.media === 'video', 'col-md-6': model.content.media === 'none', 'col-md-4': (model.content.media === 'online_image' || model.content.media === 'upload_image')}">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="media">Media</label>
                    <select class="form-control" data-toggle="select" id="media" name="media" required
                            v-model="model.content.media" data-parent="content">
                        <option value="none">None</option>
                        <option value="video">Video</option>
                        <option value="online_image">Image(Online)</option>
                        <option value="upload_image">Image(Upload)</option>
                    </select>
                </div>
            </div>
            <div v-show="model.content.media !== 'none'"
                 :class="{'col-md-4': (model.content.media === 'online_image' || model.content.media === 'upload_image'), 'col-md-3': model.content.media === 'video'}">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="media_location">Media Location</label>
                    <select class="form-control" data-toggle="select" id="media_location" name="media_location" required
                            v-model="model.content.media_location" data-parent="content">
                        <option value="left">Left</option>
                        <option value="right">Right</option>
                        <option value="below_text">Below Text</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4" v-show="model.content.media === 'video'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="video_url">Video URL</label>
                    <input type="text" id="video_url" name="video_url" v-model="model.content.video_url" data-parent="content" class="form-control" @input="showSaveBtn('content')"/>
                </div>
            </div>
            <div class="col-md-2" v-show="model.content.media === 'video'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="video_auto_play">Video Autoplay</label>
                    <div class="radio ml-1">
                        <label class="custom-toggle custom-toggle-light">
                            <input type="checkbox" id="video_auto_play" name="video_auto_play"
                                   data-parent="content" v-model="model.content.video_auto_play" @input="showSaveBtn('content')">
                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4" v-show="model.content.media === 'online_image'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="image_url">Image URL</label>
                    <input type="text" id="image_url" name="image_url" v-model="model.content.image_url" data-parent="content" class="form-control" @input="showSaveBtn('content')"/>
                </div>
            </div>
            <div class="col-md-4" v-show="model.content.media === 'upload_image'">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="upload_image">Upload Image</label>
                    <input type="file" id="upload_image" name="upload_image" data-parent="content" class="form-control" accept="image/*"/>
                </div>
            </div>
        </div>
    </div>
</div>
