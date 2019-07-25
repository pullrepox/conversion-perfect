@extends('layouts.base')
@section('title', 'Edit Split Test - ' . config('app.name'))
@section('content')
    <div class="main-content" id="prod-edit-page" v-cloak>
        <div class="show-loading" v-if="loading"></div>
        @include('layouts.page-header', ['data' => $header_data])
        <div class="container-fluid mt--8">
            <form action="{{ $form_action }}" id="split_test_form" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
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
                                <button type="submit" class="btn btn-success btn-sm text-capitalize" v-if="!create_edit">Update</button>
                                <a href="{{ secure_redirect(route('split-tests')) }}" class="btn btn-light btn-sm text-capitalize">
                                    @{{ !changed_status ? 'Close' : (create_edit ? 'Cancel' : 'Cancel') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1 text-capitalize" for="conversion_bar">Conversion Bar</label>
                                    <select class="form-control" id="conversion_bar" data-toggle="select" name="conversion_bar" v-model="model.conversion_bar" {{ $flag ? '' : 'disabled' }}>
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
                                    <label class="form-control-label ml-1 text-capitalize" for="split_bar_name">Description</label>
                                    <input type="text" id="split_bar_name" name="split_bar_name" class="form-control" autofocus
                                           v-model="model.split_bar_name" @input="changeStatusVal"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="split_bar_weight">Weight</label>
                                    <div class="input-group mb-3">
                                        <input type="number" id="split_bar_weight" name="split_bar_weight" class="form-control rounded-right mr-2"
                                               v-model="model.split_bar_weight" @input="changeStatusVal" min="0" max="99"/>
                                        <span class="invalid-feedback" role="alert">
                                            Please insert integer.
                                        </span>
                                        <div class="input-group-prepend rounded-left rounded-right" v-if="create_edit">
                                            <button class="btn btn-light rounded-left rounded-right" type="button" @click="addSplitRow">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{ $flag ? '' : $splitTest->id }}">
            </form>
            <div class="card mt--3">
                <div class="card-header border-0">
                    <h3 class="mb-0">Split Test List</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th>Description</th>
                            <th>Weight</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!$flag)
                            <tr>
                               <td>@{{ model.split_bar_name }}</td>
                               <td>@{{ model.split_bar_weight }}%</td>
                               <td></td>
                            </tr>
                        @endif
                        <tr v-for="(s_item, s_i) in model.splits_list" :key="`split_item_${s_i}`">
                            <td>@{{ s_item.split_bar_name }}</td>
                            <td>@{{ s_item.split_bar_weight }}%</td>
                            <td class="table-actions text-right">
                                <a href="javascript: void(0)" class="table-action table-action-delete" @click="deleteSplitTest(s_item.id, s_i)">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-50">
                                Main Conversion Bar (@{{ model.conversion_bar_name }})
                            </td>
                            <td>
                                @{{ model.main_weight }}%
                            </td>
                            <td class="table-actions text-right">
                                <button type="button" class="btn btn-sm small mr--2 no-shadow-box no-hover-transform font-weight-normal" @click="equalizeWeight">
                                    Equalize Weights
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        window._split_bar = {
            split_id: "{{ $flag ? '' : $splitTest->id }}",
            create_edit: "{{ $flag }}",
            form_action: "{{ $form_action }}",
            model: {
                conversion_bar: '{{ $bars[0]->id }}',
                conversion_bar_name: '{{ $bars[0]->friendly_name }}',
                split_bar_name: "{{ $flag ? '' : $splitTest->split_bar_name }}",
                split_bar_weight: "{{ $flag ? '' : $splitTest->split_bar_weight }}",
                splits_list: JSON.parse('{!! json_encode($split_list) !!}'),
                main_weight: parseInt({!! $split_weight !!})
            }
        };
    </script>
    <script type="text/javascript" src="{{ url(mix('js/splits-edit.js')) }}"></script>
@stop
