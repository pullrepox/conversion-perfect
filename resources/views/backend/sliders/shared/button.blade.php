<div class="card" id="button-card" style="display: none;">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Button</h3>
            <div class="col text-right">
                <button type="button" class="btn mr--2 no-shadow-box text-underline hide-card-btn">
                    hide
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mt-3" id="button">
            <div class="col">
                <input name="type" id="section_type" type="hidden" value="settings"/>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="buttonType">Button Type</label>
                            <select class="form-control" v-model="button.button_type" id="button-type">
                                <option value="square">Square</option>
                                <option value="rounded">Rounded</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="buttonTextColor">Button Text Color</label>
                            <input type="text" v-model="button.button_text_color"
                                   class="form-control color-picker"
                                   id="button-text-color">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="buttonBgcolor">Button Background Color</label>
                            <input type="text" v-model="button.button_bgcolor"
                                   class="form-control color-picker"
                                   id="button-bgcolor">
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="buttonText">Button Text</label>
                            <input type="text" v-model="button.button_text"
                                   class="form-control"
                                   id="button-text">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="buttonLink">Button Link</label>
                            <input type="text" v-model="button.button_link"
                                   class="form-control"
                                   id="button-link">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="buttonTarget">Button Target</label>
                            <input type="text" v-model="button.button_target"
                                   class="form-control"
                                   id="button-target">
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="buttonAnimation">Button Animation</label>
                            <select class="form-control" v-model="button.button_animation" id="button-animation">
                                <option value="none">None</option>
                                <option value="small_shake">Small Shake</option>
                                <option value="medium_shake">Medium Shake</option>
                                <option value="large_shake">Large Shake</option>
                            </select>
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
                $('#button-bgcolor').on('colorpickerChange', function (event) {
                    button.button_bgcolor = event.color.toString();
                });
                $('#button-text-color').on('colorpickerChange', function (event) {
                    button.button_text_color = event.color.toString();
                });
            });
        </script>
@endsection
