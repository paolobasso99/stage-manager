@extends('voyager::bread.read')

@section('content')
    <div class="page-content container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    @parent
                </div>
            </div>

        </div>

        @if ($has['console'] || $has['crontab'])
            <!-- Tabs -->
            <ul class="nav nav-tabs sites-tabs">

              @if ($has['console'])
                  <li role="presentation" class="active">
                      <a data-toggle="tab" href="#console">SSH console</a>
                  </li>
              @endif
              @if ($has['crontab'])
                  <li role="presentation">
                      <a data-toggle="tab" href="#crontab">Crontab</a>
                  </li>
              @endif

            </ul>


            <div class="tab-content panel panel-bordered">

                @if ($has['console'])
                    <div id="console" class="tab-pane active">

                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">SSH console</h3>
                        </div>
                        <div class="panel-body" style="padding-top:0;">
                            <form id="ssh-form" action="{{ route('ssh', ['server' => $server]) }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <span>
                                        {{ '[' . $server->ssh_username . '@' . $server->ip . ']#' }}
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
                @endif

                @if ($has['crontab'])
                    <div id="crontab" class="tab-pane">

                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">Crontab</h3>
                        </div>
                        <div class="panel-body" style="padding-top:0;">
                            <div class="row">

                                <div class="col-md-6">
                                    <a href="{{ route('crontab.download', $server) }}" target="_blank" class="btn btn-primary">
                                        <i class="voyager-download"></i> Download
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('crontab.upload', $server) }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <input class="btn btn-default" type="file" name="file" id="file" />
                                        </div>

                                        <div class="form-group" style="margin: 0px;">

                                            <input class="btn btn-primary" type="submit" name="submit" value="Upload">
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

            </div>
        @endif

    </div>
@endsection

@section('javascript')
    @parent

    @if ($has['console'])
        <!-- SSH -->
        <script>

            $("#ssh-form").submit(function(e){
                console.log('Submit comand ...');
                e.preventDefault();

                axios({
                    method:'post',
                    url: '{{ route('ssh', ['server' => $server]) }}',
                    data: {
                        server_id: {{ $server->id }},
                        command: $('#ssh-input').val()
                    }
                }).then(function (response) {
                        $('#ssh-output').html(response.data);
                        console.log(response);
                });
            });

        </script>
    @endif
@stop
