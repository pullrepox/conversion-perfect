@extends('layouts.base')
@section('title', 'Split Test - ' . config('app.name'))
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
                            <a href="{{ secure_redirect(route('split-tests.create')) }}" class="btn btn-success btn-sm text-capitalize">Add Split Test</a>
                        </div>
                    </div>
                </div>
                <!-- Light table -->
                <div class="table-responsive" data-toggle="list" data-list-values='["name", "bar-name", "created_at"]'>
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" class="sort" data-sort="name">Description</th>
                            <th scope="col" class="sort" data-sort="bar-name">Conversion Bar</th>
                            <th scope="col" class="sort" data-sort="created_at">Created</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @if (sizeof($split_tests) > 0)
                            @foreach($split_tests as $row)
                                <tr>
                                    <td class="table-actions">
                                        <a href="javascript: void(0)" class="table-action table-action-cp split-test-report" data-toggle="tooltip" data-original-title="Report"
                                           data-href="{{ secure_redirect(route('split-tests.show', ['splitTest' => $row->id, 'report' => true, 'period' => 'month'])) }}">
                                            <i class="fas fa-chart-pie"></i>
                                        </a>
                                        <a href="javascript: void(0)" class="table-action table-action-cp splits-copy-code" data-toggle="modal" data-target="#split-copy-modal"
                                           data-link="{{ secure_redirect(route('conversion.get-split-scripts-code-for-embed', ['id' => $row->id, 'bar_id' => $row->bar_id])) }}">
                                            <span data-toggle="tooltip" data-placement="top" title="Get Code" class="w-100 h-100">
                                                <i class="fas fa-clipboard-list"></i>
                                            </span>
                                        </a>
                                    </td>
                                    <td class="name">{{ $row->split_bar_name }}</td>
                                    <td class="bar-name">{{ $row->bar->friendly_name }}</td>
                                    <td class="created_at">{{ time_elapsed_string($row->created_at) }}</td>
                                    <td class="table-actions text-right pl-0 pr-3" style="width: 90px;">
                                        <a href="javascript: void(0)" data-href="{{ secure_redirect(route('split-tests.edit', ['splitTest' => $row->id])) }}"
                                           class="table-action table-action-cp split-test-edit" data-toggle="tooltip" data-original-title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript: void(0)" data-id="{{ $row->id }}" class="table-action table-action-delete split-test-delete"
                                           data-toggle="modal" data-target="#delete-split-modal">
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
                                    You have no Split Tests. Please add a Split Test by clicking the [Add Split Test] button.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    {{ $split_tests->links() }}
                </div>
            </div>
            <div class="modal fade" id="delete-split-modal" tabindex="-1" role="dialog" aria-labelledby="delete-split-modal" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Delete Split Test</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h1>Are you sure?</h1>
                            <p>You will lose all settings and statistics for this Split Test Conversion Bar. You will not be able to restore this Split Test Conversion Bar.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-capitalize" id="deleteSplitBar">Delete</button>
                            <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="split-copy-modal" tabindex="-1" role="dialog" aria-labelledby="split-copy-modal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Get Code For Your Split Test</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="split_script_copy">
                                        Copy and paste the following code into your web page just before the end body tag.
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="split_script_copy"/>
                                        <a href="javascript: void(0)" data-clipboard-target="#split_script_copy"
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
@endsection
