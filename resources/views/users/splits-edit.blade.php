@extends('layouts.base')
@section('title', 'Edit Split Test - ' . config('app.name'))
@section('content')
    <div class="main-content" id="prod-edit-page">
        @include('layouts.page-header', ['data' => $header_data])
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
                            <h3 class="mb-0 col">{{ $header_data['main_name'] }}</h3>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success btn-sm text-capitalize">{{ $flag ? 'Create' : 'Update' }}</button>
                                <a href="{{ secure_redirect(route('split-tests')) }}" class="btn btn-light btn-sm text-capitalize">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1 text-capitalize" for="split_name">Description</label>
                                    <input type="text" id="split_name" name="split_name" class="form-control"
                                           v-model="model.split_name"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1 text-capitalize" for="conversion_bar">Main Conversion Bar</label>
                                    <select class="form-control" id="conversion_bar">
                                        @if (sizeof($bars) > 0)
                                            @foreach($bars as $row)
                                                <option value="{{ $row->id }}">{{ $row->friendly_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="split_weight">Weight</label>
                                    <div class="input-group mb-3">
                                        <input type="number" id="split_weight" name="split_weight" class="form-control rounded-right mr-2"
                                               v-model="model.split_weight"/>
                                        <div class="input-group-prepend rounded-left rounded-right">
                                            <button class="btn btn-light rounded-left rounded-right" type="button">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @include('layouts.footer')
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        window._split_bar = {
            split_id: "{{ $flag ? '' : $splitTest->id }}",
        };
    </script>
    <script type="text/javascript" src="{{ url(mix('js/splits-edit.js')) }}"></script>
@stop
