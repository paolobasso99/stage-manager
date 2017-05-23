@extends('voyager::master')

@section('content')
    <h1 class="page-title">
        <i class="voyager-browser"></i> Viewing Sites &nbsp;

        <a href="{{ route('voyager.sites.edit', ['site' => $site]) }}" class="btn btn-info">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;
            Edit
        </a>
        <a href="{{ route('voyager.sites.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Return to List
        </a>
    </h1>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Url</h3>
                    </div>
                    <div class="panel-body" style="padding-top:0;">
                        <p>{{ $site->url }}</p>
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Rate</h3>
                    </div>
                    <div class="panel-body" style="padding-top:0;">
                        <p>{{ $site->rate }}</p>
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Attempts</h3>
                    </div>
                    <div class="panel-body" style="padding-top:0;">
                        <p>{{ $site->tried }}</p>
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Checked At</h3>
                    </div>
                    <div class="panel-body" style="padding-top:0;">
                        <p>{{ $site->checked_at }}</p>
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Created At</h3>
                    </div>
                    <div class="panel-body" style="padding-top:0;">
                        <p>{{ $site->created_at }}</p>
                    </div>

                </div>


                <h2>Stats</h2>
                <div class="panel panel-bordered" style="padding-bottom:5px;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Test</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        <p>Test</p>
                    </div>
                    <!-- panel-body -->
                    <hr style="margin:0;">


                </div>
            </div>
        </div>
    </div>
@endsection
