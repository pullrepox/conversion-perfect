@extends('layouts.base')
@section('title', 'Auto Responder - ' . config('app.name'))
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
                                <h3 class="mb-0 col">Auto Responders</h3>
                                <div class="col text-right">
                                    <a href="{{ secure_redirect(route('autoresponder.create')) }}" class="btn btn-success btn-sm text-capitalize">New AutoResponder</a>
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
                                            <td class="table-actions">
                                                <form method="POST" class="form-inline  d-inline"
                                                      action="">
                                                    @csrf
                                                    <button type="submit" href="#!"
                                                            class="table-action  bg-transparent border-0" data-toggle="tooltip"
                                                            data-original-title="">
{{--                                                                                                        <i class="fas fa-{{$bar->status?'pause text-red':'play text-green'}}"></i>--}}
                                                    </button>
                                                </form>
                                                <a href="{{route('autoresponder.edit',$integration->id)}}" class="table-action"
                                                   data-toggle="tooltip"
                                                   data-original-title="Edit Bar">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form method="POST" class="form-inline d-inline"
                                                      action="">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{csrf_field()}}
                                                    <button type="submit"
                                                            class="delete-btn table-action table-action-delete bg-transparent border-0"
                                                            data-toggle="tooltip"
                                                            data-original-title="Delete Bar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th scope="row" colspan="8" class="text-center">Auto Responder data does not exist</th>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- Card footer -->
                        <div class="card-footer py-4">
{{--                            {{ $bars->links() }}--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Delete Link</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h1>Are you sure?</h1>
                            <p>Once deleted, you won't be able to revert this bar.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-capitalize" id="deleteTracker">Delete</button>
                            <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection
