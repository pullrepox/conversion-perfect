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
                                <h3 class="mb-0 col">Bars</h3>
                                <div class="col text-right">
                                    <a href="{{ secure_redirect(route('bars.create')) }}" class="btn btn-success btn-sm text-capitalize">New Bar</a>
                                </div>
                            </div>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive custom-table">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Bar Name</th>
                                    <th>Created</th>
                                    <th>Type</th>
                                    <th>Link Clicks</th>
                                    <th>Email Options</th>
                                    <th>Total Views</th>
                                    <th>Unique Views</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (sizeof($bars) > 0)
                                    @foreach($bars as $bar)
                                        <tr>
                                            <td class="table-user">{{$bar->name}}</td>
                                            <td>{{$bar->heading}}</td>
                                            <td>{{$bar->type}}</td>
                                            <td>{{$bar->link_click}}</td>
                                            <td>{{$bar->email_options}}</td>
                                            <td>{{$bar->total_views}}</td>
                                            <td>{{$bar->unique_views}}</td>
                                            <td class="table-actions">
                                                <form method="POST" class="form-inline  d-inline"
                                                      action="{{route('bars.toggle-status', $bar->id)}}">
                                                    @csrf
                                                    <button type="submit" href="#!"
                                                            class="table-action  bg-transparent border-0" data-toggle="tooltip"
                                                            data-original-title="{{ $bar->status ? 'Pause' : 'Activate' }} Slider?">
                                                        <i class="fas fa-{{$bar->status?'pause text-red':'play text-green'}}"></i>
                                                    </button>
                                                </form>
                                                <a href="{{route('bars.edit',$bar->id)}}" class="table-action"
                                                   data-toggle="tooltip"
                                                   data-original-title="Edit Slider">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <a href="{{route('bars.preview',$bar->id)}}" class="table-action"
                                                   data-toggle="tooltip"
                                                   data-original-title="View Slider">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{route('bars.clone',$bar->id)}}" class="table-action"
                                                   data-toggle="tooltip"
                                                   data-original-title="Clone Slider">
                                                    <i class="fas fa-clone"></i>
                                                </a>
                                                <a href="#!" data-code="{{getSliderCode($bar)}}"
                                                   class="table-action slider-code-btn" data-toggle="tooltip"
                                                   data-original-title="Get Code">
                                                    <i class="fas fa-code"></i>
                                                </a>
                                                <a href="{{route('bars.clear-stats',$bar->id)}}"
                                                   class="table-action clear-stats-btn" data-toggle="tooltip"
                                                   data-original-title="Clear Stat">
                                                    <i class="fas fa-battery-empty"></i>
                                                </a>
                                                <form method="POST" class="form-inline d-inline"
                                                      action="{{route('bars.destroy',$bar->id)}}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{csrf_field()}}
                                                    <button type="submit"
                                                            class="delete-btn table-action table-action-delete bg-transparent border-0"
                                                            data-toggle="tooltip"
                                                            data-original-title="Delete Slider">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th scope="row" colspan="8" class="text-center">Tracker data does not exist</th>
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
