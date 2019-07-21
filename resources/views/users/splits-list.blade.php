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
                <div class="table-responsive" data-toggle="list" data-list-values='["name", "bar_name", "created_at"]'>
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" class="sort" data-sort="name">Description</th>
                            <th scope="col" data-sort="bar_name">Conversion Bar</th>
                            <th scope="col" class="sort" data-sort="created_at">Created</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @if (sizeof($split_tests) > 0)
                            @foreach($split_tests as $row)
                                <tr>
                                    <td class="table-actions">
                                        <a href="{{ secure_redirect(route('split-tests.show', ['splitTest' => $row->id, 'report' => true, 'period' => 'month'])) }}"
                                           class="table-action table-action-cp" data-toggle="tooltip" data-original-title="Report">
                                            <i class="fas fa-chart-pie"></i>
                                        </a>
                                        <a href="javascript: void(0)" class="table-action table-action-cp splits-copy-code" data-toggle="modal" data-target="#copy-splits-modal">
                                            <span data-toggle="tooltip" data-placement="top" title="Get Code" class="w-100 h-100">
                                                <i class="fas fa-clipboard-list"></i>
                                            </span>
                                        </a>
                                    </td>
                                    <td>{{ $row->split_bar_name }}</td>
                                    <td>{{ $row->bar->friendly_name }}</td>
                                    <td>{{ time_elapsed_string($row->created_at) }}</td>
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
                                    You have no Split Tests. Please add a Split Tests by clicking the [Add Split Test] button.
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
                            <h6 class="modal-title" id="modal-title-default">Delete Conversion Bar</h6>
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
        </div>
        @include('layouts.footer')
    </div>
@endsection
