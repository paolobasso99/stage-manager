@extends('voyager::bread.read')

@section('content')
    @parent

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
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
                            @if ($site->down_from == null)
                                <p class="text-success">
                                    <strong>Online</strong>
                                </p>
                            @else
                                <p class="text-danger">
                                    <strong>Offline from {{ $site->down_from }}</strong>
                                </p>
                            @endif
                        </div>

                        <hr style="margin:0;">

                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">Last time down</h3>
                        </div>
                        <div class="panel-body" style="padding-top:0;">
                            <p>
                                @if (count($site->downtimes()->first()) > 0)
                                    {{ $site->downtimes()->first()->end_at }}
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
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2>Emails</h2>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            @foreach ($emails as $email)

                                <li>
                                    {{ $email->address }}
                                </li>

                            @endforeach
                        </ul>
                    </div>
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
                labels: ["Online", "Offline"],
                datasets: [{
                    data: [
                        {{ $site->getOnlineTime() }},
                        {{ $site->getOfflineTime() }}
                    ],
                    backgroundColor: [
                        'rgba(47, 237, 118, 0.8)',
                        'rgba(204, 40, 40, 0.8)',
                    ],
                    borderColor: [
                        'rgba(47, 237, 118, 1)',
                        'rgba(204, 40, 40, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
@stop
