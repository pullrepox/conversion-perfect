<div class="card" id="opt-in-appearance-card" style="display: none;">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Opt In Appearance</h3>
            <div class="col text-right">
                <button type="button" class="btn mr--2 no-shadow-box text-underline hide-card-btn">
                    hide
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
{{--        optintype ( standard, image, video )--}}
{{--        optinimage (upload/url)--}}
{{--        optinvideourl--}}
{{--        headlinetext--}}
{{--        panelbgcolor--}}
{{--        subheadlinetext--}}
{{--        subheadlinecolor--}}
{{--        nameplaceholdertext--}}
{{--        emailplaceholdertext--}}
{{--        showplaceholdericons (0/1)--}}
{{--                buttontype (square, rounded)--}}
{{--                buttontextcolor--}}
{{--                buttonbgcolor--}}
{{--                buttonanimation ( none, small shake, medium shake, large--}}
{{--                shake, maybe others? )--}}
{{--                buttontext--}}
{{--        tinyfootertext (default "We won't spam you.")--}}
{{--        tinyfootertextcolor--}}

        <div class="row mt-3">
            <div class="col">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="optinType">Optin Type</label>
                            <select class="form-control" v-model="opt_in_appearance.optin_type" id="optin-type">
                                <option value="standard">Standard</option>
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="optinImage">Optin Image</label>
                            <input type="text" v-model="opt_in_appearance.optin_image"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="optinVideo">Optin Video</label>
                            <input type="text" v-model="opt_in_appearance.optin_video"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="headlineText">Headline Text</label>
                            <input type="text" v-model="opt_in_appearance.headline_text"
                                   class="form-control"
                                   id="headline-text">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="panelBgcolor">Panel Background Color</label>
                            <input type="text" v-model="opt_in_appearance.panel_bgcolor"
                                   class="form-control color-picker"
                                   id="panel-bgcolor">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subheadlineText">Sub Headline Text</label>
                            <input type="text" v-model="opt_in_appearance.subheadline_text"
                                   class="form-control"
                                   id="subheadline-text">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subheadlineColor">Sub Headline Color</label>
                            <input type="text" v-model="opt_in_appearance.subheadlineColor"
                                   class="form-control color-picker"
                                   id="subheadline-color">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="namePlaceholderText">Name PlaceHolder Text</label>
                            <input type="text" v-model="opt_in_appearance.name_placeholder_text"
                                   class="form-control"
                                   id="name-placeholder-text">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="emailPlaceholderText">Email PlaceHolder Text</label>
                            <input type="text" v-model="opt_in_appearance.email_placeholder_text"
                                   class="form-control"
                                   id="email-placeholder-text">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="showPlaceholderIcons">Show Placeholder Icons</label>
                        <div class="form-group">
                            <label class="custom-toggle mt-2">
                                <input v-model="opt_in_appearance.show_placeholder_icons" type="checkbox">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label >Button Type</label>
                            <select class="form-control" v-model="opt_in_appearance.button_type">
                                <option value="square">Square</option>
                                <option value="rounded">Rounded</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="optinButtonTextColor">Button Text Color</label>
                            <input type="text" v-model="opt_in_appearance.button_text_color"
                                   class="form-control color-picker"
                                   id="optin-button-text-color">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="optinButtonBgcolor">Button Background Color</label>
                            <input type="text" v-model="opt_in_appearance.button_bgcolor"
                                   class="form-control color-picker"
                                   id="optin-button-bgcolor">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="optinButtonText">Button Text</label>
                            <input type="text" v-model="opt_in_appearance.button_text"
                                   class="form-control"
                                   id="optin-button-text">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="optinButtonAnimation">Button Animation</label>
                            <select class="form-control" v-model="opt_in_appearance.button_animation" id="optin-button-animation">
                                <option value="none">None</option>
                                <option value="small_shake">Small Shake</option>
                                <option value="medium_shake">Medium Shake</option>
                                <option value="large_shake">Large Shake</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tinyFooterText">Tiny Footer Text</label>
                            <input type="text" v-model="opt_in_appearance.tinyFooter_text"
                                   class="form-control"
                                   id="tinyFooter-text">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tinyFooterTextColor">Sub Headline Color</label>
                            <input type="text" v-model="opt_in_appearance.tiny_footer_text_color"
                                   class="form-control color-picker"
                                   id="tiny-footer-text-color">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @section('scripts')
        @parent
        <script>
            $(function () {
                $('#tiny-footer-text-color').on('colorpickerChange',function(event){
                   slider.opt_in_appearance.tiny_footer_text_color = event.color.toString();
                });

                $('#optin-button-bgcolor').on('colorpickerChange', function (event) {
                    slider.opt_in_appearance.optin_button_bgcolor = event.color.toString();
                });
                $('#optin-button-text-color').on('colorpickerChange', function (event) {
                    slider.opt_in_appearance.optin_button_text_color = event.color.toString();
                });
                $('#subheadline-color').on('colorpickerChange', function (event) {
                    slider.opt_in_appearance.subheadline_color = event.color.toString();
                });
                $('#panel-bgcolor').on('colorpickerChange', function (event) {
                    slider.opt_in_appearance.panel_bgcolor = event.color.toString();
                });
            });
        </script>
@endsection
