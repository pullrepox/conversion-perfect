<div class="card mt--3" v-show="bar_option.overlay">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Overlay</h3>
            <div class="col text-right">
                <button v-if="show_btn.overlay" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="saveOption('overlay')">
                    Save
                </button>
                <button v-if="!show_btn.overlay" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="toggleOption('overlay')">
                    Hide
                </button>
                <button type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal" @click="clearOptionConfirm('overlay')">
                    Clear
                </button>
                <input type="hidden" name="opt_overlay" v-model="bar_option.overlay"/>
            </div>
        </div>
    </div>
    <div class="card-body pb-0 pt-2">
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="third_party_url">3rd Party URL</label>
                    <input type="text" id="third_party_url" name="third_party_url" data-parent="overlay" class="form-control @error('third_party_url') is-invalid @enderror"
                           @keydown="tabKeyPress('#custom_link', true, $event)" @keypress="tabKeyPress('#custom_link', true, $event)"
                           v-model="model.overlay.third_party_url" @input="changeVideoUrl('third_party_url', 'overlay')"/>
                    @error('third_party_url')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="custom_link">Custom Link</label>
                    <select class="form-control" data-toggle="select" id="custom_link" name="custom_link" required
                            @keydown="tabKeyPress('#custom_link_text', false, $event)" @keypress="tabKeyPress('#custom_link_text', false, $event)"
                            v-model="model.overlay.custom_link" data-parent="overlay">
                        @foreach($custom_links as $c_key => $c_row)
                            <option value="{{ $c_key }}">{{ $c_row }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="custom_link_text">Custom Link Text</label>
                    <input type="text" id="custom_link_text" name="custom_link_text" data-parent="overlay" class="form-control @error('custom_link_text') is-invalid @enderror"
                           v-model="model.overlay.custom_link_text" @input="showSaveBtn('overlay')"/>
                    @error('custom_link_text')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="meta_title">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" data-parent="overlay" class="form-control"
                           v-model="model.overlay.meta_title" @input="showSaveBtn('overlay')"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="meta_description">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" v-model="model.overlay.meta_description" data-parent="overlay"
                              class="form-control" @input="showSaveBtn('overlay')"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label ml-1" for="meta_keywords">Meta Keywords</label>
                    <div class="tags-area">
                        <input type="text" id="meta_keywords" name="meta_keywords" data-parent="overlay" data-toggle="tags" class="form-control"
                               v-model="model.overlay.meta_keywords" @input="showSaveBtn('overlay')"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
