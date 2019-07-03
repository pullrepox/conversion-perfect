<div style="margin-right: 20px;padding-top: 8px;" class="video-code-preview"
     v-if="model.content.video_code !== '' && model.content.video_type === 'other'" v-html="model.content.video_code"></div>

<div style="width: auto;margin-right: 20px;padding-top: 8px;"
     v-if="model.content.content_youtube_url !== '' && model.content.video_type === 'youtube'">
    <iframe width="280" height="158" allow="autoplay; fullscreen;" allowfullscreen style="border: 0"
            :src="`${model.content.content_youtube_url}?autoplay=${model.content.video_auto_play ? 1 : 0}`"></iframe>
</div>

<div style="width: auto;margin-right: 20px;padding-top: 8px;"
     v-if="model.content.content_vimeo_url !== '' && model.content.video_type === 'vimeo'">
    <iframe width="280" height="158" allow="autoplay; fullscreen;" allowfullscreen style="border: 0"
            :src="`${model.content.content_vimeo_url}?autoplay=${model.content.video_auto_play ? 1 : 0}`"></iframe>
</div>

<div style="margin-right: 20px;padding: 8px 0;"
     v-if="(model.content.video_code === '' && model.content.video_type === 'other')
     || (model.content.content_youtube_url === '' && model.content.video_type === 'youtube') || (model.content.content_vimeo_url === '' && model.content.video_type === 'vimeo')">
    <div style="width: 280px; height: 158px; background: #000000; display: flex; justify-content: center; align-items: center; font-size: 40px;">
        <i class="fas fa-play"></i>
    </div>
</div>
