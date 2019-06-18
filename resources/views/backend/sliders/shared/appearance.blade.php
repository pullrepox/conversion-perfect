<div class="row mt-3">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Appearance
            </div>
            <input name="type" type="hidden" value="appearance" />
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="sliderName">Slider Name</label>
                            <input type="text" name="slider_name" class="form-control" value="{{$isEdit?$slider->name:''}}" id="slider-name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input v-model="heading" type="text" name="heading" class="form-control" id="heading">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subHeading">Sub Heading</label>
                            <input type="text" v-model="sub_heading" name="sub_heading" class="form-control" id="sub-heading">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="textColor">Heading Color</label>
                            <input type="text" v-model="heading_color" name="appearance[heading_color]" headingclass="form-control" id="heading-color">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Sub Heading Color</label>
                            <input type="text" v-model="sub_heading_color"  name="appearance[subheading_color]" class="form-control" id="sub-heading-color">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Background Color Start</label>
                            <input v-model="bg_color_start" type="text"  name="appearance[bgcolor_start]" class="form-control" id="bg-color-start">
                        </div>
                    </div>
                    <div class="col-md-3" v-if="show_bg_color_end_container">
                        <div class="form-group">
                            <label for="subColor">Background Color End</label>
                            <input type="text" value="#ffffff"  name="appearance[bgcolor_end]" class="form-control" id="bg-color-end" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Background Gradient</label>
                            <select id="disabledSelect" v-model="bg_gradient" name="appearance[bgcolor_gradient]" class="form-control">
                                <option value="true">Yes</option>
                                <option value="false">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" v-if="show_bg_color_end_container">
                        <div class="form-group">
                            <label for="subColor">Background Gradient Angle</label>
                            <input type="number" name="appearance[bgcolor_gradient_angle]" class="form-control" id="sub-color" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Opacity (@{{ opacity }})</label>
                            <input v-model="opacity" type="range" name="appearance[opacity]" class="custom-range" min="0" max="1" step="0.1" id="customRange3">
                            <div class="d-flex justify-content-between bd-highlight mb-3">
                                <div class="p-2 bd-highlight">0</div>
                                <div class="p-2 bd-highlight">1</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Video Code</label>
                            <input type="text" v-model="video_code" name="appearance[video_code]" class="form-control" id="video-code" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="dropShadow">Drop Shadow</label>
                        <div class="form-group">
                            <label class="custom-toggle mt-2">
                                <input type="checkbox" name="appearance[drop_shadow]" checked="">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subColor">Video Autoplay</label>
                            <div class="form-group">
                                <label class="custom-toggle mt-2">
                                    <input type="checkbox" name="appearance[video_autoplay]" checked="">
                                    <span class="custom-toggle-slider rounded-circle"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="subColor">Description</label>
                            <input v-model="description" type="text" name="appearance[description]" class="form-control" id="description" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
               <input type="submit" name="save" class="btn btn-primary" value="Save" />
               <input type="submit" name="save_next" class="btn btn-primary" value="Save & Next" />
               <input type="submit" name="cancel" class="btn btn-primary" value="Cancel" />
            </div>
        </div>
    </div>

</div>
