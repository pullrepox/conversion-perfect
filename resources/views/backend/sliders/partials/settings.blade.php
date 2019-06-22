<div class="card" id="settings-card" style="display: none;">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Settings</h3>
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
                        <div class="form-group">
                            <label for="position">Position</label>
                            <select class="form-control" v-model="settings.position" id="position">
                                <option value="top">Top</option>
                                <option value="bottom">Bottom</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="isSticky">Sticky</label>
                        <div class="form-group">
                            <label class="custom-toggle mt-2">
                                <input v-model="settings.is_sticky" type="checkbox" id="is-sticky">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="pushcontentdown">Push content Down</label>
                        <div class="form-group">
                            <label class="custom-toggle mt-2">
                                <input v-model="settings.push_content_down" type="checkbox" id="pushcontentdown">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="showCloseBtn">Show Close Button</label>
                        <div class="form-group">
                            <label class="custom-toggle mt-2">
                                <input v-model="settings.show_close_btn" type="checkbox" id="show-close-btn">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="trigger">Trigger</label>
                            <select class="form-control" v-model="settings.trigger" id="trigger">
                                <option value="instant">Instant</option>
                                <option value="xseconds">After Delay</option>
                                <option value="xscroll">After Scroll</option>
                                <option value="onexit">On Exit</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="delaySeconds">Seconds Delay</label>
                            <input type="number" v-model="settings.delay_seconds"
                                   :disabled=settings.trigger!='xseconds'
                                   class="form-control"
                                   id="delay-seconds" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="delayScroll">Scroll Delay</label>
                            <input type="number"
                                   v-model="settings.delay_scroll"
                                   :disabled=settings.trigger!='xscroll'
                                   class="form-control"
                                   id="delay-scroll" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="frequency">Frequency</label>
                            <select class="form-control" v-model="settings.frequency" id="frequency">
                                <option value="visit">Every Visit</option>
                                <option value="daily">Once per day</option>
                                <option value="weekly">Once per week</option>
                                <option value="once">Once</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>