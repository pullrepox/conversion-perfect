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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="position">
                                        Position
                                    </label>
                                    <select class="form-control @error('position') is-invalid @enderror" data-toggle="select" id="position" name="position" required
                                            @keydown="tabKeyPress('#group_id', true, $event)" @keypress="tabKeyPress('#group_id', true, $event)"
                                            v-model="model.position">
                                        <option value="top">Top</option>
                                        <option value="bottom">Bottom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="headline" data-id="headline">
                                        Headline Text
                                    </label>
                                    <div id="headline" name="headline" data-toggle="quill" data-quill-placeholder="Headline Text"></div>
                                    @error('headline')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="headline_color" data-id="headline_color">
                                        Headline Color
                                    </label>
                                    <input class="jscolor form-control" name="headline_color" id="headline_color" v-model="model.headline_color"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="background_color" data-id="background_color">
                                        Background Color
                                    </label>
                                    <input class="jscolor form-control" name="background_color" id="background_color" v-model="model.background_color"/>
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
            display: false,
            content: false,
            appearance: false,
            button: false,
            countdown: false,
            overlay: false,
            autoresponder: false,
            opt_in: false,
            custom_text: false,
            model: {
                friendly_name: "{{ $flag ? quickRandom(6) : (old('friendly_name') ? old('friendly_name') : $bar->friendly_name) }}",
                position: "{{ $flag ? 'top' : (old('position') ? old('position') : $bar->position) }}",
                group_id: "{{ $flag ? '0' : (old('group_id') ? old('group_id') : $bar->group_id) }}",
                headline: 'Your Headline Text Here!',
                headline_color: '#ffffff',
                background_color: '#172b4d',
                display: {},
                content: {},
                appearance: {},
                button: {},
                countdown: {},
                overlay: {},
                autoresponder: {},
                opt_in: {},
                custom_text: {}
            }
        };
    </script>
    <script type="text/javascript" src="{{ url(mix('js/slider-edit.js')) }}"></script>
@stop
