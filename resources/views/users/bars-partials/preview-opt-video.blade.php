<div style="margin-right: 40px;padding-top: 8px;" class="video-code-preview"
     v-if="model.opt_in.opt_in_video_code !== '' && model.opt_in.opt_in_type === 'other'" v-html="model.opt_in.opt_in_video_code"></div>

<div style="width: auto;margin-right: 40px;padding-top: 8px;"
     v-if="model.opt_in.opt_in_youtube_url !== '' && model.opt_in.opt_in_type === 'vid-youtube'">
    <iframe width="304" height="176" allow="autoplay; fullscreen;" allowfullscreen style="border: 0"
            :src="`${model.opt_in.opt_in_youtube_url}?autoplay=${model.opt_in.opt_in_video_auto_play ? 1 : 0}`"></iframe>
</div>

<div style="width: auto;margin-right: 40px;padding-top: 8px;"
     v-if="model.opt_in.opt_in_vimeo_url !== '' && model.opt_in.opt_in_type === 'vid-vimeo'">
    <iframe width="304" height="176" allow="autoplay; fullscreen;" allowfullscreen style="border: 0"
            :src="`${model.opt_in.opt_in_vimeo_url}?autoplay=${model.opt_in.opt_in_video_auto_play ? 1 : 0}`"></iframe>
</div>

<div style="margin-right: 40px;padding: 8px 0;"
     v-if="(model.opt_in.opt_in_vimeo_url === '' && model.opt_in.opt_in_type === 'vid-vimeo')
     || (model.opt_in.opt_in_youtube_url === '' && model.opt_in.opt_in_type === 'vid-youtube') || (model.opt_in.opt_in_video_code === '' && model.opt_in.opt_in_type === 'other')">
    <div style="width: 304px; height: 176px; background: #000000; display: flex; justify-content: center; align-items: center; font-size: 40px;">
        <i class="fas fa-play"></i>
    </div>
</div>

<div style="width: auto;margin-right: 40px;padding-top: 8px;"
     v-if="model.opt_in.image_url !== '' && model.opt_in.opt_in_type === 'img-online'">
    <img style="width: 304px; height: 176px;border: 0;" alt="" :src="model.opt_in.image_url"/>
</div>

<div style="width: auto;margin-right: 40px;padding-top: 8px;"
     v-if="model.opt_in.image_upload !== '' && model.opt_in.opt_in_type === 'img-upload'">
    <img style="width: 304px; height: 176px;border: 0;" alt="" :src="model.opt_in.image_upload"/>
</div>

<div style="margin-right: 40px;padding: 8px 0;"
     v-if="(model.opt_in.image_upload === '' && model.opt_in.opt_in_type === 'img-upload') || (model.opt_in.image_url === '' && model.opt_in.opt_in_type === 'img-online')">
    <div style="width: 304px; height: 176px; background: #000000; display: flex; justify-content: center; align-items: center; font-size: 80px;">
        <i class="fas fa-image"></i>
    </div>
</div>
