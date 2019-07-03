<div style="height: 230px; width: 100%; font-size: 20px; font-family: 'Nunito', sans-serif; text-align: center;position: relative;"
     :style="{
     'background': model.opt_in.panel_color === '' ? 'transparent' : (model.opt_in.panel_color.indexOf('#') > -1 ? model.opt_in.panel_color : `#${model.opt_in.panel_color}`),
     'color': (model.opt_in.subscribe_text_color.indexOf('#') > -1 ? model.opt_in.subscribe_text_color : `#${model.opt_in.subscribe_text_color}`)
     }">
    <div v-if="!model.appearance.close_button" style="position: absolute; top: -4px; right: 6px;font-size: 24px;z-index: 9999;"
         :style="{ color: model.headline_color.indexOf('#') > -1 ? model.headline_color : `#${model.headline_color}` }">&times;
    </div>
    <div style="height: 45px; width: 100%; font-size: 20px;line-height: 45px;"
         :style="{
         'background': (model.background_color.indexOf('#') > -1 ? model.background_color : `#${model.background_color}`),
         color: model.headline_color.indexOf('#') > -1 ? model.headline_color : `#${model.headline_color}`
         }">
        <span v-for="(cta, c_t_i) in model.opt_in.call_to_action" :key="`cta_preview_attr_${c_t_i}`" v-if="cta.insert.trim() != ''">
            <span v-if="cta.attributes" :style="{
                'font-weight': cta.attributes.bold ? 'bold' : 'normal',
                'font-style': cta.attributes.italic ? 'italic' : 'normal',
                'text-decoration': cta.attributes.underline && cta.attributes.strike ? 'underline line-through' : (cta.attributes.underline && !cta.attributes.strike ? 'underline' : (!cta.attributes.underline && cta.attributes.strike ? 'line-through' : 'none'))
                }">
                @{{ cta.insert }}
            </span>
            <span v-else>
                @{{ cta.insert }}
            </span>
        </span>
    </div>
    <div style="margin-top: 10px; width: 100%; height: 30px; font-size: 17px;"
         :style="{'color': (model.opt_in.subscribe_text_color.indexOf('#') > -1 ? model.opt_in.subscribe_text_color : `#${model.opt_in.subscribe_text_color}`)}">
        <span v-for="(st, s_t_i) in model.opt_in.subscribe_text" :key="`st_preview_attr_${s_t_i}`" v-if="st.insert.trim() != ''">
            <span v-if="st.attributes" :style="{
                'font-weight': st.attributes.bold ? 'bold' : 'normal',
                'font-style': st.attributes.italic ? 'italic' : 'normal',
                'text-decoration': st.attributes.underline && st.attributes.strike ? 'underline line-through' : (st.attributes.underline && !st.attributes.strike ? 'underline' : (!st.attributes.underline && st.attributes.strike ? 'line-through' : 'none'))
                }">
                @{{ st.insert }}
            </span>
            <span v-else>
                @{{ st.insert }}
            </span>
        </span>
    </div>
    <div style="width: 100%; margin-top: 5px;">
        <input type="text"
               style="width: 250px; display: inline-block; padding: .625rem .75rem; font-weight: 400; line-height: 1.5; color: #8898aa; background-clip: padding-box; border: 1px solid #dee2e6; border-radius: .25rem; margin-right: 5px; background-color: #ffffff; font-size: 0.875rem; transition: all .15s ease-in-out; height: calc(1.5em + 1.25rem + 5px);"
               placeholder="Your Name"/>
        <input type="email"
               style="width: 250px; display: inline-block; padding: .625rem .75rem; font-weight: 400; line-height: 1.5; color: #8898aa; background-clip: padding-box; border: 1px solid #dee2e6; border-radius: .25rem; margin-left: 5px; background-color: #ffffff; font-size: 0.875rem; transition: all .15s ease-in-out; height: calc(1.5em + 1.25rem + 5px);"
               placeholder="youremail@domain.com"/>
    </div>
    <button type="button" v-if="model.opt_in.opt_in_button_type === 'match_main_button'"
            style="width: 514px; padding: .625rem .75rem; margin-top: 15px; line-height: 1.5; border: none; text-decoration: none; font-size: 0.875rem; white-space: nowrap; height: calc(1.5em + 1.25rem + 5px);"
            :style="{
            'background-color': model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`,
            'color': model.button.button_text_color.indexOf('#') > -1 ? model.button.button_text_color : `#${model.button.button_text_color}`,
            'box-shadow': `0 3px 10px -4px ${model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`}`,
            'border-radius': model.button.button_type === 'rounded' ? '6px' : 0
            }">
        @{{ model.opt_in.opt_in_button_label }}
    </button>
    <button type="button" v-else
            style="width: 514px; padding: .625rem .75rem; margin-top: 15px; line-height: 1.5; border: none; text-decoration: none; font-size: 0.875rem; white-space: nowrap; height: calc(1.5em + 1.25rem + 5px);"
            :style="{
            'background-color': model.opt_in.opt_in_button_bg_color.indexOf('#') > -1 ? model.opt_in.opt_in_button_bg_color : `#${model.opt_in.opt_in_button_bg_color}`,
            'color': model.opt_in.opt_in_button_label_color.indexOf('#') > -1 ? model.opt_in.opt_in_button_label_color : `#${model.opt_in.opt_in_button_label_color}`,
            'box-shadow': `0 3px 10px -4px ${model.opt_in.opt_in_button_bg_color.indexOf('#') > -1 ? model.opt_in.opt_in_button_bg_color : `#${model.opt_in.opt_in_button_bg_color}`}`,
            'border-radius': model.opt_in.opt_in_button_type === 'rounded' ? '6px' : 0
            }">
        @{{ model.opt_in.opt_in_button_label }}
    </button>
</div>
