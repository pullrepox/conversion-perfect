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
    <div class="card-body">
        <div class="w-100 h-100">
            <div style="width:100%; font-size: 20px; font-family: 'Nunito', sans-serif; color: rgb(255, 255, 255); text-align: right;position: relative;"
                 :style="{
                 'background': (model.background_color.indexOf('#') > -1 ? model.background_color : `#${model.background_color}`),
                 'background-image': model.appearance.background_gradient ? (`linear-gradient(${model.appearance.gradient_angle}deg, ${(model.appearance.gradient_end_color.indexOf('#') > -1 ? model.appearance.gradient_end_color : `#${model.appearance.gradient_end_color}`)}, ${(model.background_color.indexOf('#') > -1 ? model.background_color : `#${model.background_color}`)})`) : 'none',
                 'opacity': (model.appearance.opacity / 100), 'box-shadow': (model.appearance.drop_shadow ? `0 10px 10px -10px #120f0f` : 'none')
                 }">
                <div v-if="model.appearance.close_button" style="position: absolute; top: -4px; right: 6px;font-size: 24px;"
                     :style="{ color: model.headline_color.indexOf('#') > -1 ? model.headline_color : `#${model.headline_color}` }">&times;
                </div>
                <div style="width:100%; font-size:20px; font-family: 'Nunito', sans-serif; display: flex; align-items: center; justify-content: center;">
                    <div style="display: inline-block; width: auto;margin-right: 20px;padding-top: 8px;"
                         v-if="model.content.video_code !== '' && model.content.video" v-html="model.content.video_code"></div>
                    <div v-if="model.button.button_type !== 'none' && model.button.button_location === 'left'"
                         style="display:inline-block; width:auto; margin-right: 20px;">
                        <button type="button" style="border: 0;padding: 2px 12px;"
                                :style="{
                                'background-color': model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`,
                                'color': model.button.button_text_color.indexOf('#') > -1 ? model.button.button_text_color : `#${model.button.button_text_color}`,
                                'box-shadow': `0 3px 10px -4px ${model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`}`,
                                'border-radius': model.button.button_type === 'rounded' ? '6px' : 0
                                }">@{{ model.button.button_label }}</button>
                    </div>
                    <div style="display:inline-block; vertical-align:top; width:auto; text-align:center;">
                        <div style="display:inline-block; width:auto;">
                            <div :style="{ color: model.headline_color.indexOf('#') > -1 ? model.headline_color : `#${model.headline_color}` }"
                                 style="width: 100%; min-width: 100%; line-height: 76px; margin:0 auto; font-size: 1.8rem;">
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
                            <div :style="{
                                color: model.content.sub_headline_color.indexOf('#') > -1 ? model.content.sub_headline_color : `#${model.content.sub_headline_color}`,
                                'background': model.content.sub_background_color.indexOf('#') > -1 ? model.content.sub_background_color : `#${model.content.sub_background_color}`}"
                                 style="width: 100%; min-width: 100%; margin: 0 auto; font-size: 16px; padding: 5px;line-height: 26px;margin-bottom: 15px;"
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
                            <div v-if="model.button.button_type !== 'none' && model.button.button_location === 'below_text'"
                                 style="width: 100%;min-width: 100%; margin: 0 auto;margin-bottom: 15px;">
                                <button type="button" style="border: 0;padding: 2px 12px;"
                                        :style="{
                                'background-color': model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`,
                                'color': model.button.button_text_color.indexOf('#') > -1 ? model.button.button_text_color : `#${model.button.button_text_color}`,
                                'box-shadow': `0 3px 10px -4px ${model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`}`,
                                'border-radius': model.button.button_type === 'rounded' ? '6px' : 0
                                }">@{{ model.button.button_label }}</button>
                            </div>
                        </div>
                    </div>
                    <div v-if="model.button.button_type !== 'none' && model.button.button_location === 'right'"
                         style="display:inline-block; width:auto; margin-left: 20px;">
                        <button type="button" style="border: 0;padding: 2px 12px;"
                                :style="{
                                'background-color': model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`,
                                'color': model.button.button_text_color.indexOf('#') > -1 ? model.button.button_text_color : `#${model.button.button_text_color}`,
                                'box-shadow': `0 3px 10px -4px ${model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`}`,
                                'border-radius': model.button.button_type === 'rounded' ? '6px' : 0
                                }">@{{ model.button.button_label }}</button>
                    </div>
                </div>
                <div v-if="model.appearance.powered_by_position !== 'hidden'"
                     style="font-size: 12px; line-height: 20px; font-family: 'Arial Narrow', sans-serif; padding-right: 5px;position: absolute;width: auto;z-index: 100;"
                     :style="{
                    color: model.headline_color.indexOf('#') > -1 ? model.headline_color : `#${model.headline_color}`,
                    bottom: (model.appearance.powered_by_position === 'bottom_right' || model.appearance.powered_by_position === 'bottom_left') ? 0 : 'auto',
                    right: model.appearance.powered_by_position === 'bottom_right' ? 0 : 'auto',
                    top: model.appearance.powered_by_position === 'top_left' ? '1px' : 'auto',
                    left: (model.appearance.powered_by_position === 'top_left' || model.appearance.powered_by_position === 'bottom_left') ? '5px' : 'auto'
                    }">
                    POWERED BY <a style="color:inherit; text-decoration:inherit;text-transform: uppercase;" href="//app.conversionperfect.com" target="_BLANK">{{ config('app.name') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
