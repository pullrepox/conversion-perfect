@extends('layouts.base')
@section('title', 'Bars Report - ' . config('app.name'))
@section('content')
    <div class="main-content">
        @include('layouts.page-header', ['data' => $header_data])
        {{-- Page content --}}
        <div class="container-fluid mt--8">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row">
                        <h3 class="mb-0 col">{{ $header_data['main_name'] }}</h3>
                        <div class="col text-right">
                            <a href="{{ secure_redirect(route('bars')) }}" class="btn btn-light btn-sm text-capitalize">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Light table -->
                <div class="table-responsive custom-table">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th>Friendly Name</th>
                            <th>Total Visitors</th>
                            <th>Unique Visitors</th>
                            <th>Button Clicks</th>
                            <th>Lead Captures</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $bar->friendly_name }}</td>
                            <td>
                                {{ $total_sum[0] }}
                            </td>
                            <td>
                                {{ $total_sum[1] }} ({{ $total_sum[0] > 0 ? round((($total_sum[1] / $total_sum[0]) * 100), 2) : 0 }}%)
                            </td>
                            <td>
                                {{ $total_sum[2] }} ({{ $total_sum[0] > 0 ? round((($total_sum[2] / $total_sum[0]) * 100), 2) : 0 }}%)
                            </td>
                            <td>
                                {{ $total_sum[3] }} ({{ $total_sum[0] > 0 ? round((($total_sum[3] / $total_sum[0]) * 100), 2) : 0 }}%)
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card bg-default">
                <!-- Card header -->
                <div class="card-header bg-transparent">
                    <div class="row">
                        <h3 class="mb-0 col text-white">Statistics</h3>
                        <div class="col text-right">
                            <div class="btn-group" role="group" aria-label="Period">
                                <a href="{{ secure_redirect(route('bars.show', ['bar' => $bar->id, 'report' => true, 'period' => 'day'])) }}"
                                   class="btn btn-info btn-sm {{ $searchParams['period'] == 'day' ? 'active' : '' }}">
                                    Today
                                </a>
                                <a href="{{ secure_redirect(route('bars.show', ['bar' => $bar->id, 'report' => true, 'period' => 'week'])) }}"
                                   class="btn btn-info btn-sm {{ $searchParams['period'] == 'week' ? 'active' : '' }}">
                                    Last 7days
                                </a>
                                <a href="{{ secure_redirect(route('bars.show', ['bar' => $bar->id, 'report' => true, 'period' => 'month'])) }}"
                                   class="btn btn-info btn-sm {{ $searchParams['period'] == 'month' ? 'active' : '' }}">
                                    Last 30days
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart" style="height: 300px;">
                        <!-- Chart wrapper -->
                        <canvas id="chart-bar-logs-dark" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Details</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive custom-table">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th>Domain</th>
                            <th>Unique</th>
                            <th>Address</th>
                            <th>Timestamp</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($bar->logs()->count() > 0)
                            @foreach($log_data as $row)
                                <tr>
                                    <td>{{ $row->domain }}</td>
                                    <td>{{ $row->unique_click ? 'Yes' : 'No' }}</td>
                                    <td>{{ $row->ip_address }}, {{ $row->country_code }}, lat:{{ $row->latitude }}, lon:{{ $row->longitude }}, {{ $row->browser }}, {{ $row->platform }}</td>
                                    <td>{{ $row->created_at }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    {!! str_replace('/?', '?', $log_data->appends($searchParams)->render()) !!}
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        window.__cp_bar_chart_data = JSON.parse('{!! $report_data !!}');
        (function () {
            // Variables
            let $bar_log_chart = $('#chart-bar-logs-dark');
            
            // Methods
            function init($this) {
                let bar_log_chart = new Chart($this, {
                    type: 'line',
                    options: {
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    color: Charts.colors.gray[700],
                                    zeroLineColor: Charts.colors.gray[700]
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    },
                    data: {
                        labels: window.__cp_bar_chart_data.xLabel,
                        datasets: [{
                            label: 'Total Visitor',
                            data: window.__cp_bar_chart_data.totalVisitors,
                            borderColor: window.__cp_chart_colors.theme['primary'],
                            pointBackgroundColor: window.__cp_chart_colors.theme['primary'],
                            pointBorderColor: window.__cp_chart_colors.theme['success'],
                        }, {
                            label: 'Unique Visitor',
                            data: window.__cp_bar_chart_data.uniqueVisitors,
                            borderColor: window.__cp_chart_colors.theme['info'],
                            pointBackgroundColor: window.__cp_chart_colors.theme['info'],
                            pointBorderColor: window.__cp_chart_colors.theme['success'],
                        }, {
                            label: 'Button Clicks',
                            data: window.__cp_bar_chart_data.buttonClicks,
                            borderColor: '#e8ff0f',
                            pointBackgroundColor: '#e8ff0f',
                            pointBorderColor: window.__cp_chart_colors.theme['primary'],
                        }, {
                            label: 'Lead Captures',
                            data: window.__cp_bar_chart_data.leadCaptures,
                            borderColor: '#e574a9',
                            pointBackgroundColor: '#e574a9',
                            pointBorderColor: window.__cp_chart_colors.theme['success'],
                        }]
                    }
                });
                // Save to jQuery object
                $this.data('chart', bar_log_chart);
            }
            
            // Events
            if ($bar_log_chart.length) {
                init($bar_log_chart);
            }
        })();
    </script>
@stop
