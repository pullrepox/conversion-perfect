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
    </div>
</div>
