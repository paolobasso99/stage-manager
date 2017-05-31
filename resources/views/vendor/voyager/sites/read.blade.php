@extends('voyager::bread.read')

@section('content')
    @parent

    <div class="page-content container-fluid">
        @if ($hasSsh)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered" style="padding-bottom:5px;">

                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">SSH console</h3>
                        </div>
                        <div class="panel-body" style="padding-top:0;">
                            <form id="ssh-form" action="{{ route('ssh') }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <span>
                                        {{ '[' . $site->ssh_username . '@' . parse_url($site->url, PHP_URL_HOST) . ']#' }}
                                    </span>
                                    <input autocomplete="off" id="ssh-input" type="text" name="ssh-input" value="">
                                </div>

                                <div class="form-group" style="margin: 0px;">
                                    <div id="ssh-output"></div>

                                    <input class="sr-only" id="ssh-submit" type="submit" name="submit" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if ($hasDump)
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-bordered" style="padding-bottom:5px;">

                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Database</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <a href="{{ route('dumps.download', $site) }}" target="_blank" class="btn btn-primary">
                                    Download dump
                                </a>
                                <hr>
                                <form class="form-inline" action="{{ route('dumps.upload', $site) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <input class="btn btn-default" type="file" name="file" id="file" />
                                    </div>

                                    <div class="form-group" style="margin: 0px;">

                                        <input class="btn btn-primary" type="submit" name="submit" value="Upload dump">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($hasSitesAvailable)
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-bordered" style="padding-bottom:5px;">

                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Sites available</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <a href="{{ route('sites-available.download', $site) }}" target="_blank" class="btn btn-primary">
                                    Get {{ $site->domain }}
                                </a>
                                <hr>
                                <form class="form-inline" action="{{ route('sites-available.upload', $site) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <input class="btn btn-default" type="file" name="file" id="file" />
                                    </div>

                                    <div class="form-group" style="margin: 0px;">

                                        <input class="btn btn-primary" type="submit" name="submit" value="Upload {{ $site->domain }}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        @endif

        <div class="row">
            <div class="col-md-12">
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
                            {{ $site->getOnlineTime() }} minutes
                        </p>
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Total offline time</h3>
                    </div>
                    <div class="panel-body" style="padding-top:0;">
                        <p>
                            {{ $site->getOfflineTime() }} minutes
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-5">
                    <canvas id="onlineTime" width="300" height="300"></canvas>
                </div>

                <div class="col-md-7">
                    <canvas id="loadSpeed" width="300" height="300"></canvas>
                </div>
            </div>
        </div>

        @if (count($emails) > 0)
            <div class="row">
                <div class="col-md-12">
                    <h2>Emails</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="list-inline">
                                @foreach ($emails as $email)

                                    <li class="label label-default">
                                        {{ $email->address }}
                                    </li>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection

@section('javascript')
    @parent

    @if ($hasSsh)
        <!-- SSH -->
        <script>

            $("#ssh-form").submit(function(e){
                console.log('Submit comand ...');
                e.preventDefault();

                axios({
                    method:'post',
                    url: '{{ route('ssh') }}',
                    data: {
                        command: $('#ssh-input').val(),
                        site_id: {{ $site->id }}
                    }
                }).then(function (response) {
                        $('#ssh-output').html(response.data);
                        console.log(response);
                });
            });

        </script>
    @endif

    <!-- Chart.js -->
    <script>
        var onlineTime = new Chart($("#onlineTime"), {
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

        var loadSpeed = new Chart($("#loadSpeed"), {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($loadTimePerDay as $day => $time)
                        '{{ $day }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach ($loadTimePerDay as $day => $time)
                            {{ $time }},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 27, 75, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(151, 255, 102, 1)',
                        'rgba(234, 102, 255, 1)'
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
