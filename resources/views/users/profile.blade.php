@extends('layouts.base')
@section('title', 'Account - ' . config('app.name'))
@section('content')
    <div class="main-content">
        @include('layouts.page-header', ['data' => $header_data])
        {{-- Page content --}}
        <div class="container-fluid mt--8">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">Account Information</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive custom-table">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Subdomain</th>
                            <th>JVZoo Affiliate ID</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ auth()->user()->name_f }}</td>
                            <td>{{ auth()->user()->name_l }}</td>
                            <td>{{ auth()->user()->email }}</td>
                            <td>{{ auth()->user()->subdomain }}</td>
                            <td class="table-actions">
                                <a class="table-action" href="https://www.jvzoo.com/affiliates/info/332174" target="_blank">apply here</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mt--3">
                <div class="card-header">
                    <h3 class="mb-0">Base Plan</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        @if (array_search(config('site.standard_plan_id')[0], $am_plans) !== false)
                            <div class="col-md-3">
                                <a href="https://www.jvzoo.com/b/0/{{ json_decode($upgrades, true)['standard']['jvzooid'] }}/14" target="_blank" class="btn btn-primary btn-cp-default">
                                    <i class="fas fa-arrow-alt-circle-up"></i> {{ json_decode($upgrades, true)['standard']['description'] }}
                                </a>
                            </div>
                        @endif
                        @if (array_search(config('site.social_plan_id')[0], $am_plans) !== false || array_search(config('site.social_plan_id')[1], $am_plans) !== false)
                            <div class="col-md-3">
                                <a href="https://www.jvzoo.com/b/0/{{ json_decode($upgrades, true)['social-unlimited']['jvzooid'] }}/14" target="_blank"
                                   class="btn btn-success btn-cp-default">
                                    <i class="fas fa-arrow-alt-circle-up"></i> {{ json_decode($upgrades, true)['social-unlimited']['description'] }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card mt--3">
                <div class="card-header">
                    <h3 class="mb-0">Purchased Upgrades</h3>
                </div>
                <div class="card-body">
                
                </div>
            </div>
            <div class="card mt--3">
                <div class="card-header">
                    <h3 class="mb-0">Upgrades Available</h3>
                </div>
                <div class="card-body">
                
                </div>
            </div>
        </div>
    </div>
@endsection

