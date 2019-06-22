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
                            @foreach($sliders as $slider)
                                <tr>
                                    <td class="table-user">{{$slider->name}}</td>
                                    <td>{{$slider->heading}}</td>
                                    <td>{{$slider->type}}</td>
                                     <td>{{$slider->link_click}}</td>
                                     <td>{{$slider->email_options}}</td>
                                     <td>{{$slider->total_views}}</td>
                                     <td>{{$slider->unique_views}}</td>
                                    <td class="table-actions">
                                        <form method="POST" class="form-inline  d-inline" action="{{route('sliders.toggle-status',$slider->id)}}">
                                            {{csrf_field()}}
                                            <button type="submit" href="#!" class="table-action  bg-transparent border-0" data-toggle="tooltip"
                                               data-original-title="{{$slider->status?'Pause':'Activate'}} Slider ?">
                                                <i class="fas fa-{{$slider->status?'pause text-red':'play text-green'}}"></i>
                                            </button>
                                        </form>
                                         <a href="{{route('sliders.edit',$slider->id)}}" class="table-action" data-toggle="tooltip"
                                           data-original-title="Edit Slider">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                         <a href="{{route('sliders.preview',$slider->id)}}" class="table-action" data-toggle="tooltip"
                                           data-original-title="View Slider">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                         <a href="{{route('sliders.clone',$slider->id)}}" class="table-action" data-toggle="tooltip"
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
                                        <form method="POST" class="form-inline d-inline" action="{{route('sliders.destroy',$slider->id)}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}
                                            <button  type="submit" class="delete-btn table-action table-action-delete bg-transparent border-0" data-toggle="tooltip"
                                               data-original-title="Delete Slider">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
        $(function(){
            $('.table-responsive').on('click','.delete-btn',function(e){
                e.preventDefault();
                Swal.fire({
                    title: 'Do you want to Delete?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.value) {
                        $(this).closest('form').submit();
                    }
                })

            });
        });

    </script>
@endsection
