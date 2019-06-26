<div class="card mt--3" v-if="bar_option.preview">
    <div class="card-header pt-2 pb-2 division-card-header">
        <div class="form-row">
            <h3 class="mb-0 col card-title">Preview</h3>
            <div class="col text-right" v-if="!create_edit">
                <button type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal"
                        @click="toggleOption('preview')">
                    Hide
                </button>
                <input type="hidden" name="opt_preview" v-model="bar_option.preview"/>
            </div>
        </div>
    </div>
    <div class="card-body" :class="{'pb-0': model.position === 'top'}">
        <div id="preview_bar" class="w-100 h-100">
            <div class="w-100 mt--4" v-if="model.position === 'bottom'">
                <img src="{{asset('assets/img/mockup.gif')}}" alt="" class="img-fluid w-100">
            </div>
            <div style="height: 170px; font-size: 20px; font-family: 'Nunito', sans-serif; color: rgb(255, 255, 255); text-align: right;" class="w-100"
                 :style="{'background': model.background_color}">
                <div id="preview_banner" style="height:155px; width:100%; font-size:20px; font-family: 'Nunito', sans-serif; text-align:center; vertical-align:middle; position:relative">
                    <div style="width:auto; min-width:60%; height:170px; text-align:center;">
                        <div style="width:auto; height:auto;">
                            <div :style="{ color: model.headline_color }" style="width:100%; min-width:100%; margin:0 auto; padding-top:15px;font-size: 1.8rem;">
                                <span v-for="(h_l, h_i) in model.headline" :key="`hLine_attr_${h_i}`" v-if="h_l.insert.trim() != ''">
                                    <span v-if="h_l.attributes" :style="{
                                        'font-weight': h_l.attributes.bold ? 'bold' : 'normal',
                                        'font-style': h_l.attributes.italic ? 'italic' : 'normal',
                                        'text-decoration': h_l.attributes.underline && h_l.attributes.strike ? 'underline line-through' : (h_l.attributes.underline && !h_l.attributes.strike ? 'underline' : (!h_l.attributes.underline && h_l.attributes.strike ? 'line-through' : 'none'))
                                        }">
                                        @{{ h_l.insert }}
                                    </span>
                                    <span v-else>
                                        @{{ h_l.insert }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100" v-if="model.position === 'top'">
                <img src="{{asset('assets/img/mockup.gif')}}" alt="" class="img-fluid w-100">
            </div>
        </div>
    </div>
</div>
