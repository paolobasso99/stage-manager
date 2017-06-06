@extends('voyager::bread.read')

@section('content')
    <div class="page-content container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-bordered" style="padding-bottom:5px;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Status</h3>
                    </div>
                    <div class="panel-body" style="padding-top:0;">
                        @if ($site->down_from == null)
                            <p class="text-success">
                                <i class="voyager-check"></i> <strong>Online</strong>
                            </p>
                        @else
                            <p class="text-danger">
                                <i class="voyager-x"></i> <strong>Offline from {{ $site->down_from }}</strong>
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

            <div class="col-md-6">
                <div class="col-md-5">
                    <label for="downPerMonth">
                        <h4>Online and offline time</h4>
                    </label>
                    <canvas id="onlineTime" width="300" height="300"></canvas>
                </div>

                <div class="col-md-7">
                    <label for="downPerMonth">
                        <h4>Average load speed</h4>
                    </label>
                    <canvas id="loadSpeed" width="300" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs sites-tabs">
          <li role="presentation" class="active">
              <a data-toggle="tab" href="#datas">Other datas</a>
          </li>

          @if (count($contacts) > 0)
              <li role="presentation">
                  <a data-toggle="tab" href="#contacts">contacts</a>
              </li>
          @endif

          @if ($hasSsh)
              <li role="presentation">
                  <a data-toggle="tab" href="#console">SSH console</a>
              </li>

              @if ($hasDatabase)
                  <li role="presentation">
                      <a data-toggle="tab" href="#database">Database</a>
                  </li>
              @endif

              @if ($hasNginxConfiguration)
                  <li role="presentation">
                      <a data-toggle="tab" href="#nginx">Nginx configuration</a>
                  </li>
              @endif
              @if ($hasCrontab)
                  <li role="presentation">
                      <a data-toggle="tab" href="#crontab">Crontab</a>
                  </li>
              @endif
          @endif
        </ul>

        <div class="tab-content panel panel-bordered">

            <div id="datas" class="tab-pane active">

                <div class="panel-heading" style="border-bottom:0;">
                    <h3 class="panel-title">Other datas</h3>
                </div>
                <div class="panel-body" style="padding-top:0;">
                    @parent
                </div>
            </div>

            @if (count($contacts) > 0)
            <div id="contacts" class="tab-pane">

                <div class="panel-heading" style="border-bottom:0;">
                    <h3 class="panel-title">contacts</h3>
                </div>
                <div class="panel-body" style="padding-top:0;">

                    <ul class="list-inline">
                        @foreach ($contacts as $contact)

                            <li class="label label-default">
                                {{ $contact->address }}
                            </li>

                        @endforeach
                    </ul>

                </div>
            </div>
            @endif

            @if ($hasSsh)
                <div id="console" class="tab-pane">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">SSH console</h3>
                    </div>
                    <div class="panel-body" style="padding-top:0;">
                        <form id="ssh-form" action="{{ route('ssh') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <span>
                                    {{ '[' . $site->server->ssh_username . '@' . parse_url($site->url, PHP_URL_HOST) . ']#' }}
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

                @if ($hasDatabase)
                    <div id="database" class="tab-pane">

                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">Database</h3>
                        </div>
                        <div class="panel-body" style="padding-top:0;">
                            <div class="row">

                                <div class="col-md-6">
                                    <a href="{{ route('dumps.download', $site) }}" target="_blank" class="btn btn-primary">
                                        <i class="voyager-download"></i> Download dump
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('dumps.upload', $site) }}" method="post" enctype="multipart/form-data">
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

                @if ($hasNginxConfiguration)
                    <div id="nginx" class="tab-pane">

                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">Sites available</h3>
                        </div>
                        <div class="panel-body" style="padding-top:0;">
                            <div class="row">

                                <div class="col-md-6">
                                    <a href="{{ route('sites-available.download', $site) }}" target="_blank" class="btn btn-primary">
                                        <i class="voyager-download"></i> Download {{ $site->domain }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('sites-available.upload', $site) }}" method="post" enctype="multipart/form-data">
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

                @if ($hasNginxConfiguration)
                    <div id="crontab" class="tab-pane">

                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">Crontab</h3>
                        </div>
                        <div class="panel-body" style="padding-top:0;">
                            <div class="row">

                                <div class="col-md-6">
                                    <a href="{{ route('crontab.download', $site) }}" target="_blank" class="btn btn-primary">
                                        <i class="voyager-download"></i> Download crontab
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('crontab.upload', $site) }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <input class="btn btn-default" type="file" name="file" id="file" />
                                        </div>

                                        <div class="form-group" style="margin: 0px;">

                                            <input class="btn btn-primary" type="submit" name="submit" value="Upload crontab">
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

            @endif
        </div>

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
            },
            options: {
                legend: {
                    display: false
                }
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
