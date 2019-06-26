<div class="card mt--3">
    <div class="card-header pt-2 pb-2 division-card-header">
        <h3 class="mb-0 card-title">Options</h3>
    </div>
    <div class="card-body pt-3 pb-3">
        <div class="form-row mt--2">
            <div class="col">
                <button type="button" class="btn btn-sm mt-2" v-for="(o_item, o_i) in options_list"
                        @click="toggleOption(o_item.key)" v-show="!bar_option[o_item.key]" :class="o_item.class" :key="`o_item_btn_${o_i}`">
                    @{{ o_item.name }}
                </button>
            </div>
        </div>
    </div>
</div>
