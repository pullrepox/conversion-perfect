@extends('layouts.base')
@section('title', 'Groups - ' . config('app.name'))
@section('content')
    <div class="main-content" id="group-list-panel">
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
                                    <a href="{{ secure_redirect(route('groups.create')) }}" class="btn btn-success btn-sm text-capitalize">New Group</a>
                                </div>
                            </div>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive" data-toggle="list" data-list-values='["name", "created_at"]'>
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Group</th>
                                    <th scope="col">Tags</th>
                                    <th scope="col" class="sort" data-sort="created_at">Created</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                @if (sizeof($groups) > 0)
                                    @foreach($groups as $group)
                                        <tr>
                                            <td class="align-items-center">
                                                <span class="name mb-0 text-sm">{{ $group->name }}</span>
                                            </td>
                                            <td>{{ $group->tags }}</td>
                                            <td>
                                                {{ time_elapsed_string($group->created_at) }}
                                                <span class="text-hide created_at">{{ $group->created_at }}</span>
                                            </td>
                                            <td class="table-actions text-right">
                                                <a href="javascript: void(0)" class="table-action table-action-cp group-edit"
                                                   data-target="{{ secure_redirect(route('groups.edit', ['group' => $group->id])) }}"
                                                   data-toggle="tooltip" data-original-title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript: void(0)" class="table-action table-action-cp group-report"
                                                   data-target="{{ secure_redirect(route('groups.show', ['group' => $group->id])) }}"
                                                   data-toggle="tooltip" data-original-title="Report" target="_blank">
                                                    <i class="fas fa-chart-pie"></i>
                                                </a>
                                                <a href="javascript: void(0)" class="table-action table-action-cp group-clone" data-target="{{ $group->id }}"
                                                   data-toggle="tooltip" data-original-title="Clone">
                                                    <i class="fas fa-clone"></i>
                                                </a>
                                                <a href="javascript: void(0)" data-id="{{ $group->id }}" class="table-action table-action-delete group-delete"
                                                   data-toggle="modal" data-target="#delete-group-modal">
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
                                            You have no Groups. Please add a Group by clicking the [New Group] button.
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- Card footer -->
                        <div class="card-footer py-4">
                            {{ $groups->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="delete-group-modal" tabindex="-1" role="dialog" aria-labelledby="delete-group-modal" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Delete Group</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h1>Are you sure?</h1>
                            <p>You will lose all settings and statistics for this Group. You will not be able to restore this Group.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-capitalize" id="deleteGroup">Delete</button>
                            <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
