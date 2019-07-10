<style type="text/css">
    .video-code-preview iframe {
        width: 280px !important;
        height: 158px !important;
    }
</style>

@if ($bar->video_type == 'other' && $bar->video_code != '')
    <div style="margin-right: 20px;padding-top: 8px;" class="video-code-preview">
        {!! htmlspecialchars_decode(stripslashes($bar->video_code)) !!}
    </div>
@endif

@if ($bar->video_type == 'youtube' && $bar->content_youtube_url != '')
    <div style="width: auto;margin-right: 20px;padding-top: 8px;">
        <iframe width="280" height="158" allow="autoplay; fullscreen;" allowfullscreen style="border: 0"
                src="{{ $bar->content_youtube_url }}?autoplay={{ $bar->video_auto_play ? 1 : 0 }}"></iframe>
    </div>
@endif

@if ($bar->video_type == 'vimeo' && $bar->content_vimeo_url != '')
    <div style="width: auto;margin-right: 20px;padding-top: 8px;">
        <iframe width="280" height="158" allow="autoplay; fullscreen;" allowfullscreen style="border: 0"
                src="{{ $bar->content_vimeo_url }}?autoplay={{ $bar->video_auto_play ? 1 : 0 }}"></iframe>
    </div>
@endif

@if (($bar->video_type == 'other' && $bar->video_code == '') || ($bar->video_type == 'youtube' && $bar->content_youtube_url == '') || ($bar->video_type == 'vimeo' && $bar->content_vimeo_url == ''))
    <div style="margin-right: 20px;padding: 8px 0;">
        <div style="width: 280px; height: 158px; background: #000000; display: flex; justify-content: center; align-items: center; font-size: 40px;">
            <i class="fas fa-play"></i>
        </div>
    </div>
@endif
