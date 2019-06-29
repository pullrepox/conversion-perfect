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
            <div style="width:100%; font-size: 20px; font-family: 'Nunito', sans-serif; color: rgb(255, 255, 255); position: relative;min-height: 76px;"
                 :style="{
                 'background': (model.background_color.indexOf('#') > -1 ? model.background_color : `#${model.background_color}`),
                 'background-image': model.appearance.background_gradient ? (`linear-gradient(${model.appearance.gradient_angle}deg, ${(model.appearance.gradient_end_color.indexOf('#') > -1 ? model.appearance.gradient_end_color : `#${model.appearance.gradient_end_color}`)}, ${(model.background_color.indexOf('#') > -1 ? model.background_color : `#${model.background_color}`)})`) : 'none',
                 'opacity': (model.appearance.opacity / 100), 'box-shadow': (model.appearance.drop_shadow ? `0 10px 10px -10px #120f0f` : 'none')
                 }">
                <div v-if="model.appearance.close_button" style="position: absolute; top: -4px; right: 6px;font-size: 24px;"
                     :style="{ color: model.headline_color.indexOf('#') > -1 ? model.headline_color : `#${model.headline_color}` }">&times;
                </div>
                <div style="width:100%; font-size:20px; font-family: 'Nunito', sans-serif; display: flex; align-items: center; justify-content: center;min-height: 76px;">
                    <div style="display: inline-block; width: auto;margin-right: 20px;padding-top: 8px;"
                         v-if="model.content.video_code !== '' && model.content.video_type === 'other'" v-html="model.content.video_code"></div>
                    <div style="display: inline-block; width: auto;margin-right: 20px;padding-top: 8px;"
                         v-if="model.content.content_youtube_url !== '' && model.content.video_type === 'youtube'">
                        <iframe width="280" height="158" allow="autoplay; fullscreen;" allowfullscreen style="border: 0"
                                :src="`${model.content.content_youtube_url}?autoplay=${model.content.video_auto_play ? 1 : 0}`"></iframe>
                    </div>
                    <div style="display: inline-block; width: auto;margin-right: 20px;padding-top: 8px;"
                         v-if="model.content.content_vimeo_url !== '' && model.content.video_type === 'vimeo'">
                        <iframe width="280" height="158" allow="autoplay; fullscreen;" allowfullscreen style="border: 0"
                                :src="`${model.content.content_vimeo_url}?autoplay=${model.content.video_auto_play ? 1 : 0}`"></iframe>
                    </div>
                    <div
                        v-if="(model.button.button_type !== 'none' && model.button.button_location === 'left') || (model.countdown.countdown !== 'none' && model.countdown.countdown_location === 'left')"
                        style="display: inline-block; width:auto; margin-right: 20px;padding: 10px 0;text-align: center;">
                        <div v-if="model.button.button_type !== 'none' && model.button.button_location === 'left'"
                             style="width: 100%; min-width: 100%;">
                            <button type="button" style="border: 0;padding: 8px 12px;"
                                    :style="{
                                    'background-color': model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`,
                                    'color': model.button.button_text_color.indexOf('#') > -1 ? model.button.button_text_color : `#${model.button.button_text_color}`,
                                    'box-shadow': `0 3px 10px -4px ${model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`}`,
                                    'border-radius': model.button.button_type === 'rounded' ? '6px' : 0
                                    }">@{{ model.button.button_label }}
                            </button>
                        </div>
                        <div v-if="model.countdown.countdown !== 'none' && model.countdown.countdown_location === 'left'"
                             style="width:100%; height:40px; min-height:40px; margin-top:5px;">
                            <div style="height: 40px; width: 100%;">
                                <div style="height:20px; width:100%; text-align:center;"
                                     :style="{'color': model.countdown.countdown_text_color.indexOf('#') > -1 ? model.countdown.countdown_text_color : `#${model.countdown.countdown_text_color}`}">
                                    <div style="margin-left:5px; margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_days}`).slice(-2) : countdownCalculate() }}
                                    </div>
                                    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_hours}`).slice(-2) :
                                        ((`${model.countdown.countdown_end_time}`).split(':'))[0] }}
                                    </div>
                                    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_minutes}`).slice(-2) :
                                        ((`${model.countdown.countdown_end_time}`).split(':'))[1] }}
                                    </div>
                                    <div style="float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        @{{ (`0${(new Date().getUTCSeconds())}`).slice(-2) }}
                                    </div>
                                </div>
                                <div style="height:20px; width:100%; text-align:center;"
                                     :style="{'color': model.countdown.countdown_text_color.indexOf('#') > -1 ? model.countdown.countdown_text_color : `#${model.countdown.countdown_text_color}`}">
                                    <div style="margin-left:5px; margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        DAYS
                                    </div>
                                    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        HOURS
                                    </div>
                                    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        MINS
                                    </div>
                                    <div style="float:left; padding:0; height:20px; width:50px; font-size:10px;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        SECS
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display:inline-block; vertical-align:top; width:auto; text-align:center;">
                        <div style="display:inline-block; width:auto;">
                            <div :style="{ color: model.headline_color.indexOf('#') > -1 ? model.headline_color : `#${model.headline_color}` }"
                                 style="width: 100%; min-width: 100%; margin:0 auto; font-size: 1.8rem;">
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
                                'background': model.content.sub_background_color !== '' ? (model.content.sub_background_color.indexOf('#') > -1 ? model.content.sub_background_color : `#${model.content.sub_background_color}`) : 'transparent'
                                }"
                                 style="width: 100%; min-width: 100%; margin: 0 0 5px auto; font-size: 18px;"
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
                            <div
                                v-if="(model.button.button_type !== 'none' && model.button.button_location === 'below_text') || (model.countdown.countdown !== 'none' && model.countdown.countdown_location === 'below_text')"
                                style="width: 100%; min-width: 100%; margin: 0 0 5px auto; text-align: center;">
                                <div v-if="model.button.button_type !== 'none' && model.button.button_location === 'below_text'"
                                     style="width: 100%; min-width: 100%;">
                                    <button type="button" style="border: 0;padding: 8px 12px;"
                                            :style="{
                                    'background-color': model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`,
                                    'color': model.button.button_text_color.indexOf('#') > -1 ? model.button.button_text_color : `#${model.button.button_text_color}`,
                                    'box-shadow': `0 3px 10px -4px ${model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`}`,
                                    'border-radius': model.button.button_type === 'rounded' ? '6px' : 0
                                    }">@{{ model.button.button_label }}
                                    </button>
                                </div>
                                <div v-if="model.countdown.countdown !== 'none' && model.countdown.countdown_location === 'below_text'"
                                     style="width:100%; height:40px; min-height:40px; margin-top:5px;display: flex;justify-content: center;">
                                    <div style="height: 40px; width: auto;">
                                        <div style="height:20px; width:100%; text-align:center;"
                                             :style="{'color': model.countdown.countdown_text_color.indexOf('#') > -1 ? model.countdown.countdown_text_color : `#${model.countdown.countdown_text_color}`}">
                                            <div style="margin-left:5px; margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                                                 :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                                @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_days}`).slice(-2) : countdownCalculate() }}
                                            </div>
                                            <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                                                 :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                                @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_hours}`).slice(-2) :
                                                ((`${model.countdown.countdown_end_time}`).split(':'))[0] }}
                                            </div>
                                            <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                                                 :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                                @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_minutes}`).slice(-2) :
                                                ((`${model.countdown.countdown_end_time}`).split(':'))[1] }}
                                            </div>
                                            <div style="float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                                                 :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                                @{{ (`0${(new Date().getUTCSeconds())}`).slice(-2) }}
                                            </div>
                                        </div>
                                        <div style="height:20px; width:100%; text-align:center;"
                                             :style="{'color': model.countdown.countdown_text_color.indexOf('#') > -1 ? model.countdown.countdown_text_color : `#${model.countdown.countdown_text_color}`}">
                                            <div style="margin-left:5px; margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
                                                 :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                                DAYS
                                            </div>
                                            <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
                                                 :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                                HOURS
                                            </div>
                                            <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
                                                 :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                                MINS
                                            </div>
                                            <div style="float:left; padding:0; height:20px; width:50px; font-size:10px;"
                                                 :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                                SECS
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        v-if="(model.button.button_type !== 'none' && model.button.button_location === 'right') || (model.countdown.countdown !== 'none' && model.countdown.countdown_location === 'right')"
                        style="display: inline-block; width:auto; margin-left: 20px;padding: 10px 0;text-align: center;">
                        <div v-if="model.button.button_type !== 'none' && model.button.button_location === 'right'"
                             style="width: 100%; min-width: 100%;">
                            <button type="button" style="border: 0;padding: 8px 12px;"
                                    :style="{
                                    'background-color': model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`,
                                    'color': model.button.button_text_color.indexOf('#') > -1 ? model.button.button_text_color : `#${model.button.button_text_color}`,
                                    'box-shadow': `0 3px 10px -4px ${model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`}`,
                                    'border-radius': model.button.button_type === 'rounded' ? '6px' : 0
                                    }">@{{ model.button.button_label }}
                            </button>
                        </div>
                        <div v-if="model.countdown.countdown !== 'none' && model.countdown.countdown_location === 'right'"
                             style="width:100%; height:40px; min-height:40px; margin-top:5px;">
                            <div style="height: 40px; width: 100%;">
                                <div style="height:20px; width:100%; text-align:center;"
                                     :style="{'color': model.countdown.countdown_text_color.indexOf('#') > -1 ? model.countdown.countdown_text_color : `#${model.countdown.countdown_text_color}`}">
                                    <div style="margin-left:5px; margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_days}`).slice(-2) : countdownCalculate() }}
                                    </div>
                                    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_hours}`).slice(-2) :
                                        ((`${model.countdown.countdown_end_time}`).split(':'))[0] }}
                                    </div>
                                    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_minutes}`).slice(-2) :
                                        ((`${model.countdown.countdown_end_time}`).split(':'))[1] }}
                                    </div>
                                    <div style="float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        @{{ (`0${(new Date().getUTCSeconds())}`).slice(-2) }}
                                    </div>
                                </div>
                                <div style="height:20px; width:100%; text-align:center;"
                                     :style="{'color': model.countdown.countdown_text_color.indexOf('#') > -1 ? model.countdown.countdown_text_color : `#${model.countdown.countdown_text_color}`}">
                                    <div style="margin-left:5px; margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        DAYS
                                    </div>
                                    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        HOURS
                                    </div>
                                    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        MINS
                                    </div>
                                    <div style="float:left; padding:0; height:20px; width:50px; font-size:10px;"
                                         :style="{'background-color': model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`}">
                                        SECS
                                    </div>
                                </div>
                            </div>
                        </div>
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
