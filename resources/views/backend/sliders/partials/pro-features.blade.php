<div class="card" id="pro-features-card" style="display: none;">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Pro Features</h3>
            <div class="col text-right">
                <button type="button" class="btn mr--2 no-shadow-box text-underline hide-card-btn">
                    hide
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col">
                <div class="row">
                    <div class="col-md-3">
                        <label>Remove Branding</label>
                        <div class="form-group">
                            <label class="custom-toggle mt-2">
                                <input v-model="pro_features.remove_branding" type="checkbox">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Show Slider over third party sites</label>
                            <select class="form-control" v-model="pro_features.show_over_third_party_site">
                                <option value="clickperfect">Click Perfect</option>
                                <option value="conversionperfect">Conversion Perfect</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Page Title for Overlay</label>
                            <input type="text" v-model="pro_features.overlay_page_title"
                                   class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>