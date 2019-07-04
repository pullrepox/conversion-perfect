<div class="tab-pane fade" :class="{'show': sel_tab === 'overlay', 'active': sel_tab === 'overlay'}" id="tabs-overlay" role="tabpanel" aria-labelledby="tabs-overlay-tab">
    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="third_party_url">3rd Party URL</label>
                <input type="text" id="third_party_url" name="third_party_url" data-parent="overlay" class="form-control @error('third_party_url') is-invalid @enderror"
                       @keydown="tabKeyPress('#custom_link', true, $event)" @keypress="tabKeyPress('#custom_link', true, $event)"
                       v-model="model.overlay.third_party_url" @input="changeToUrl('third_party_url', 'overlay')"/>
                @error('third_party_url')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label class="form-control-label ml-1" for="custom_link">Custom Link</label>
                <div class="form-row">
                    <div class="col-md-6 pr-2">
                        <select class="form-control" data-toggle="select" id="custom_link" name="custom_link"
                                v-model="model.overlay.custom_link" data-parent="overlay">
                            @foreach($custom_links as $c_key => $c_row)
                                <option value="{{ $c_key }}">{{ $c_row }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 pl-2">
                        <div class="track-link-sept">
                            <input type="text" id="custom_link_text" name="custom_link_text" data-parent="overlay" class="form-control @error('custom_link_text') is-invalid @enderror"
                                   v-model="model.overlay.custom_link_text" @input="changeStatusVal"/>
                            @error('custom_link_text')
                            <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="meta_title">SEO Title</label>
                <input type="text" id="meta_title" name="meta_title" data-parent="overlay" class="form-control"
                       v-model="model.overlay.meta_title" @input="changeStatusVal"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="meta_description">SEO Description</label>
                <textarea id="meta_description" name="meta_description" v-model="model.overlay.meta_description" data-parent="overlay"
                          class="form-control" @input="changeStatusVal" rows="1"></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="meta_keywords">SEO Keywords</label>
                <div class="tags-area">
                    <input type="text" id="meta_keywords" name="meta_keywords" data-parent="overlay" data-toggle="tags" class="form-control"
                           v-model="model.overlay.meta_keywords" @input="changeStatusVal"/>
                </div>
            </div>
        </div>
    </div>
</div>
