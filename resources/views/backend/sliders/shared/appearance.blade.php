<div class="row mt-3">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Appearance
            </div>
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="barName">Headline</label>
                                <input v-model="headline" type="text" class="form-control" id="headline">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="barName">Sub Headline</label>
                                <input type="text" v-model="sub_headline" class="form-control" id="sub-headline">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="textColor">Headline Color</label>
                                <input type="text" v-model="headline_color" class="form-control" id="headline-color">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="subColor">Sub Headline Color</label>
                                <input type="text" v-model="sub_headline_color" class="form-control" id="sub-headline-color">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="subColor">Background Color Start</label>
                                <input v-model="bg_color_start" type="text" class="form-control" id="bg-color-start">
                            </div>
                        </div>
                        <div class="col-md-3" v-if="show_bg_color_end_container">
                            <div class="form-group">
                                <label for="subColor">Background Color End</label>
                                <input type="text" value="#ffffff" class="form-control" id="bg-color-end" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="subColor">Background Gradient</label>
                                <select id="disabledSelect" v-model="bg_gradient" class="form-control">
                                    <option value="true">Yes</option>
                                    <option value="false">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3" v-if="show_bg_color_end_container">
                            <div class="form-group">
                                <label for="subColor">Background Gradient Angle</label>
                                <input type="number" class="form-control" id="sub-color" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="subColor">Opacity (@{{ opacity }})</label>
                                <input v-model="opacity" type="range" class="custom-range" min="0" max="1" step="0.1" id="customRange3">
                                <div class="d-flex justify-content-between bd-highlight mb-3">
                                    <div class="p-2 bd-highlight">0</div>
                                    <div class="p-2 bd-highlight">1</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="subColor">Video Code</label>
                                <input type="text" class="form-control" id="sub-color" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="dropShadow">Drop Shadow</label>
                            <div class="form-group">
                                <label class="custom-toggle mt-2">
                                    <input type="checkbox" checked="">
                                    <span class="custom-toggle-slider rounded-circle"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="subColor">Video Autoplay</label>
                                <div class="form-group">
                                    <label class="custom-toggle mt-2">
                                        <input type="checkbox" checked="">
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="subColor">Description</label>
                                <input v-model="description" type="text" class="form-control" id="description" placeholder="">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
