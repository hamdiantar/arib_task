@extends('layouts.app')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> {{__('Dashboard')}}</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">{{__('Dashboard')}}</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="widget-small primary coloured-icon">
                    <i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>{{__('Managers')}}</h4>
                        <p><b>{{ $managerCount }}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small primary coloured-icon">
                    <i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>{{__('Employees')}}</h4>
                        <p><b>{{ $employeeCount }}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small info coloured-icon">
                    <i class="icon fa fa-tasks fa-3x"></i>
                    <div class="info">
                        <h4>{{__('Tasks')}}</h4>
                        <p><b>{{ $taskCount }}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small danger coloured-icon">
                    <i class="icon fa fa-sitemap fa-3x"></i>
                    <div class="info">
                        <h4>{{__('Departments')}}</h4>
                        <p><b>{{ $departmentCount }}</b></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">{{__('Employees with Tasks')}}</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">{{__('Task Status Distribution')}}</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('chart')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript">
        var lineChartLabels = @json(array_keys($employeesWithTasks));
        var lineChartData = @json(array_values($employeesWithTasks));
        var lineChartConfig = {
            type: 'line',
            data: {
                labels: lineChartLabels,
                datasets: [{
                    label: 'Tasks Assigned',
                    data: lineChartData,
                    backgroundColor: 'rgba(0,123,255,0.4)',
                    borderColor: 'rgba(0,123,255,1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        var lineChartCtx = document.getElementById('lineChartDemo').getContext('2d');
        new Chart(lineChartCtx, lineChartConfig);

        // Data for pie chart: Task status distribution
        var pieChartLabels = @json(array_keys($taskStatusData));
        var pieChartData = @json(array_values($taskStatusData));

        var pieChartConfig = {
            type: 'pie',
            data: {
                labels: pieChartLabels,
                datasets: [{
                    label: 'Task Status',
                    data: pieChartData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)', // Color for pending
                        'rgba(54, 162, 235, 0.6)', // Color for in_progress
                        'rgba(75, 192, 192, 0.6)', // Color for completed
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        };

        var pieChartCtx = document.getElementById('pieChartDemo').getContext('2d');
        new Chart(pieChartCtx, pieChartConfig);
    </script>
@endpush
