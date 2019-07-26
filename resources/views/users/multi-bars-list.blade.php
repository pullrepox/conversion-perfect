@extends('layouts.base')
@section('title', 'Multi Bar - ' . config('app.name'))
@section('content')
    <div class="main-content" id="bar-list-panel">
        @include('layouts.page-header', ['data' => $header_data])
        <div class="container-fluid mt--8">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row">
                        <h3 class="mb-0 col">{{ $header_data['main_name'] }}</h3>
                        <div class="col text-right">
                            <a href="{{ secure_redirect(route('multi-bars.create')) }}" class="btn btn-success btn-sm text-capitalize">Add Multi Bar</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Description</th>
                            <th scope="col">Conversion Bars</th>
                            <th scope="col">Created</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (sizeof($multi_bars) > 0)
                            @foreach($multi_bars as $row)
                                <tr>
                                    <td class="table-actions">
                                        <a class="table-action table-action-cp" data-toggle="tooltip" data-original-title="Report"
                                           href="{{ secure_redirect(route('multi-bars.show', ['multiBar' => $row->id, 'report' => true, 'period' => 'month'])) }}">
                                            <i class="fas fa-chart-pie"></i>
                                        </a>
                                        <a href="javascript: void(0)" class="table-action table-action-cp multi-copy-code" data-toggle="modal" data-target="#multi-copy-modal"
                                           data-link="{{ secure_redirect(route('conversion.get-multi-scripts-code-for-embed', ['id' => $row->id])) }}">
                                            <span data-toggle="tooltip" data-placement="top" title="Get Code" class="w-100 h-100">
                                                <i class="fas fa-clipboard-list"></i>
                                            </span>
                                        </a>
                                    </td>
                                    <td>{{ $row->multi_bar_name }}</td>
                                    <td>{{ getBarNamesString($row->bar_ids) }}</td>
                                    <td>{{ time_elapsed_string($row->created_at) }}</td>
                                    <td class="table-actions">
                                        <a href="{{ secure_redirect(route('multi-bars.edit', ['multiBar' => $row->id])) }}"
                                           class="table-action table-action-cp" data-toggle="tooltip" data-original-title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript: void(0)" data-id="{{ $row->id }}" class="table-action table-action-delete bar-delete"
                                           data-toggle="modal" data-target="#delete-multi-bar-modal">
                                            <span data-toggle="tooltip" data-placement="top" title="Delete" class="w-100 h-100">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">
                                    You have no Multi Bars. Please add a Multi Bar by clicking the [Add Multi Bar] button.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    {{ $multi_bars->links() }}
                </div>
            </div>
            <div class="modal fade" id="delete-multi-bar-modal" tabindex="-1" role="dialog" aria-labelledby="delete-multi-bar-modal" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Delete Multi Bar</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h1>Are you sure?</h1>
                            <p>You will lose all settings and statistics for this Multi Bar. You will not be able to restore this Multi Bar.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-capitalize" id="deleteMultiBar">Delete</button>
                            <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="multi-copy-modal" tabindex="-1" role="dialog" aria-labelledby="multi-copy-modal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Get Code For Your Multi Bar</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="multi_script_copy">
                                        Copy and paste the following code into your web page just before the end body tag.
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="multi_script_copy"/>
                                        <a href="javascript: void(0)" data-clipboard-target="#multi_script_copy"
                                           class="input-group-addon btn btn-light table-action-cp border-left-radius-0 clipboard-bar-embed-code"
                                           data-toggle="tooltip" data-placement="top" title="Copy to Clipboard">
                                            <i class="fas fa-clipboard"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@stop

