@extends('layouts.base')
@section('title', 'Split Test - ' . config('app.name'))
@section('content')
    <div class="main-content" id="bar-list-panel">
        @include('layouts.page-header', ['data' => $header_data])
        <div class="container-fluid mt--8">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row">
                        <h3 class="mb-0 col">{{ $header_data['main_name'] }}</h3>
                        <div class="col text-right">
                            <a href="{{ secure_redirect(route('split-tests.create')) }}" class="btn btn-success btn-sm text-capitalize">Add Split Test</a>
                        </div>
                    </div>
                </div>
                <!-- Light table -->
                <div class="table-responsive" data-toggle="list" data-list-values='["name", "bar_name", "created_at"]'>
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" class="sort" data-sort="name">Description</th>
                            <th scope="col" data-sort="bar_name">Conversion Bar</th>
                            <th scope="col" class="sort" data-sort="created_at">Created</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @if (sizeof($split_tests) > 0)
                            <tr>
                                <td class="table-actions">
                                
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="table-actions text-right">
                                
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="5" class="text-center">
                                    You have no Split Tests. Please add a Split Tests by clicking the [Add Split Test] button.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    {{ $split_tests->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
