@if ($bar->opt_in_type == "other" && $bar->opt_in_video_code != "")
    <div style="margin-right: 40px;padding-top: 8px;" class="video-code-preview">
        {!! htmlspecialchars_decode(stripslashes($bar->opt_in_video_code)) !!}
    </div>
@endif

@if ($bar->opt_in_type == "vid-youtube" && $bar->opt_in_youtube_url != "")
    <div style="width: auto;margin-right: 40px;padding-top: 8px;">
        <iframe width="304" height="176" allow="autoplay; fullscreen;" allowfullscreen style="border: 0"
                src="{{ $bar->opt_in_youtube_url }}?autoplay={{ $bar->opt_in_video_auto_play ? 1 : 0 }}"></iframe>
    </div>
@endif

@if ($bar->opt_in_type == "vid-vimeo" && $bar->opt_in_vimeo_url != "")
    <div style="width: auto;margin-right: 40px;padding-top: 8px;">
        <iframe width="304" height="176" allow="autoplay; fullscreen;" allowfullscreen style="border: 0"
                src="{{ $bar->opt_in_vimeo_url }}?autoplay={{ $bar->opt_in_video_auto_play ? 1 : 0 }}"></iframe>
    </div>
@endif

@if (($bar->opt_in_type == "other" && $bar->opt_in_video_code == "") || ($bar->opt_in_type == "vid-youtube" && $bar->opt_in_youtube_url == "") || ($bar->opt_in_type == "vid-vimeo" && $bar->opt_in_vimeo_url == ""))
    <div style="margin-right: 40px;padding: 8px 0;">
        <div style="width: 304px; height: 176px; background: #000000; display: flex; justify-content: center; align-items: center; font-size: 40px;">
            <i class="fas fa-play"></i>
        </div>
    </div>
@endif

@if ($bar->opt_in_type == "img-online" && $bar->image_url != "")
    <div style="width: auto;margin-right: 40px;padding-top: 8px;">
        <img style="width: auto; height: 176px;border: 0;" alt="" src="{{ $bar->image_url }}"/>
    </div>
@endif

@if ($bar->opt_in_type == "img-upload" && $bar->image_upload != "")
    <div style="width: auto;margin-right: 40px;padding-top: 8px;">
        <img style="width: auto; height: 176px;border: 0;" alt="" src="{{ $bar->image_upload }}"/>
    </div>
@endif

@if (($bar->opt_in_type == "img-upload" && $bar->image_upload == "") || ($bar->opt_in_type == "img-online" && $bar->image_url == ""))
    <div style="margin-right: 40px;padding: 8px 0;">
        <div style="width: 304px; height: 176px; background: #000000; display: flex; justify-content: center; align-items: center; font-size: 80px;">
            <i class="fas fa-image"></i>
        </div>
    </div>
@endif
