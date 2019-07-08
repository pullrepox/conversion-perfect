@extends('layouts.base')
@section('title', 'Bars - ' . config('app.name'))
@section('content')
    <div class="main-content" id="bar-list-panel">
        @include('layouts.page-header', ['data' => $header_data])
        {{-- Page content --}}
        <div class="container-fluid mt--8">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <div class="row">
                                <h3 class="mb-0 col">{{ $header_data['main_name'] }}</h3>
                                <div class="col text-right">
                                    <a href="{{ secure_redirect(route('bars.create')) }}" class="btn btn-success btn-sm text-capitalize">New Conversion Bar</a>
                                </div>
                            </div>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive custom-table">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th>Friendly Name</th>
                                    <th>Click Count</th>
                                    <th>Unique Click Count</th>
                                    <th>Added</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (sizeof($bars) > 0)
                                    @foreach($bars as $bar)
                                        <tr>
                                            <td class="table-actions">
                                                <a href="{{ route('bars.show', ['bar' => $bar->id]) }}" class="table-action table-action-cp"
                                                   data-toggle="tooltip" data-original-title="Report" target="_blank">
                                                    <i class="fas fa-chart-pie"></i>
                                                </a>
                                                <a href="javascript: void(0)" class="table-action table-action-cp" data-target="{{ $bar->id }}"
                                                   data-toggle="tooltip" data-placement="top" title="Preview">
                                                    <i class="fas fa-external-link-square-alt"></i>
                                                </a>
                                                <a href="javascript: void(0)" class="table-action table-action-cp" data-target="{{ $bar->id }}"
                                                   data-toggle="tooltip" data-placement="top" title="Get Code">
                                                    <i class="fas fa-clipboard"></i>
                                                </a>
                                            </td>
                                            <td class="table-user">{{ $bar->friendly_name }}</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>{{ time_elapsed_string($bar->created_at) }}</td>
                                            <td class="table-actions text-right">
                                                <a href="{{ route('bars.edit', ['bar' => $bar->id]) }}" class="table-action table-action-cp"
                                                   data-toggle="tooltip" data-original-title="Edit Bar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript: void(0)" class="table-action table-action-cp bar-clone" data-target="{{ $bar->id }}"
                                                   data-toggle="tooltip" data-placement="top" title="Clone">
                                                    <i class="fas fa-clone"></i>
                                                </a>
                                                <a href="javascript: void(0)" data-id="{{ $bar->id }}" class="table-action table-action-delete bar-delete"
                                                   data-toggle="modal" data-target="#delete-modal">
                                                    <span data-toggle="tooltip" data-placement="top" title="Delete Bar" class="w-100 h-100">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            You have no Conversion Bars. Please add a Conversion Bar by clicking the [New Conversion Bar] button.
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- Card footer -->
                        <div class="card-footer py-4">
                            {{ $bars->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal" aria-hidden="true">
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
                            <p>You will lose all settings and statistics for this Conversion Bar. You will not be able to restore this Conversion Bar.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-capitalize" id="deleteBar">Delete</button>
                            <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection
