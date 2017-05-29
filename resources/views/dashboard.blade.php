@extends('voyager::master')

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-4">
                <div class="panel widget center bgimage" style="margin:0px;">
                    <div class="dimmer"></div>
                    <div class="panel-content">
                        <i class='voyager-browser'></i>
                        <h4>{{ $counter['sites'] }} Sites</h4>
                        <a href="{{ route('voyager.sites.index') }}" class="btn btn-primary">View sites</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel widget center bgimage" style="margin:0px;">
                    <div class="dimmer"></div>
                    <div class="panel-content">
                        <i class='voyager-person'></i>
                        <h4>{{ $counter['users'] }} Users</h4>
                        <a href="{{ route('voyager.users.index') }}" class="btn btn-primary">View users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel widget center bgimage" style="margin:0px;">
                    <div class="dimmer"></div>
                    <div class="panel-content">
                        <i class='voyager-mail'></i>
                        <h4>{{ $counter['emails'] }} Emails</h4>
                        <a href="{{ route('voyager.emails.index') }}" class="btn btn-primary">View emails</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h2>Stats</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <canvas id="chart" width="400" height="400"></canvas>
            </div>
            <div class="col-md-6">
                <div class="panel panel-bordered" style="padding-bottom:5px;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Total down times</h3>
                    </div>
                    <div class="panel-body" style="padding-top:0;">
                        {{ $counter['downTimes'] }}
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Last down</h3>
                    </div>
                    <div class="panel-body" style="padding-top:0;">
                        {{ $lastDown->end_at }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    @parent

    <!-- Chart.js -->
    <script>
        var chart = new Chart($("#chart"), {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($downPerMonth as $month => $times)
                        '{{$month}}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach ($downPerMonth as $month => $times)
                            {{ $times }},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ]
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    </script>
@stop
