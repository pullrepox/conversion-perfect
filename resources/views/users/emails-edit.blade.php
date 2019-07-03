@extends('layouts.base')
@section('title', 'Email List Edit - ' . config('app.name'))
@section('content')
    <div class="main-content" id="prod-edit-page" v-cloak>
        @include('layouts.page-header', ['data' => $header_data])
        {{-- Page content --}}
        <div class="container-fluid mt--8">
            <form action="{{ $form_action }}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                @if (!$flag)
                    @method('PUT')
                @endif
                {{-- bar Base Content --}}
                <div class="card">
                    <div class="card-header">
                        <div class="form-row">
                            <h3 class="mb-0 col">{{ $header_data['main_name'] }}</h3>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success btn-sm text-capitalize">{{ $flag ? 'Create' : 'Update' }}</button>
                                <a href="{{ secure_redirect(route('email-lists')) }}" class="btn btn-light btn-sm text-capitalize">
                                    @{{ changed_status ? 'Cancel' : 'Close' }}
                                </a>
                                @if (!$flag)
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Reset Stats</a>
                                            <a class="dropdown-item" href="#">Archive</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="list_name" data-id="name">
                                        List Name
                                    </label>
                                    <input type="text" id="list_name" name="list_name" v-model="model.list_name" class="form-control @error('list_name') is-invalid @enderror"
                                           required autocomplete="list_name" @input="changed_status = true" placeholder="List Name" />
                                    @if ($errors->has('list_name'))
                                        @error('list_name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    @else
                                        <span class="invalid-feedback" role="alert">
                                            Please insert correct value.
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="description" data-id="description">
                                        Description
                                    </label>
                                    <textarea v-model="model.description" class="form-control" id="description" name="description" rows="1"
                                              @input="changed_status = true" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        window._list_opt_ary = {
            list_id: "{{ $flag ? '' : $emailList->id }}",
            create_edit: "{{ $flag }}",
            model: {
                list_name: "{{ (old('list_name') ? old('list_name') : ($flag ? '' : $emailList->list_name)) }}",
                description: "{{ (old('description') ? old('description') : ($flag ? '' : $emailList->description)) }}"
            }
        };
    </script>
    <script type="text/javascript" src="{{ url(mix('js/lists-edit.js')) }}"></script>
@stop
