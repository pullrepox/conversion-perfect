@extends('layouts.base')
@section('title', 'Autoresponder - ' . config('app.name'))
@section('content')
    <div class="main-content" id="auto-responder-list-panel">
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
                                <h3 class="mb-0 col">Autoresponders</h3>
                                <div class="col text-right">
                                    <a href="{{ secure_redirect(route('autoresponder.create')) }}" class="btn btn-success btn-sm text-capitalize">New Autoresponder</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Light table -->
                        <div class="table-responsive custom-table">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Service</th>
                                    <th>Added</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (sizeof($integrations) > 0)
                                    @foreach($integrations as $integration)
                                        <tr>
                                            <td>{{$integration->name}}</td>
                                            <td>{{$integration->responder->title}}</td>
                                            <td>{{$integration->created_at->diffForHumans()}}</td>
                                            <td class="table-actions text-right">
                                                <a href="{{ route('autoresponder.edit', $integration->id) }}" class="table-action table-action-cp"
                                                   data-toggle="tooltip"
                                                   data-original-title="Edit Bar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript: void(0)"
                                                   class="delete-btn table-action table-action-delete bar-delete"
                                                   data-toggle="modal"
                                                   data-id="{{ $integration->id }}"
                                                   data-target="#delete-modal">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            You have no Autoresponders. Please add an Autoresponder by clicking the [New Autoresponder] button
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Delete Autoresponder</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h1>Are you sure?</h1>
                            <p>Once deleted, you won't be able to revert this Autoresponder.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Cancel</button>
                            <form method="POST" class="form-inline d-inline"
                                  action="">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger text-capitalize" id="deleteTracker">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('.delete-btn').on('click', function (event) {
                var id = $(this).data('id');
                var modal = $('#delete-modal');
                modal.find('form').attr('action', '/autoresponder/' + id);
            })
        })
    </script>
@endsection
