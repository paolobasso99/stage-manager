@extends('voyager::bread.read')

@section('content')
    @parent

    <div class="page-content container-fluid">
        <h2>Stats</h2>

        <div class="col-md-6">
            <canvas id="pieChart" width="400" height="400"></canvas>
        </div>

        <div class="col-md-6">
            <div class="panel panel-bordered" style="padding-bottom:5px;">

                <div class="panel-heading" style="border-bottom:0;">
                    <h3 class="panel-title">Status</h3>
                </div>
                <div class="panel-body" style="padding-top:0;">
                    <p>
                        @if ($site->down_from == null)
                            Online
                        @else
                            Offline from {{ $site->down_from }}
                        @endif
                    </p>
                </div>

                <hr style="margin:0;">

                <div class="panel-heading" style="border-bottom:0;">
                    <h3 class="panel-title">Last time down</h3>
                </div>
                <div class="panel-body" style="padding-top:0;">
                    <p>
                        @if (count($site->downtimes()->first() > 0))
                            {{ $site->downtimes()->first() }}
                        @else
                            Never been offline.
                        @endif
                    </p>
                </div>

                <hr style="margin:0;">

                <div class="panel-heading" style="border-bottom:0;">
                    <h3 class="panel-title">Total online time</h3>
                </div>
                <div class="panel-body" style="padding-top:0;">
                    <p>
                        {{ $site->getOnlineTime() }}
                    </p>
                </div>

                <hr style="margin:0;">

                <div class="panel-heading" style="border-bottom:0;">
                    <h3 class="panel-title">Total offline time</h3>
                </div>
                <div class="panel-body" style="padding-top:0;">
                    <p>
                        {{ $site->getOfflineTime() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @parent

    <!-- Chart.js -->
    <script src="{{ asset('js/Chart.bundle.min.js') }}"></script>
    <script>
        var pieChart = new Chart($("#pieChart"), {
            type: 'pie',
            data: {
                labels: ["Offline", "Online"],
                datasets: [{
                    data: [
                        {{ $site->getOnlineTime() }},
                        {{ $site->getOfflineTime() }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
@stop
