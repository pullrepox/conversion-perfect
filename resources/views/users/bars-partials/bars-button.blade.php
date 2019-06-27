<div class="card mt--3" v-show="bar_option.button">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Button</h3>
            <div class="col text-right">
                <button v-if="show_btn.button" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="saveOption('button')">
                    Save
                </button>
                <button v-if="!show_btn.button" type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="toggleOption('button')">
                    Hide
                </button>
                <button type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal" @click="clearOptionConfirm('button')">
                    Clear
                </button>
                <input type="hidden" name="opt_button" v-model="bar_option.button"/>
            </div>
        </div>
    </div>
    <div class="card-body pb-0 pt-2">
    
    </div>
</div>
