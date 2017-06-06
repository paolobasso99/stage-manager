@extends('voyager::bread.edit-add')

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">@if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'Add New' }}@endif {{ $dataType->display_name_singular }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add"
                            action="@if(isset($dataTypeContent->id)){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if(isset($dataTypeContent->id))
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- If we are editing -->
                            @if(isset($dataTypeContent->id))
                                <?php $dataTypeRows = $dataType->editRows; ?>
                            @else
                                <?php $dataTypeRows = $dataType->addRows; ?>
                            @endif

                            @foreach($dataTypeRows as $row)
                                <div class="form-group @if($row->type == 'hidden') hidden @endif">
                                    <label for="name">{{ $row->display_name }}</label>
                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                    {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}

                                    @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                        {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                    @endforeach
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label for="server">Server</label>
                                <select class="form-control" id="server" name="server">
                                    @foreach ($servers as $server)
                                        <option selected value>Select a server</option>

                                        <option value="{{ $server->id }}"
                                            @if (isset($dataTypeContent->id))
                                                @if ($server == $site->server)
                                                    selected
                                                @endif
                                            @endif>

                                            {{ $server->name }}

                                        </option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="key">Ssh key</label>
                                <select class="form-control" id="key_id" name="key_id">
                                    @foreach ($keys as $key)
                                        <option selected value>Select a key</option>

                                        <option value="{{ $key->id }}"
                                            @if (isset($dataTypeContent->id))
                                                @if ($key->id == $site->key_id)
                                                    selected
                                                @endif
                                            @endif>

                                            {{ $key->name }}

                                        </option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="contacts">contacts</label>
                                <select class="form-control" id="contacts" name="contacts[]" multiple="multiple">
                                    @foreach ($contacts as $contact)

                                        <option value="{{ $contact->id }}"
                                            @if (isset($dataTypeContent->id))
                                                @if (in_array($contact->id, $site->contacts->pluck('id')->toArray()))
                                                    selected
                                                @endif
                                            @endif>

                                            {{ $contact->email }}

                                        </option>

                                    @endforeach
                                </select>
                            </div>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">Save</button>
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                            enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                                 onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> Are You Sure</h4>
                </div>

                <div class="modal-body">
                    <h4>Are you sure you want to delete '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">Yes, Delete it!
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop


@section('javascript')

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

        $("#key").select2({
            placeholder: "Select a key",
            allowClear: true
        });

    </script>
@endsection
