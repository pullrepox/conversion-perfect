@extends('layouts.base')
@section('title', 'Email Lists - ' . config('app.name'))
@section('content')
    <div class="main-content" id="email-list-list-panel">
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
                                    <a href="{{ secure_redirect(route('email-lists.create')) }}" class="btn btn-success btn-sm text-capitalize">New Email List</a>
                                </div>
                            </div>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive" data-toggle="list" data-list-values='["name", "created_at"]'>
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Email List</th>
                                    <th scope="col">Subscribers</th>
                                    <th scope="col" class="sort" data-sort="created_at">Created</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                @if (sizeof($email_lists) > 0)
                                    @foreach($email_lists as $email_list)
                                        <tr>
                                            <td class="align-items-center">
                                                <span class="name mb-0 text-sm">{{ $email_list->list_name }}</span>
                                            </td>
                                            <td>{{ count($email_list->subscribers) }}</td>
                                            <td>
                                                {{ time_elapsed_string($email_list->created_at) }}
                                                <span class="text-hide created_at">{{ $email_list->created_at }}</span>
                                            </td>
                                            <td class="table-actions text-right">
                                                <a href="javascript: void(0)" class="table-action table-action-cp email-list-edit"
                                                   data-target="{{ secure_redirect(route('email-lists.edit', ['emailList' => $email_list->id])) }}"
                                                   data-toggle="tooltip" data-original-title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript: void(0)" class="table-action table-action-cp email-list-export"
                                                   data-target="{{ secure_redirect(route('email-lists.show', ['emailList' => $email_list->id])) }}"
                                                   data-toggle="tooltip" data-original-title="Export" target="_blank">
                                                    <i class="fas fa-file-export"></i>
                                                </a>
                                                <a href="javascript: void(0)" class="table-action table-action-delete email-list-clear" data-id="{{ $email_list->id }}"
                                                   data-toggle="modal" data-target="#clear-list-modal">
                                                    <span data-toggle="tooltip" data-placement="top" title="Clear" class="w-100 h-100">
                                                        <i class="fas fa-eraser"></i>
                                                    </span>
                                                </a>
                                                <a href="javascript: void(0)" data-id="{{ $email_list->id }}" class="table-action table-action-delete email-list-delete"
                                                   data-toggle="modal" data-target="#delete-list-modal">
                                                    <span data-toggle="tooltip" data-placement="top" title="Delete" class="w-100 h-100">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th scope="row" colspan="5" class="text-center">
                                            You have no Email Lists. Please add an Email List by clicking the [New Email List] button
                                        </th>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- Card footer -->
                        <div class="card-footer py-4">
                            {{ $email_lists->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="delete-list-modal" tabindex="-1" role="dialog" aria-labelledby="delete-list-modal" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Delete Email List</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h1>Are you sure?</h1>
                            <p>You will lose all captured emails to this Email List. You will not be able to restore this Email List.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-capitalize" id="deleteList">Delete</button>
                            <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="clear-list-modal" tabindex="-1" role="dialog" aria-labelledby="clear-list-modal" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Clear Email List</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h1>Are you sure?</h1>
                            <p>You will lose all captured emails to this Email List. You will not be able to restore this captured emails to this Email List.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-capitalize" id="clearList">Clear</button>
                            <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
