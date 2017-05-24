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

@endsection
