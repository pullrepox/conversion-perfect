<div class="card mt--3">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Preview</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="w-100 h-100">
            @include('users.bars-partials.preview-main')
        </div>
        <div v-if="model.lead_capture.integration_type !== 'none'" class="w-100 h-100 mt-3">
            <div v-if="model.lead_capture.opt_in_type === 'standard'">
                @include('users.bars-partials.preview-standard')
            </div>
            <div v-else>
                @include('users.bars-partials.preview-media')
            </div>
        </div>
    </div>
</div>
