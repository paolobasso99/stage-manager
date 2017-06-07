@extends('voyager::bread.edit-add')

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">Create key</h3>
                    </div>

                    <form role="form" class="form-edit-add" action="{{ route('voyager.keys.store') }}" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        {{ method_field('POST') }}

                        <div class="panel-body">

                            <div class="form-group ">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>

                            <div class="form-group ">
                                <label for="key">Key</label>
                                <textarea class="form-control" name="key"></textarea>
                            </div>

                            <div class="form-group ">
                                <label for="keyphrase">Keyphrase</label><br>
                                <input type="password" class="form-control" name="keyphrase" placeholder="Keyphrase">
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
