@extends('voyager::bread.edit-add')

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">Edit key</h3>
                    </div>

                    <form role="form" class="form-edit-add" action="{{ route('voyager.keys.update', ['key' => $key]) }}" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        {{ method_field('PUT') }}

                        <div class="panel-body">

                            <div class="form-group ">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $key->name }}">
                            </div>

                            <div class="form-group ">
                                <label for="key">Key</label>
                                <textarea class="form-control" name="key">{{ $key->key }}</textarea>
                            </div>

                            <div class="form-group ">
                                <label for="keyphrase">Keyphrase <small>(leave blank to keep the same password)</small></label><br>
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

@section('javascript')
    @parent

    <!-- Select2 -->
    <script type="text/javascript">

        $("#server").select2({
            placeholder: "Select a server",
            allowClear: true
        });

        $("#contacts").select2({
            placeholder: "Select contacts",
            allowClear: true
        });

    </script>
@endsection
