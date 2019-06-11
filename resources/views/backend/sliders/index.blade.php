@extends('backend.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card-wrapper">
                <!-- Custom form validation -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0 fa-pull-left">Sliders</h3>
                        <span class="btn btn-primary fa-pull-right"><a href="{{route('sliders.create')}}"><h3
                                        class="mb-0">Create New</h3></a></span>
                    </div>
                    <!-- Card body -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Heading</th>
                                <th>Type</th>
                                <th>Link Click</th>
                                <th>Email Option</th>
                                <th>Total Views</th>
                                <th>Unique Views</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <td class="table-user">
                                        {{$slider->name}}
                                    </td>
                                    <td>
                                       {{$slider->heading}}
                                    </td>
                                    <td>
                                       {{$slider->type}}
                                    </td>
                                     <td>
                                       {{$slider->link_click}}
                                    </td>
                                     <td>
                                       {{$slider->email_options}}
                                    </td>
                                     <td>
                                       {{$slider->total_views}}
                                    </td>
                                     <td>
                                       {{$slider->unique_views}}
                                    </td>
                                    <td class="table-actions">
                                        <a href="#!" class="table-action" data-toggle="tooltip"
                                           data-original-title="Pause Slider">
                                            <i class="fas fa-pause"></i>
                                        </a>
                                         <a href="{{route('slider.edit',$slider->id)}}" class="table-action" data-toggle="tooltip"
                                           data-original-title="Edit Slider">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                         <a href="#!" class="table-action" data-toggle="tooltip"
                                           data-original-title="View Slider">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                         <a href="#!" class="table-action" data-toggle="tooltip"
                                           data-original-title="Clone Slider">
                                            <i class="fas fa-clone"></i>
                                        </a>
                                         <a href="#!" class="table-action" data-toggle="tooltip"
                                           data-original-title="Get Code">
                                            <i class="fas fa-code"></i>
                                        </a>
                                         <a href="#!" class="table-action" data-toggle="tooltip"
                                           data-original-title="Clear Stat">
                                            <i class="fas fa-battery-empty"></i>
                                        </a>
                                        <a href="#!" class="table-action table-action-delete" data-toggle="tooltip"
                                           data-original-title="Delete Slider">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav aria-label="..." class="fa-pull-right">
                            {{$sliders->links()}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection