<div class="card" id="opt-in-settings-card" style="display: none;">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Opt In Settings</h3>
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
                            <label >Optin Responder Type</label>
                            <select class="form-control" v-model="opt_in_settings.optin_type">
                                <option value="mailchimp">MailChimp</option>
                                <option value="aweber">Aweber</option>
                                <option value="getresponse">Get Response</option>
                                <option value="convertkit">Convert Kit</option>
                                <option value="activecampaign">Active Campaign</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Optin List(based on responder type)</label>
                            <input type="text" v-model="opt_in_settings.optin_list"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Reshow Slider</label>
                        <div class="form-group">
                            <label class="custom-toggle mt-2">
                                <input v-model="opt_in_settings.reshow_slider" type="checkbox">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-1"></div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Optin Action</label>
                            <select class="form-control" v-model="opt_in_settings.optin_action">
                                <option value="redirect">Redirect</option>
                                <option value="showMessage">Show Message</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Optin After Message</label>
                            <input type="text" v-model="opt_in_settings.after_message"
                                   class="form-control"
                                    :disabled=opt_in_settings.optin_action!='showMessage'>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Optin Redirection Url</label>
                            <input type="text" v-model="opt_in_settings.redirection_url"
                                   class="form-control"
                                    :disabled=opt_in_settings.optin_action!='redirect'>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>