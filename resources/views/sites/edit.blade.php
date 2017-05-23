@extends('voyager::master')

@section('content')
    <h1 class="page-title">
        <i class="voyager-browser"></i> Edit Site
    </h1>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Site</h3>
                    </div>

                    <form role="form" class="form-edit-add" action="{{ route('voyager.sites.update', ['site' => $site]) }}" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        {{ method_field('PUT') }}

                        <div class="panel-body">

                            <div class="form-group ">
                                <label for="name">Url</label>
                                <input type="text" class="form-control" name="url" placeholder="Address" value="{{ $site->url }}">
                            </div>

                            <div class="form-group ">
                                <label for="name">Rate</label>
                                <input type="text" class="form-control" name="rate" placeholder="Rate" value="{{ $site->rate }}">
                            </div>

                        </div>

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
