@extends('layouts.base')
@section('title', 'Edit Multi Bar - ' . config('app.name'))
@section('content')
    <div class="main-content" id="prod-edit-page" v-cloak>
        <div class="show-loading" v-if="loading"></div>
        @include('layouts.page-header', ['data' => $header_data])
        <div class="container-fluid mt--8">
            <form action="{{ $form_action }}" id="multi_bar_form" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                @if (!$flag)
                    @method('PUT')
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="form-row">
                            <h3 class="mb-0 col">{{ $header_data['main_name'] }}</h3>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success btn-sm text-capitalize">@{{ create_edit ? 'Create' : 'Update' }}</button>
                                <a href="{{ secure_redirect(route('multi-bars')) }}" class="btn btn-light btn-sm text-capitalize">
                                    @{{ !changed_status ? 'Close' : 'Cancel' }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label ml-1 text-capitalize" for="multi_bar_name">Description</label>
                                    <input type="text" id="multi_bar_name" name="multi_bar_name" class="form-control @error('multi_bar_name') is-invalid @enderror" autofocus
                                           v-model="model.multi_bar_name" @input="changeStatusVal" required/>
                                    @if ($errors->has('multi_bar_name'))
                                        @error('multi_bar_name')
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
                                    <label class="form-control-label ml-1 text-capitalize" for="bar_ids">Conversion Bars</label>
                                    <select class="form-control @error('bar_ids') is-invalid @enderror" id="bar_ids" data-toggle="select" name="bar_ids[]" v-model="model.bar_ids"
                                            multiple="multiple" required>
                                        @if (sizeof($bars) > 0)
                                            @foreach($bars as $row)
                                                <option value="{{ $row->id }}">{{ $row->friendly_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('bar_ids'))
                                        @error('bar_ids')
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
        </div>
        @include('layouts.footer')
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        window._multi_bar = {
            multi_bar_id: "{{ $flag ? '' : $multiBar->id }}",
            create_edit: "{{ $flag }}",
            form_action: "{{ $form_action }}",
            model: {
                multi_bar_name: "{{ $flag ? '' : $multiBar->multi_bar_name }}",
                bar_ids: JSON.parse('{{ $flag ? json_encode([]) : json_encode($multiBar->bar_ids) }}'.replace(/&quot;/g, ''))
            }
        };
    </script>
    <script type="text/javascript" src="{{ url(mix('js/multi-bar-edit.js')) }}"></script>
@stop
