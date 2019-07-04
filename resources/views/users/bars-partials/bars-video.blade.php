<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label ml-1" for="video_type">Video</label>
            <select class="form-control" data-toggle="select" id="video_type" name="video_type" v-model="model.content.video_type" data-parent="content">
                <option value="none">None</option>
                <option value="youtube">Youtube</option>
                <option value="vimeo">Vimeo</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>
    <div class="col-md-4" v-if="model.content.video_type === 'youtube'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="content_youtube_url">Youtube URL</label>
            <input type="text" class="form-control @error('content_youtube_url') is-invalid @enderror"
                   id="content_youtube_url" name="content_youtube_url" @input="changeToUrl('content_youtube_url', 'content')" data-parent="content"
                   v-model="model.content.content_youtube_url" placeholder="https://www.youtube.com/embed/_UbDeqPdUek"/>
            @error('content_youtube_url')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" v-if="model.content.video_type === 'vimeo'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="content_vimeo_url">Vimeo URL</label>
            <input type="text" class="form-control @error('content_vimeo_url') is-invalid @enderror"
                   id="content_vimeo_url" name="content_vimeo_url" @input="changeToUrl('content_vimeo_url', 'content')" data-parent="content"
                   v-model="model.content.content_vimeo_url" placeholder="https://player.vimeo.com/video/20732587"/>
            @error('content_vimeo_url')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" v-if="model.content.video_type === 'other'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="video_code">Video Embed Code</label>
            <textarea id="video_code" name="video_code" v-model="model.content.video_code" data-parent="content"
                      class="form-control @error('video_code') is-invalid @enderror" @input="changed_status = true" rows="1"></textarea>
            @error('video_code')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" v-if="model.content.video_type === 'youtube' || model.content.video_type === 'vimeo'">
        <div class="form-group">
            <label class="form-control-label ml-1" for="video_auto_play">Autoplay</label>
            <div class="radio ml-1">
                <label class="custom-toggle custom-toggle-light">
                    <input type="checkbox" id="video_auto_play" name="video_auto_play"
                           data-parent="button" v-model="model.content.video_auto_play" @input="changed_status = true">
                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                </label>
            </div>
        </div>
    </div>
</div>
