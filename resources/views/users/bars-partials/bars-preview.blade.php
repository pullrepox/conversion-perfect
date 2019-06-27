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
                 :style="{'background': model.background_color.indexOf('#') > -1 ? model.background_color : `#${model.background_color}`}">
                <div style="width:100%; font-size:20px; font-family: 'Nunito', sans-serif; display: flex; align-items: center; justify-content: center;">
                    <div style="display: inline-block; width: auto;"
                         v-if="model.content.image_url !== '' && model.content.media === 'online_image' && model.content.media_location === 'left'">
                        <img :src="model.content.image_url" style="max-width: 300px;" alt=""/>
                    </div>
                    <div style="display: inline-block; width: auto;margin-right: 20px;padding-top: 8px;"
                         v-if="model.content.video_url !== '' && model.content.media === 'video' && model.content.media_location === 'left'">
                        <iframe style="border: 0;max-width: 300px;" :src="`${model.content.video_url}?autoplay=${model.content.video_auto_play ? 1 : 0}`"></iframe>
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
                            <div style="width: 100%;"
                                 v-if="model.content.image_url !== '' && model.content.media === 'online_image' && model.content.media_location === 'below_text'">
                                <img :src="model.content.image_url" style="max-width: 300px;" alt=""/>
                            </div>
                            <div style="display: inline-block; width: auto;padding-top: 8px;"
                                 v-if="model.content.video_url !== '' && model.content.media === 'video' && model.content.media_location === 'below_text'">
                                <iframe style="border: 0;max-width: 300px;" :src="`${model.content.video_url}?autoplay=${model.content.video_auto_play ? 1 : 0}`"></iframe>
                            </div>
                        </div>
                    </div>
                    <div style="display: inline-block; width: auto;"
                         v-if="model.content.image_url !== '' && model.content.media === 'online_image' && model.content.media_location === 'right'">
                        <img :src="model.content.image_url" style="max-width: 300px;" alt=""/>
                    </div>
                    <div style="display: inline-block; width: auto;margin-left: 20px;padding-top: 8px;"
                         v-if="model.content.video_url !== '' && model.content.media === 'video' && model.content.media_location === 'right'">
                        <iframe style="border: 0;max-width: 300px;" :src="`${model.content.video_url}?autoplay=${model.content.video_auto_play ? 1 : 0}`"></iframe>
                    </div>
                </div>
                <div
                    style="font-size: 12px; line-height: 20px; font-family: Arial, 'Arial Narrow', sans-serif; padding-right: 5px;position: absolute;bottom: 0;right: 0;width: auto;z-index: 100;"
                    :style="{ color: model.headline_color.indexOf('#') > -1 ? model.headline_color : `#${model.headline_color}` }">
                    POWERED BY <a style="color:inherit; text-decoration:inherit;text-transform: uppercase;" href="//app.conversionperfect.com" target="_BLANK">{{ config('app.name') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
