@extends('layouts.base')
@section('title', 'Bars Edit - ' . config('app.name'))
@section('content')
    <div class="main-content" id="bar-edit-page" v-cloak>
        <div class="show-loading" v-if="loading"></div>
        @include('layouts.page-header', ['data' => $header_data])
        {{-- Page content --}}
        <div class="container-fluid mt--8">
            <form action="{{ $form_action }}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                @if (!$flag)
                    @method('PUT')
                @endif
                {{-- bar Base Content --}}
                <div class="card">
                    <div class="card-header">
                        <div class="form-row">
                            <h3 class="mb-0 col">{{ $flag ? 'New' : 'Edit' }} Conversion Bar</h3>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success btn-sm text-capitalize">{{ $flag ? 'Create' : 'Update' }}</button>
                                <a href="{{ secure_redirect(route('bars')) }}" class="btn btn-light btn-sm text-capitalize">Cancel</a>
                                @if (!$flag)
                                    <button type="button" class="btn btn-sm btn-default text-capitalize">Reset Stats</button>
                                    <button type="button" class="btn btn-sm btn-primary text-capitalize">Archive</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="friendly_name" data-id="friendly_name">
                                        Friendly Name
                                    </label>
                                    <input type="text" class="form-control @error('friendly_name') is-invalid @enderror" id="friendly_name" name="friendly_name"
                                           v-model="model.friendly_name"
                                           @keydown="tabKeyPress('#position', true, $event)" @keypress="tabKeyPress('#position', true, $event)"
                                           placeholder="Friendly Name" required autocomplete="friendly_name"/>
                                    @if ($errors->has('friendly_name'))
                                        @error('friendly_name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    @else
                                        <span class="invalid-feedback" role="alert">
                                            Please insert correct value.
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="position">
                                        Position
                                    </label>
                                    <select class="form-control @error('position') is-invalid @enderror" data-toggle="select" id="position" name="position" required
                                            @keydown="tabKeyPress('#group_id', true, $event)" @keypress="tabKeyPress('#group_id', true, $event)"
                                            v-model="model.position">
                                        <option value="top_sticky">Top Sticky</option>
                                        <option value="top">Top</option>
                                        <option value="bottom">Bottom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="group_id">
                                        Group
                                    </label>
                                    <select class="form-control @error('group_id') is-invalid @enderror" data-toggle="select" id="group_id" name="group_id" required
                                            @keydown="tabKeyPress('#headline', false, $event)" @keypress="tabKeyPress('#headline', false, $event)"
                                            v-model="model.group_id">
                                        <option value="0">All Bars</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="headline">
                                        Headline Text
                                    </label>
                                    <div id="headline" data-toggle="quill" data-quill-placeholder="Your Headline Text Here."></div>
                                    <input type="hidden" v-for="(h_l, h_i) in model.headline" :key="`hLine_${h_i}`" name="headline[]" :value="h_l.insert" v-if="h_l.insert.trim() != ''"/>
                                    <span v-for="(h_l, h_i) in model.headline" :key="`hLine_attr_${h_i}`" v-if="h_l.insert.trim() != ''">
                                        <span v-if="h_l.attributes">
                                            <input type="hidden" name="headline_bold[]" :value="h_l.attributes.bold ? true : ''"/>
                                            <input type="hidden" name="headline_italic[]" :value="h_l.attributes.italic ? true : ''"/>
                                            <input type="hidden" name="headline_underline[]" :value="h_l.attributes.underline ? true : ''"/>
                                            <input type="hidden" name="headline_strike[]" :value="h_l.attributes.strike ? true : ''"/>
                                        </span>
                                        <span v-else>
                                            <input type="hidden" name="headline_bold[]" value=""/>
                                            <input type="hidden" name="headline_italic[]" value=""/>
                                            <input type="hidden" name="headline_underline[]" value=""/>
                                            <input type="hidden" name="headline_strike[]" value=""/>
                                        </span>
                                    </span>
                                    @error('headline')
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="headline_color">
                                        Headline Color
                                    </label>
                                    <input class="jscolor form-control" name="headline_color"
                                           id="headline_color" v-model="model.headline_color" @change="updateJSColor('headline_color', false)"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="background_color">
                                        Background Color
                                    </label>
                                    <input class="jscolor form-control" name="background_color"
                                           id="background_color" v-model="model.background_color" @change="updateJSColor('background_color', false)"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($flag)
                    @include('users.bars-partials.bars-preview')
                @else
                    @include('users.bars-partials.bars-options')
                    @include('users.bars-partials.bars-preview')
                    @include('users.bars-partials.bars-display')
                    @include('users.bars-partials.bars-content')
                    @include('users.bars-partials.bars-appearance')
                    @include('users.bars-partials.bars-button')
                    @include('users.bars-partials.bars-countdown')
                @endif
            </form>
            {{-- Delete Options Modal Confirm --}}
            <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Clear @{{ del_option.label }}</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h1>Are you sure?</h1>
                            <p>Once cleared, you won't be able to revert this @{{ del_option.label }} options</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-capitalize" @click="clearOption">Clear</button>
                            <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        window._bar_opt_ary = {
            bar_id: "{{ $flag ? '' : $bar->id }}",
            create_edit: "{{ $flag }}",
            preview: '{{ $flag ? 'true' : $bar->opt_preview }}',
            display: '{{ $flag ? false : (old('opt_display') ? old('opt_display') : $bar->opt_display) }}',
            content: '{{ $flag ? false : (old('opt_content') ? old('opt_content') : $bar->opt_content) }}',
            appearance: '{{ $flag ? false : (old('opt_appearance') ? old('opt_appearance') : $bar->opt_appearance) }}',
            button: '{{ $flag ? false : (old('opt_button') ? old('opt_button') : $bar->opt_button) }}',
            countdown: '{{ $flag ? false : (old('opt_countdown') ? old('opt_countdown') : $bar->opt_countdown) }}',
            overlay: '{{ $flag ? false : (old('opt_overlay') ? old('opt_overlay') : $bar->opt_overlay) }}',
            autoresponder: '{{ $flag ? false : (old('opt_autoresponder') ? old('opt_autoresponder') : $bar->opt_autoresponder) }}',
            opt_in: '{{ $flag ? false : (old('opt_opt_in') ? old('opt_opt_in') : $bar->opt_opt_in) }}',
            custom_text: '{{ $flag ? false : (old('opt_custom_text') ? old('opt_custom_text') : $bar->opt_custom_text) }}',
            model: {
                friendly_name: "{{ (old('friendly_name') ? old('friendly_name') : ($flag ? quickRandom(6) : $bar->friendly_name)) }}",
                position: "{{ old('position') ? old('position') : ($flag ? 'top_sticky' : $bar->position) }}",
                group_id: "{{ old('group_id') ? old('group_id') : ($flag ? '0' : $bar->group_id) }}",
                headline: JSON.parse('{!! $flag ? json_encode([['attributes' => [], 'insert' => 'Your Headline']]) : $bar->headline !!}'),
                headline_color: "{{ old('headline_color') ? old('headline_color') : ($flag ? '#FFFFFF' : $bar->headline_color) }}",
                background_color: "{{ old('background_color') ? old('background_color') : ($flag ? '#3BAF85' : $bar->background_color) }}",
                display: {
                    show_bar_type: "{{ $flag ? 'immediate' : (old('show_bar_type') ? old('show_bar_type') : $bar->show_bar_type) }}",
                    frequency: "{{ $flag ? 'every' : (old('frequency') ? old('frequency') : $bar->frequency) }}",
                    delay_in_seconds: "{{ $flag ? 0 : (old('delay_in_seconds') ? old('delay_in_seconds') : $bar->delay_in_seconds) }}",
                    scroll_point_percent: "{{ $flag ? 0 : (old('scroll_point_percent') ? old('scroll_point_percent') : $bar->scroll_point_percent) }}"
                },
                content: {
                    sub_headline: JSON.parse('{!! $flag ? json_encode([['attributes' => [], 'insert' => '']]) : $bar->sub_headline !!}'),
                    sub_headline_color: "{{ $flag ? '#ffffff' : (old('sub_headline_color') ? old('sub_headline_color') : $bar->sub_headline_color) }}",
                    sub_background_color: "{{ $flag ? '#ffffff00' : (old('sub_background_color') ? old('sub_background_color') : $bar->sub_background_color) }}",
                    video: "{{ $flag ? null : (old('video') ? old('video') : $bar->video) }}",
                    video_code: "{{ $flag ? '' : (old('video_code') ? old('video_code') : htmlspecialchars_decode($bar->video_code)) }}",
                    video_auto_play: "{{ $flag ? null : (old('video_auto_play') ? old('video_auto_play') : $bar->video_auto_play) }}",
                },
                appearance: {
                    opacity: "{{ $flag ? 100 : (old('opacity') ? old('opacity') : $bar->opacity) }}",
                    drop_shadow: "{{ $flag ? null : (old('drop_shadow') ? old('drop_shadow') : $bar->drop_shadow) }}",
                    close_button: "{{ $flag ? null : (old('close_button') ? old('close_button') : $bar->close_button) }}",
                    background_gradient: "{{ $flag ? null : (old('background_gradient') ? old('background_gradient') : $bar->background_gradient) }}",
                    gradient_end_color: "{{ $flag ? '#3BAF85' : (old('gradient_end_color') ? old('gradient_end_color') : $bar->gradient_end_color) }}",
                    gradient_angle: "{{ $flag ? 0 : (old('gradient_angle') ? old('gradient_angle') : $bar->gradient_angle) }}",
                    powered_by_position: "{{ $flag ? 'bottom_right' : (old('powered_by_position') ? old('powered_by_position') : $bar->powered_by_position) }}",
                },
                button: {
                    button_type: "{{ $flag ? 'none' : (old('button_type') ? old('button_type') : $bar->button_type) }}",
                    button_location: "{{ $flag ? 'right' : (old('button_location') ? old('button_location') : $bar->button_location) }}",
                    button_label: "{{ $flag ? '' : (old('button_label') ? old('button_label') : $bar->button_label) }}",
                    button_background_color: "{{ $flag ? '#515f7f' : (old('button_background_color') ? old('button_background_color') : $bar->button_background_color) }}",
                    button_text_color: "{{ $flag ? '#FFFFFF' : (old('button_text_color') ? old('button_text_color') : $bar->button_text_color) }}",
                    button_animation: "{{ $flag ? 'none' : (old('button_animation') ? old('button_animation') : $bar->button_animation) }}",
                    button_action: "{{ $flag ? 'hide_bar' : (old('button_action') ? old('button_action') : $bar->button_action) }}",
                    button_click_url: "{{ $flag ? '' : (old('button_click_url') ? old('button_click_url') : $bar->button_click_url) }}",
                    button_open_new: "{{ $flag ? null : (old('button_open_new') ? old('button_open_new') : $bar->button_open_new) }}",
                },
                countdown: {
                    countdown: "{{ $flag ? 'none' : (old('countdown') ? old('countdown') : $bar->countdown) }}",
                    countdown_location: "{{ $flag ? 'left' : (old('countdown_location') ? old('countdown_location') : $bar->countdown_location) }}",
                    countdown_format: "{{ $flag ? 'dd' : (old('countdown_format') ? old('countdown_format') : $bar->countdown_format) }}",
                    countdown_end_date: "{{ $flag ? date('Y-m-d', strtotime('+30 days')) : (old('countdown_end_date') ? old('countdown_end_date') : $bar->countdown_end_date) }}",
                    countdown_end_time: "{{ $flag ? '00:00:00' : (old('countdown_end_time') ? old('countdown_end_time') : $bar->countdown_end_time) }}",
                    countdown_timezone: "{{ $flag ? config('app.timezone') : (old('countdown_timezone') ? old('countdown_timezone') : $bar->countdown_timezone) }}",
                    countdown_days: "{{ $flag ? 0 : (old('countdown_days') ? old('countdown_days') : $bar->countdown_days) }}",
                    countdown_hours: "{{ $flag ? 0 : (old('countdown_hours') ? old('countdown_hours') : $bar->countdown_hours) }}",
                    countdown_minutes: "{{ $flag ? 0 : (old('countdown_minutes') ? old('countdown_minutes') : $bar->countdown_minutes) }}",
                    countdown_background_color: "{{ $flag ? '#3BAF85' : (old('countdown_background_color') ? old('countdown_background_color') : $bar->countdown_background_color) }}",
                    countdown_text_color: "{{ $flag ? '#FFFFFF' : (old('countdown_text_color') ? old('countdown_text_color') : $bar->countdown_text_color) }}",
                    countdown_on_expiry: "{{ $flag ? 'hide_bar' : (old('countdown_on_expiry') ? old('countdown_on_expiry') : $bar->countdown_on_expiry) }}",
                    countdown_expiration_text: "{{ $flag ? '' : (old('countdown_expiration_text') ? old('countdown_expiration_text') : $bar->countdown_expiration_text) }}",
                    countdown_expiration_url: "{{ $flag ? '' : (old('countdown_expiration_url') ? old('countdown_expiration_url') : $bar->countdown_expiration_url) }}",
                },
                overlay: {},
                autoresponder: {},
                opt_in: {},
                custom_text: {}
            }
        };
    </script>
    <script type="text/javascript" src="{{ url(mix('js/slider-edit.js')) }}"></script>
@stop
