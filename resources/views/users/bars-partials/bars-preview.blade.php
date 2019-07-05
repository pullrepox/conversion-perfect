<div class="card">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Preview</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="w-100 h-100" v-if="sel_tab === 'translation' || (sel_tab !== 'lead_capture' || model.lead_capture.integration_type === 'none')">
            @include('users.bars-partials.preview-main')
        </div>
        <div v-if="sel_tab === 'translation' || (model.lead_capture.integration_type !== 'none' && sel_tab === 'lead_capture')"
             class="w-100 h-100" :class="{'mt-3': sel_tab === 'translation'}">
            <div v-if="model.lead_capture.opt_in_type === 'standard'">
                @include('users.bars-partials.preview-standard')
            </div>
            <div v-else>
                @include('users.bars-partials.preview-media')
            </div>
        </div>
    </div>
</div>
