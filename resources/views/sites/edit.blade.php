@extends('voyager::bread.edit-add')

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
                                <input type="text" class="form-control" name="url" placeholder="Url" value="{{ $site->url }}">
                            </div>

                            <div class="form-group">
                                <label for="server">Server</label>
                                <select class="form-control" id="server" name="server_id">
                                    @foreach ($servers as $server)
                                        @if (is_null($site->server_id))
                                            <option selected value>Select a server</option>
                                        @endif
                                        
                                        <option value="{{ $server->id }}"
                                            @if (!is_null($site->server_id))
                                                @if ($site->server_id == $server->id)
                                                    selected
                                                @endif
                                            @endif>

                                            {{ $server->name }}

                                        </option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group ">
                                <label for="name">Check rate</label>
                                <input type="text" class="form-control" name="check_rate" placeholder="Check rate" value="{{ $site->check_rate }}">
                            </div>

                            <div class="form-group ">
                                <label for="name">Check response</label><br>
                                <input type="checkbox" name="check_response" class="toggleswitch" @if ($site->check_response) checked="" @endif>
                            </div>

                            <div class="form-group ">
                                <label for="name">Check certificate</label><br>
                                <input type="checkbox" name="check_certificate" class="toggleswitch" @if ($site->check_certificate) checked="" @endif>
                            </div>

                            <div class="form-group ">
                                <label for="name">Enable nginx configuration</label><br>
                                <input type="checkbox" name="enable_nginx_configuration" class="toggleswitch" @if ($site->enable_nginx_configuration) checked="" @endif>
                            </div>

                            <div class="form-group ">
                                <label for="name">SSH root path</label><br>
                                <input type="text" class="form-control" name="ssh_root" placeholder="SSH root path" value="{{ $site->ssh_root }}">
                            </div>

                            <div class="form-group">
                                <label for="contacts">Contacts</label>
                                <select class="form-control" id="contacts" name="contacts[]" multiple="multiple">
                                    @foreach ($contacts as $contact)

                                        <option value="{{ $contact->id }}"
                                            @if (in_array($contact->id, $site->contacts->pluck('id')->toArray()))
                                                selected
                                            @endif>

                                            {{ $contact->email }}

                                        </option>

                                    @endforeach
                                </select>
                            </div>


                            <hr>
                            <h3>Database</h3>

                            <div class="form-group ">
                                <label for="name">Enable database</label><br>
                                <input type="checkbox" name="enable_db" class="toggleswitch" @if ($site->enable_db) checked="" @endif>
                            </div>

                            <div class="form-group ">
                                <label for="name">Database host</label><br>
                                <input type="text" class="form-control" name="db_host" placeholder="Database host" value="{{ $site->db_host }}">
                            </div>

                            <div class="form-group ">
                                <label for="name">Database username</label><br>
                                <input type="text" class="form-control" name="db_username" placeholder="Database username" value="{{ $site->db_username }}">
                            </div>

                            <div class="form-group ">
                                <label for="name">Database password</label><br>
                                <input type="password" class="form-control" name="db_password" placeholder="Database password">
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
