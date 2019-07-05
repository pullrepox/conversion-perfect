<div class="tab-pane fade" :class="{'show': sel_tab === 'translation', 'active': sel_tab === 'translation'}" id="tabs-translation" role="tabpanel" aria-labelledby="tabs-translation-tab">
    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="days_label">Days Label</label>
                <input type="text" id="days_label" name="days_label" data-parent="translation" v-model="model.translation.days_label"
                       class="form-control @error('days_label') is-invalid @enderror" @input="changeStatusVal"/>
                @error('days_label')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="hours_label">Hours Label</label>
                <input type="text" id="hours_label" name="hours_label" data-parent="translation" v-model="model.translation.hours_label"
                       class="form-control @error('hours_label') is-invalid @enderror" @input="changeStatusVal"/>
                @error('hours_label')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="minutes_label">Minutes Label</label>
                <input type="text" id="minutes_label" name="minutes_label" data-parent="translation" v-model="model.translation.minutes_label"
                       class="form-control @error('minutes_label') is-invalid @enderror" @input="changeStatusVal"/>
                @error('minutes_label')
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
                <label class="form-control-label ml-1" for="seconds_label">Seconds Label</label>
                <input type="text" id="seconds_label" name="seconds_label" data-parent="translation" v-model="model.translation.seconds_label"
                       class="form-control @error('seconds_label') is-invalid @enderror" @input="changeStatusVal"/>
                @error('seconds_label')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="opt_in_name_placeholder">Opt In Name Placeholder</label>
                <input type="text" id="opt_in_name_placeholder" name="opt_in_name_placeholder" data-parent="translation" v-model="model.translation.opt_in_name_placeholder"
                       class="form-control @error('opt_in_name_placeholder') is-invalid @enderror" @input="changeStatusVal"/>
                @error('opt_in_name_placeholder')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="opt_in_email_placeholder">Opt In Email Placeholder</label>
                <input type="text" id="opt_in_email_placeholder" name="opt_in_email_placeholder" data-parent="translation" v-model="model.translation.opt_in_email_placeholder"
                       class="form-control @error('opt_in_email_placeholder') is-invalid @enderror" @input="changeStatusVal"/>
                @error('opt_in_email_placeholder')
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
                <label class="form-control-label ml-1" for="powered_by_label">Powered By</label>
                <input type="text" id="powered_by_label" name="powered_by_label" data-parent="translation" v-model="model.translation.powered_by_label"
                       class="form-control" @input="changeStatusVal"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label ml-1" for="disclaimer">Disclaimer</label>
                <input type="text" id="disclaimer" name="disclaimer" data-parent="translation" v-model="model.translation.disclaimer"
                       class="form-control" @input="changeStatusVal"/>
            </div>
        </div>
    </div>
</div>
