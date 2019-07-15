<div style="margin-right: 40px;padding-top: 8px;" class="video-code-preview"
     v-if="model.lead_capture.opt_in_video_code !== '' && model.lead_capture.opt_in_type === 'other'" v-html="model.lead_capture.opt_in_video_code"></div>

<div style="width: auto;margin-right: 40px;padding-top: 8px;"
     v-if="model.lead_capture.opt_in_youtube_url !== '' && model.lead_capture.opt_in_type === 'vid-youtube'">
    <iframe width="304" height="176" allow="autoplay; fullscreen;" allowfullscreen style="border: 0"
            :src="`${model.lead_capture.opt_in_youtube_url}?autoplay=${model.lead_capture.opt_in_video_auto_play ? 1 : 0}`"></iframe>
</div>

<div style="width: auto;margin-right: 40px;padding-top: 8px;"
     v-if="model.lead_capture.opt_in_vimeo_url !== '' && model.lead_capture.opt_in_type === 'vid-vimeo'">
    <iframe width="304" height="176" allow="autoplay; fullscreen;" allowfullscreen style="border: 0"
            :src="`${model.lead_capture.opt_in_vimeo_url}?autoplay=${model.lead_capture.opt_in_video_auto_play ? 1 : 0}`"></iframe>
</div>

<div style="margin-right: 40px;padding: 8px 0;"
     v-if="(model.lead_capture.opt_in_vimeo_url === '' && model.lead_capture.opt_in_type === 'vid-vimeo')
     || (model.lead_capture.opt_in_youtube_url === '' && model.lead_capture.opt_in_type === 'vid-youtube') || (model.lead_capture.opt_in_video_code === '' && model.lead_capture.opt_in_type === 'other')">
    <div style="width: 304px; height: 176px; background: #000000; display: flex; justify-content: center; align-items: center; font-size: 40px;">
        <i class="ni ni-button-play"></i>
    </div>
</div>

<div style="width: auto;margin-right: 40px;padding-top: 8px;"
     v-if="model.lead_capture.image_url !== '' && model.lead_capture.opt_in_type === 'img-online'">
    <img style="width: auto; height: 176px;border: 0;" alt="" :src="model.lead_capture.image_url"/>
</div>

<div style="width: auto;margin-right: 40px;padding-top: 8px;"
     v-if="model.lead_capture.image_upload !== '' && model.lead_capture.opt_in_type === 'img-upload'">
    <img style="width: auto; height: 176px;border: 0;" alt="" :src="model.lead_capture.image_upload"/>
</div>

<div style="margin-right: 40px;padding: 8px 0;"
     v-if="(model.lead_capture.image_upload === '' && model.lead_capture.opt_in_type === 'img-upload') || (model.lead_capture.image_url === '' && model.lead_capture.opt_in_type === 'img-online')">
    <div style="width: 304px; height: 176px; background: #000000; display: flex; justify-content: center; align-items: center; font-size: 80px;">
        <i class="ni ni-image"></i>
    </div>
</div>
