@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'New' }}@endif {{ $dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
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
