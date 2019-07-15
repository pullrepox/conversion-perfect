@extends('layouts.base')
@section('title', 'Choose Template - ' . config('app.name'))
@section('content')
    <div class="main-content" id="template-list-panel">
        @include('layouts.page-header', ['data' => $header_data])
        <div class="container-fluid mt--8">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row">
                        <h3 class="mb-0 col">{{ $header_data['main_name'] }}</h3>
                        <div class="col text-right">
                            <a href="{{ secure_redirect(route('bars.create', ['flag' => 'new'])) }}" class="btn btn-success btn-sm text-capitalize">Create New</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive custom-table">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th></th>
                            <th>Template Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (sizeof($template_list) > 0)
                            @foreach($template_list as $bar)
                                <tr>
                                    <td class="table-action w-50">
                                        @if (\Illuminate\Support\Facades\Storage::exists('bars/options/' . $bar->id . '/temp_thumb_' . $bar->id . '.png'))
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url('bars/options/' . $bar->id . '/temp_thumb_' . $bar->id . '.png') }}"
                                                 alt="Template thumbnail" class="img-thumbnail img-fluid" style="width: 400px;"/>
                                        @else
                                            <div class="img-thumbnail" style="width: 400px; height: 40px;"></div>
                                        @endif
                                    </td>
                                    <td class="table-user">{{ $bar->template_name }}</td>
                                    <td class="table-actions text-right" style="width: 90px;">
                                        <a href="{{ secure_redirect(route('bars.create', ['flag' => 'template_edit', 'number' => $bar->id])) }}" class="table-action table-action-cp"
                                           data-toggle="tooltip" data-original-title="Customize">
                                            <i class="fas fa-copy"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">
                                    You have no Conversion Bar Templates. Please add a Conversion Bar by clicking the [Create New] button.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection
