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
            abuse: "{{ $flag ? false : (old('opt_abuse') ? old('opt_abuse') : $bar->opt_abuse) }}",
            model: {
                destination_url: "{{ $flag ? '' : (old('destination_url') ? old('destination_url') : $bar->destination_url) }}",
                friendly_name: "{{ $flag ? '' : (old('friendly_name') ? old('friendly_name') : $bar->friendly_name) }}",
                tracking_link: "{{ $flag ? '' : (old('tracking_link') ? old('tracking_link') : $bar->tracking_link) }}",
                group_id: "{{ $flag ? '0' : (old('group_id') ? old('group_id') : $bar->group_id) }}",
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
