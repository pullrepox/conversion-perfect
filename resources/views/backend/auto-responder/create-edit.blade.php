@extends('layouts.base')
@section('title', 'Auto Responder Edit - ' . config('app.name'))
@section('content')
    <div class="main-content" id="autoresponder-edit-page">
        @include('layouts.page-header', ['data' => $header_data])
        {{-- Page content --}}
        <div class="container-fluid mt--8">
            <form action="{{$flag ? route('autoresponder.store') : route('autoresponder.update', $integration->id)}}"
                  method="POST" class="needs-validation" novalidate>
                @if(!$flag) @method('PUT') @endif
                @csrf
                {{-- bar Base Content --}}
                <div class="card">
                    <div class="card-header">
                        <div class="form-row">
                            <h3 class="mb-0 col">{{ $flag ? 'New' : 'Edit' }} Auto Responder</h3>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success btn-sm text-capitalize">{{ $flag ? 'Create' : 'Update' }}</button>
                                <a href="{{ secure_redirect(route('autoresponder.index')) }}" class="btn btn-light btn-sm text-capitalize">Cancel</a>
                                @if (!$flag)
                                    <button type="button" class="btn btn-sm btn-primary text-capitalize">Archive</button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body pb-0">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="name" data-id="name">
                                        Friendly Name
                                    </label>
                                    <input type="text" value="{{isset($integration) && $integration->name ? $integration->name: old('name')}}"
                                           name="name" class="@error('name') is-invalid @enderror form-control required autocomplete="friendly_name"/>
                                    @if ($errors->has('name'))
                                        @error('name')
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
                                    <label class="form-control-label ml-1" for="auto-responder">
                                        Auto Responders
                                    </label>
                                    <select class="form-control" name="responder_id">
                                        @foreach($responders as $list)
                                            <option {{'selected' ? isset($integration) && $integration->responder_id === $list->id : old('responder_id') === $list->id}}
                                                    value="{{$list->id}}">{{$list->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="api_key" data-id="api_key">
                                        API KEY
                                    </label>
                                    <input type="text" value="{{isset($integration) && $integration->api_key ? $integration->api_key : old('api_key')}}"
                                           class="@error('api_key') is-invalid @enderror form-control" name="api_key" id="api_key"/>
                                    @if ($errors->has('api_key'))
                                        @error('api_key')
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

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="hash_key" data-id="hash_key">
                                        HASH KEY
                                    </label>
                                    <input type="text" value="{{isset($integration) && $integration->hash ? $integration->hash : old('hash')}}"
                                     class="@error('hash') is-invalid @enderror form-control" name="hash" id="hash"/>
                                    @if ($errors->has('hash'))
                                        @error('hash')
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
