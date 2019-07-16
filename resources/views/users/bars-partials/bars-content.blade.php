<div class="tab-pane fade" :class="{'show': model.sel_tab === 'content', 'active': model.sel_tab === 'content'}" id="tabs-content" role="tabpanel" aria-labelledby="tabs-content-tab">
    <div class="tabs-content tabs-data-entry">
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="sub_headline">Subheadline</label>
                    <div class="w-100 ql-editor-parent">
                        <div id="sub_headline" data-parent="content" data-toggle="quill" data-quill-placeholder="Your Subheadline"></div>
                        <input type="hidden" v-for="(s_h_l, h_i) in model.content.sub_headline" :key="`s_hLine_${h_i}`" name="sub_headline[]" :value="s_h_l.insert"
                               v-if="s_h_l.insert.trim() != ''"/>
                    </div>
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
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="sub_headline_color">Subheadline Color</label>
                    <input class="jscolor form-control" name="sub_headline_color"
                           id="sub_headline_color" v-model="model.content.sub_headline_color" @change="updateJSColor('sub_headline_color', 'content')"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="sub_background_color">Subheadline Highlight Color</label>
                    <input class="form-control jscolor {required:false}" name="sub_background_color"
                           id="sub_background_color" v-model="model.content.sub_background_color" @change="updateJSColor('sub_background_color', 'content')"/>
                </div>
            </div>
        </div>
        @include('users.bars-partials.bars-button')
        @if (!is_null(auth()->user()->permissions))
            @if (auth()->user()->permissions['social-buttons'])
                {{-- Social Buttons here. --}}
            @endif
        @endif
        @include('users.bars-partials.bars-video')
    </div>
</div>
