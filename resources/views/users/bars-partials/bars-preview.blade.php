<div class="card mt--3" v-if="bar_option.preview">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Preview</h3>
            <div class="col text-right" v-if="!create_edit">
                <button type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="toggleOption('preview')">
                    Hide
                </button>
                <input type="hidden" name="opt_preview" v-model="bar_option.preview"/>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="w-100 h-100">
            @include('users.bars-partials.preview-main')
        </div>
        <div v-if="model.opt_in.opt_in_type !== 'none'" class="w-100 h-100 mt-3">
            <div v-if="model.opt_in.opt_in_type === 'standard'">
                @include('users.bars-partials.preview-standard')
            </div>
            <div v-else>
                @include('users.bars-partials.preview-media')
            </div>
        </div>
    </div>
</div>
