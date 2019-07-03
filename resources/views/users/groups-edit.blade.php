@extends('layouts.base')
@section('title', 'Group Edit - ' . config('app.name'))
@section('content')
    <div class="main-content" id="group-edit-page" v-cloak>
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
                            <h3 class="mb-0 col">{{ $flag ? 'New' : 'Edit' }} Group</h3>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success btn-sm text-capitalize">{{ $flag ? 'Create' : 'Update' }}</button>
                                <a href="{{ secure_redirect(route('groups')) }}" class="btn btn-light btn-sm text-capitalize">
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
                                    <label class="form-control-label ml-1" for="name" data-id="name">
                                        Group Name
                                    </label>
                                    <input type="text" id="name" name="name" v-model="model.name" class="form-control @error('name') is-invalid @enderror"
                                           required autocomplete="name" @input="changed_status = true" placeholder="Group Name" />
                                    @if ($errors->has('name'))
                                        @error('name')
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
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="notes" data-id="notes">
                                        Notes
                                    </label>
                                    <textarea v-model="model.notes" class="form-control" id="notes" name="notes" rows="1"
                                              @input="changed_status = true" placeholder="Notes"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label ml-1" for="tags" data-id="tags">
                                        Tags
                                    </label>
                                    <div class="tags-area">
                                        <input type="text" id="tags" name="tags" data-toggle="tags" class="form-control"
                                               v-model="model.tags" @input="changed_status = true"/>
                                    </div>
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
        window._group_opt_ary = {
            group_id: "{{ $flag ? '' : $group->id }}",
            create_edit: "{{ $flag }}",
            model: {
                name: "{{ (old('name') ? old('name') : ($flag ? '' : $group->name)) }}",
                notes: "{{ (old('notes') ? old('notes') : ($flag ? '' : $group->notes)) }}",
                tags: "{{ (old('tags') ? old('tags') : ($flag ? '' : $group->tags)) }}",
            }
        };
    </script>
    <script type="text/javascript" src="{{ url(mix('js/group-edit.js')) }}"></script>
@stop
