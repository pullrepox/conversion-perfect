<div id="bar-preview-section" style="width:100%; font-size: 20px; font-family: 'Nunito', sans-serif; color: rgb(255, 255, 255); position: relative;min-height: 76px;"
     :style="{
     'background': model.appearance.background_gradient ? 'none' : (model.background_color.indexOf('#') > -1 ? model.background_color : `#${model.background_color}`),
     'background-image': model.appearance.background_gradient ? (`linear-gradient(${model.appearance.gradient_angle}deg, ${(model.background_color.indexOf('#') > -1 ? model.background_color : `#${model.background_color}`)}, ${(model.appearance.gradient_end_color.indexOf('#') > -1 ? model.appearance.gradient_end_color : `#${model.appearance.gradient_end_color}`)})`) : 'none',
     'opacity': (model.appearance.opacity / 100), 'box-shadow': (model.appearance.drop_shadow ? `0 10px 10px -10px #120f0f` : 'none')
     }">
    <div v-if="!model.appearance.close_button" style="position: absolute; top: -4px; right: 6px;font-size: 24px;z-index: 9999;"
         :style="{ color: model.headline_color.indexOf('#') > -1 ? model.headline_color : `#${model.headline_color}` }">&times;
    </div>
    <div v-if="model.timer.countdown !== 'none' && model.timer.countdown_location === 'left_edge'"
         style="width: auto; height: 100%; min-height: 40px; top: 0; left: 0; position: absolute;">
        <div style="width: auto;min-height: 40px;height: 100%;display: flex;align-items: center;justify-content: left;"
             :style="{'background-color': model.timer.countdown_background_color !== '' ? (model.timer.countdown_background_color.indexOf('#') > -1 ? model.timer.countdown_background_color : `#${model.timer.countdown_background_color}`) : 'transparent'}">
            <div style="width: 100%">
                @include('users.bars-partials.countdown-edge-top')
                @include('users.bars-partials.countdown-edge-bottom')
            </div>
        </div>
    </div>
    <div style="width: 100%; font-size: 20px; font-family: 'Nunito', sans-serif; display: flex; align-items: center; justify-content: center;min-height: 76px;">
        <div style="margin-right: 20px;padding: 8px 0;" v-if="model.content.video_type !== 'none'">
            <div style="width: 280px; height: 158px; background: #000000; display: flex; justify-content: center; align-items: center; font-size: 40px;">
                <i class="ni ni-button-play"></i>
            </div>
        </div>
        <div
            v-if="(model.content.button_type !== 'none' && model.content.button_location === 'left') || (model.timer.countdown !== 'none' && model.timer.countdown_location === 'left')"
            style="display: inline-block; width:auto; margin-right: 20px;padding: 10px 0;text-align: center;">
            <div v-if="model.content.button_type !== 'none' && model.content.button_location === 'left'"
                 style="width: 100%; min-width: 100%;">
                @include('users.bars-partials.preview-button')
            </div>
            <div v-if="model.timer.countdown !== 'none' && model.timer.countdown_location === 'left'"
                 style="width:100%; height:40px; min-height:40px; margin-top:5px;">
                <div style="height: 40px; width: 100%;">
                    @include('users.bars-partials.countdown-top')
                    @include('users.bars-partials.countdown-bottom')
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
                    v-if="(model.content.button_type !== 'none' && model.content.button_location === 'below_text') || (model.timer.countdown !== 'none' && model.timer.countdown_location === 'below_text')"
                    style="width: 100%; min-width: 100%; margin: 0 0 5px auto; text-align: center;">
                    <div v-if="model.content.button_type !== 'none' && model.content.button_location === 'below_text'"
                         style="width: 100%; min-width: 100%;">
                        @include('users.bars-partials.preview-button')
                    </div>
                    <div v-if="model.timer.countdown !== 'none' && model.timer.countdown_location === 'below_text'"
                         style="width:100%; height:40px; min-height:40px; margin-top:5px;display: flex;justify-content: center;">
                        <div style="height: 40px; width: auto;">
                            @include('users.bars-partials.countdown-top')
                            @include('users.bars-partials.countdown-bottom')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-if="(model.content.button_type !== 'none' && model.content.button_location === 'right') || (model.timer.countdown !== 'none' && model.timer.countdown_location === 'right')"
            style="display: inline-block; width:auto; margin-left: 20px;padding: 10px 0;text-align: center;">
            <div v-if="model.content.button_type !== 'none' && model.content.button_location === 'right'"
                 style="width: 100%; min-width: 100%;">
                @include('users.bars-partials.preview-button')
            </div>
            <div v-if="model.timer.countdown !== 'none' && model.timer.countdown_location === 'right'"
                 style="width:100%; height:40px; min-height:40px; margin-top:5px;">
                <div style="height: 40px; width: 100%;">
                    @include('users.bars-partials.countdown-top')
                    @include('users.bars-partials.countdown-bottom')
                </div>
            </div>
        </div>
    </div>
    <div v-if="model.timer.countdown !== 'none' && model.timer.countdown_location === 'right_edge'"
         style="width:auto; height:100%; min-height:40px; top: 0; right: 0; position: absolute;">
        <div style="width: auto;min-height: 40px;height: 100%;display: flex;align-items: center;justify-content: left;"
             :style="{'background-color': model.timer.countdown_background_color !== '' ? (model.timer.countdown_background_color.indexOf('#') > -1 ? model.timer.countdown_background_color : `#${model.timer.countdown_background_color}`) : 'transparent'}">
            <div style="width: 100%">
                @include('users.bars-partials.countdown-edge-top')
                @include('users.bars-partials.countdown-edge-bottom')
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
        <a style="color:inherit; text-decoration:inherit; text-transform: uppercase;" href="{{ config('site.home_url') }}" target="_blank">
            @{{ model.translation.powered_by_label }} {{ config('app.name') }}
        </a>
    </div>
</div>
