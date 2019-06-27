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
        <div class="w-100 h-100">
            <div class="w-100 mt--4" v-if="model.position === 'bottom'">
                <img src="{{asset('assets/img/mockup.gif')}}" alt="" class="img-fluid w-100">
            </div>
            <div style="width:100%; min-height: 150px; font-size: 20px; font-family: 'Nunito', sans-serif; color: rgb(255, 255, 255); text-align: right;position: relative;"
                 :style="{'background': model.background_color}">
                <div style="min-height:138px; width:100%; font-size:20px; font-family: 'Nunito', sans-serif; display: flex; align-items: center; justify-content: center;">
                    <div style="display:inline-block; vertical-align:top; width:auto; min-width:60%; min-height:150px; text-align:center;">
                        <div style="display:inline-block; width:auto; min-height: 150px;">
                            <div :style="{ color: model.headline_color }" style="width: 100%; min-width: 100%; line-height: 60px; margin:0 auto; font-size: 1.6rem;padding-top: 15px;">
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
                            <div :style="{ color: model.content.sub_headline_color, 'background': model.content.sub_background_color }"
                                 style="width: 100%; min-width: 100%; margin: 0 auto; font-size: 16px; padding: 5px;"
                                 v-if="model.content.sub_headline[0].insert.trim() != ''">
                                <span v-for="(s_h_l, s_h_i) in model.content.sub_headline" :key="`s_hLine_attr_${s_h_i}`" v-if="s_h_l.insert.trim() != ''">
                                    <span v-if="s_h_l.attributes" :style="{
                                        'font-weight': s_h_l.attributes.bold ? 'bold' : 'normal',
                                        'font-style': s_h_l.attributes.italic ? 'italic' : 'normal',
                                        'text-decoration': s_h_l.attributes.underline && s_h_l.attributes.strike ? 'underline line-through' : (s_h_l.attributes.underline && !s_h_l.attributes.strike ? 'underline' : (!s_h_l.attributes.underline && s_h_l.attributes.strike ? 'line-through' : 'none'))
                                        }">
                                        @{{ s_h_l.insert }}
                                    </span>
                                    <span v-else>
                                        @{{ s_h_l.insert }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="font-size: 12px; line-height: 20px; font-family: Oswald; padding-right: 5px;position: absolute;bottom: 0;right: 0;width: auto;z-index: 100;"
                     :style="{ color: model.headline_color }">
                    POWERED BY <a style="color:inherit; text-decoration:inherit;text-transform: uppercase;" href="//app.conversionperfect.com" target="_BLANK">{{ config('app.name') }}</a>
                </div>
            </div>
            <div class="w-100" v-if="model.position === 'top'">
                <img src="{{asset('assets/img/mockup.gif')}}" alt="" class="img-fluid w-100">
            </div>
        </div>
    </div>
</div>
