@extends('layouts.base')
@section('title', 'Bars Edit - ' . config('app.name'))
@section('content')
    <div class="main-content" id="bar-edit-page" v-cloak>
        <div class="show-loading" v-if="loading"></div>
        @include('layouts.page-header', ['data' => $header_data])
        {{-- Page content --}}
        <div class="container-fluid mt--8">
            <form action="{{ $form_action }}" method="post" class="needs-validation" novalidate>
                @csrf
                @if (!$flag)
                    @method('PUT')
                @endif
                {{-- bar Base Content --}}
                <div class="card">
                    <div class="card-header">
                        <div class="form-row">
                            <h3 class="mb-0 col">{{ $flag ? 'New' : 'Edit' }} Bar</h3>
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
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="destination_url" data-id="destination_url">
                                        Destination URL
                                        <span class="btn-icon-only rounded-circle help-icon" data-toggle="tooltip" data-placement="top" title="{{ trans('help.destination_url') }}">
                                            <i class="fas fa-question-circle"></i>
                                        </span>
                                    </label>
                                    <input type="url" class="form-control @error('destination_url') is-invalid @enderror" id="destination_url" v-model="model.destination_url"
                                           @keydown="tabKeyPress('#friendly_name', false, $event)" @keypress="tabKeyPress('#friendly_name', false, $event)"
                                           name="destination_url" placeholder="https://yourdestinationurl.com" required autocomplete="destination_url" autofocus/>
                                    @if ($errors->has('destination_url'))
                                        @error('destination_url')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    @else
                                        <span class="invalid-feedback" role="alert">
                                            Please insert correct value(URL has to include http(s)://).
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="friendly_name" data-id="friendly_name">
                                        Friendly Name
                                        <span class="btn-icon-only rounded-circle help-icon" role="tooltip"
                                              data-toggle="tooltip" data-placement="top" title="{{ trans('help.friendly_name') }}">
                                            <i class="fas fa-question-circle"></i>
                                        </span>
                                    </label>
                                    <input type="text" class="form-control @error('friendly_name') is-invalid @enderror" id="friendly_name" name="friendly_name"
                                           v-model="model.friendly_name"
                                           @keydown="tabKeyPress('#tracking_domain', true, $event)" @keypress="tabKeyPress('#tracking_domain', true, $event)"
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
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="tracking_domain" data-id="tracking_domain">
                                        Tracking Link
                                        <span class="btn-icon-only rounded-circle help-icon" data-toggle="tooltip" data-placement="top" title="{{ trans('help.tracking_link') }}">
                                            <i class="fas fa-question-circle"></i>
                                        </span>
                                    </label>
                                    <div class="form-row">
                                        <div class="col-md-8 pr-2">
                                            <select class="form-control" data-toggle="select" id="tracking_domain"
                                                    @keydown="tabKeyPress('#tracking_link', false, $event)" @keypress="tabKeyPress('#tracking_link', false, $event)"
                                                    name="tracking_domain" required>
                                            </select>
                                        </div>
                                        <div class="col-md-4 pl-2">
                                            <div class="track-link-sept">
                                                <input type="text" id="tracking_link" name="tracking_link" class="form-control @error('tracking_link') is-invalid @enderror"
                                                       @keydown="tabKeyPress('#group_id', true, $event)" @keypress="tabKeyPress('#group_id', true, $event)"
                                                       maxlength="255" required v-model="model.tracking_link"/>
                                                @if ($errors->has('tracking_link'))
                                                    @error('tracking_link')
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="group_id">
                                        Group
                                        <span class="btn-icon-only rounded-circle help-icon" data-toggle="tooltip" data-placement="top" title="{{ trans('help.link_group') }}">
                                            <i class="fas fa-question-circle"></i>
                                        </span>
                                    </label>
                                    <select class="form-control @error('group_id') is-invalid @enderror" data-toggle="select" id="group_id" name="group_id" required
                                            v-model="model.group_id">
                                        <option value="0">All Bars</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            general: "{{ $flag ? false : (old('opt_general') ? old('opt_general') : $bar->opt_general) }}",
            cloak: "{{ $flag ? false : (old('opt_cloak') ? old('opt_cloak') : $bar->opt_cloak) }}",
            traffic: "{{ $flag ? false : (old('opt_traffic') ? old('opt_traffic') : $bar->opt_traffic) }}",
            conversions: "{{ $flag ? false : (old('opt_conversions') ? old('opt_conversions') : $bar->opt_conversions) }}",
            notifications: "{{ $flag ? false : (old('opt_notifications') ? old('opt_notifications') : $bar->opt_notifications) }}",
            split: "{{ $flag ? false : (old('opt_split') ? old('opt_split') : $bar->opt_split) }}",
            popovers: "{{ $flag ? false : (old('opt_popovers') ? old('opt_popovers') : $bar->opt_popovers) }}",
            retargeting: "{{ $flag ? false : (old('opt_retargeting') ? old('opt_retargeting') : $bar->opt_retargeting) }}",
            geotargeting: "{{ $flag ? false : (old('opt_geotargeting') ? old('opt_geotargeting') : $bar->opt_geotargeting) }}",
            language: "{{ $flag ? false : (old('opt_language') ? old('opt_language') : $bar->opt_language) }}",
            mobile: "{{ $flag ? false : (old('opt_mobile') ? old('opt_mobile') : $bar->opt_mobile) }}",
            repeat: "{{ $flag ? false : (old('opt_repeat') ? old('opt_repeat') : $bar->opt_repeat) }}",
            maximum: "{{ $flag ? false : (old('opt_maximum') ? old('opt_maximum') : $bar->opt_maximum) }}",
            expire: "{{ $flag ? false : (old('opt_expire') ? old('opt_expire') : $bar->opt_expire) }}",
            abuse: "{{ $flag ? false : (old('opt_abuse') ? old('opt_abuse') : $bar->opt_abuse) }}",
            model: {
                destination_url: "{{ $flag ? '' : (old('destination_url') ? old('destination_url') : $bar->destination_url) }}",
                friendly_name: "{{ $flag ? '' : (old('friendly_name') ? old('friendly_name') : $bar->friendly_name) }}",
                tracking_link: "{{ $flag ? '' : (old('tracking_link') ? old('tracking_link') : $bar->tracking_link) }}",
                group_id: "{{ $flag ? '0' : (old('group_id') ? old('group_id') : $bar->group_id) }}",
                general: {
                    redirect_mode: "{{ $flag ? '301' : (old('redirect_mode') ? old('redirect_mode') : $bar->redirect_mode) }}",
                    bar_password: "{{ $flag ? '' : (old('password') ? old('password') : $bar->password) }}",
                    notes: "{{ $flag ? '' : (old('notes') ? old('notes') : $bar->notes) }}",
                    tags: "{{ $flag ? '' : (old('tags') ? old('tags') : $bar->tags) }}",
                    erase_referral: "{{ $flag ? null : (old('erase_referral') ? old('erase_referral') : $bar->erase_referral) }}",
                    forward_parameters: "{{ $flag ? null : (old('forward_parameters') ? old('forward_parameters') : $bar->forward_parameters) }}",
                },
                cloak: {
                    cloak_link: "{{ $flag ? null : (old('cloak_link') ? old('cloak_link') : $bar->cloak_link) }}",
                    hide_search_engine: "{{ $flag ? null : (old('hide_search_engine') ? old('hide_search_engine') : $bar->hide_search_engine) }}",
                    page_title: "{{ $flag ? '' : (old('page_title') ? old('page_title') : $bar->page_title) }}",
                    page_description: "{{ $flag ? '' : (old('page_description') ? old('page_description') : $bar->page_description) }}",
                    page_keywords: "{{ $flag ? '' : (old('page_keywords') ? old('page_keywords') : $bar->page_keywords) }}",
                },
                traffic: {
                    cost: "{{ $flag ? 0 : (old('cost') ? old('cost') : $bar->cost) }}",
                    cost_unit: "{{ $flag ? 'one_time' : (old('cost_unit') ? old('cost_unit') : $bar->cost_unit) }}",
                },
                geotargeting: {
                    include_all: "{{ $flag ? null : (((old('include_countries') || old('exclude_countries')) && !is_null(old('include_all'))) ? null : $bar->include_all) }}",
                    geo_alternate_url: "{{ $flag ? '' : (old('geo_alternate_url') ? old('geo_alternate_url') : $bar->geo_alternate_url) }}",
                    include_countries: JSON.parse('{!! $flag ? json_encode([]) : (old('include_countries') ? json_encode(old('include_countries')) : json_encode($bar->include_countries)) !!}'),
                    exclude_countries: JSON.parse('{!! $flag ? json_encode([]) : (old('exclude_countries') ? json_encode(old('exclude_countries')) : json_encode($bar->exclude_countries)) !!}')
                },
                language: {
                    language_all: "{{ $flag ? null : (((old('include_languages') || old('exclude_languages')) && is_null(old('language_all'))) ? null : $bar->language_all) }}",
                    language_alternate_url: "{{ $flag ? '' : (old('language_alternate_url') ? old('language_alternate_url') : $bar->language_alternate_url) }}",
                    include_languages: JSON.parse('{!! $flag ? json_encode([]) : (old('include_languages') ? json_encode(old('include_languages')) : json_encode($bar->include_languages)) !!}'),
                    exclude_languages: JSON.parse('{!! $flag ? json_encode([]) : (old('exclude_languages') ? json_encode(old('exclude_languages')) : json_encode($bar->exclude_languages)) !!}'),
                },
                mobile: {
                    mobile_click: "{{ $flag ? '1' : (old('mobile_click') ? old('mobile_click') : $bar->mobile_click) }}",
                    mobile_click_url: "{{ $flag ? '' : (old('mobile_click_url') ? old('mobile_click_url') : $bar->mobile_click_url) }}",
                    tablet_click: "{{ $flag ? '1' : (old('tablet_click') ? old('tablet_click') : $bar->tablet_click) }}",
                    tablet_click_url: "{{ $flag ? '' : (old('tablet_click_url') ? old('tablet_click_url') : $bar->tablet_click_url) }}",
                    ios_click: "{{ $flag ? '1' : (old('ios_click') ? old('ios_click') : $bar->ios_click) }}",
                    ios_click_url: "{{ $flag ? '' : (old('ios_click_url') ? old('ios_click_url') : $bar->ios_click_url) }}"
                },
                repeat: {
                    second_click: "{{ $flag ? '1' : (old('second_click') ? old('second_click') : $bar->second_click) }}",
                    repeat_url: "{{ $flag ? '' : (old('repeat_url') ? old('repeat_url') : $bar->second_click_url) }}"
                },
                maximum: {
                    max_click: "{{ $flag ? 100 : (old('max_click') ? old('max_click') : $bar->max_click) }}",
                    maximum_url: "{{ $flag ? '' : (old('maximum_url') ? old('maximum_url') : $bar->alternate_url) }}",
                },
                expire: {
                    start_at: "{{ $flag ? date('m/d/Y') : (old('start_at') ? old('start_at') : $bar->start_at) }}",
                    url_before_start: "{{ $flag ? '' : (old('url_before_start') ? old('url_before_start') : $bar->url_before_start) }}",
                    expire_at: "{{ $flag ? date('m/d/Y', strtotime('+14 days')) : (old('expire_at') ? old('expire_at') : $bar->expire_at) }}",
                    expire_alternate_url: "{{ $flag ? '' : (old('expire_alternate_url') ? old('expire_alternate_url') : $bar->expire_alternate_url) }}",
                },
                split: {
                    id: 1,
                    split_url_name: '',
                    split_url: '',
                    split_weight: 0
                },
                splits: JSON.parse('{!! $flag ? json_encode([]) : json_encode($split_url_test) !!}'),
            },
            options_sub: {
                split_weight: "{{ $flag ? 100 : $bar->split_weight }}"
            }
        };
        @error('language_alternate_url')
            window._bar_opt_ary.model.language.language_all = null;
        @enderror
            @error('geo_alternate_url')
            window._bar_opt_ary.model.geotargeting.include_all = null;
        @enderror
    </script>
    <script type="text/javascript" src="{{ url(mix('js/slider-edit.js')) }}"></script>
@stop
