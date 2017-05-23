@extends('voyager::master')

@section('content')
    <h1 class="page-title">
        <i class="voyager-browser"></i> New Site
    </h1>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">Add New Site</h3>
                    </div>

                    <form role="form" class="form-edit-add" action="{{ route('voyager.sites.store') }}" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="panel-body">

                            <div class="form-group ">
                                <label for="name">Url</label>
                                <input type="text" class="form-control" name="url" placeholder="Address" value="">
                            </div>

                            <div class="form-group ">
                                <label for="name">Rate</label>
                                <input type="text" class="form-control" name="rate" placeholder="Rate" value="5">
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
