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
                        <h4>{{ $counter['contacts'] }} Contacts</h4>
                        <a href="{{ route('voyager.contacts.index') }}" class="btn btn-primary">View contacts</a>
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
                        @if ($lastDown != null)
                            {{ $lastDown->end_at }}
                        @else
                            There is no down recorded
                        @endif
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Today average speed</h3>
                    </div>
                    <div class="panel-body" style="padding-top:0;">
                        {{ $loadTimePerDay[\Carbon\Carbon::now()->format('l')] }} seconds
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-6">
                    <label for="downPerMonth">
                        <h4>Down times</h4>
                    </label>
                    <canvas id="downPerMonth" width="400" height="400"></canvas>
                </div>
                <div class="col-md-6">
                    <label for="downPerMonth">
                        <h4>Average load speed</h4>
                    </label>
                    <canvas id="loadTimePerDay" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    @parent

    <!-- Chart.js -->
    <script>
        var downPerMonth = new Chart($("#downPerMonth"), {
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

        var loadTimePerDay = new Chart($("#loadTimePerDay"), {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($loadTimePerDay as $day => $time)
                        '{{$day}}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach ($loadTimePerDay as $day => $time)
                            {{ $time }},
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
