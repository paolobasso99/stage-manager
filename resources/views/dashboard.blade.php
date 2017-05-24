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
                        <a href="{{ route('voyager.sites.index') }}" class="btn btn-primary">View emails</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel widget center bgimage" style="margin:0px;">
                    <div class="dimmer"></div>
                    <div class="panel-content">
                        <i class='voyager-person'></i>
                        <h4>{{ $counter['users'] }} Users</h4>
                        <a href="{{ route('voyager.users.index') }}" class="btn btn-primary">View emails</a>
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
    </div>

    <div class="col-md-6">
        <canvas id="chart" width="400" height="400"></canvas>
    </div>

@endsection

@section('javascript')
    @parent

    <!-- Chart.js -->
    <script src="{{ asset('js/Chart.bundle.min.js') }}"></script>
    <script>
        var chart = new Chart($("#chart"), {
            type: 'bar',
            data: {
                labels: ["mese1", "mese2"],
                datasets: [{
                    data: [
                        1.4,
                        2
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
    </script>
@stop
