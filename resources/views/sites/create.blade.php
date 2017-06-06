@extends('voyager::bread.edit-add')

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">Create Site</h3>
                    </div>

                    <form role="form" class="form-edit-add" action="{{ route('voyager.sites.store', ['site' => $site]) }}" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        {{ method_field('POST') }}

                        <div class="panel-body">

                            <div class="form-group ">
                                <label for="name">Url</label>
                                <input type="text" class="form-control" name="url" placeholder="Url" value="{{ $site->url }}">
                            </div>

                            <div class="form-group">
                                <label for="server">Server</label>
                                <select class="form-control" id="server" name="server_id">
                                    @foreach ($servers as $server)
                                        <option selected value>Select a server</option>

                                        <option value="{{ $server->id }}">

                                            {{ $server->name }}

                                        </option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group ">
                                <label for="name">Check rate</label>
                                <input type="text" class="form-control" name="check_rate" placeholder="Check rate" value="5">
                            </div>

                            <div class="form-group ">
                                <label for="name">Check response</label><br>
                                <input type="checkbox" name="check_response" class="toggleswitch" checked="">
                            </div>

                            <div class="form-group ">
                                <label for="name">Check certificate</label><br>
                                <input type="checkbox" name="check_certificate" class="toggleswitch">
                            </div>

                            <div class="form-group ">
                                <label for="name">Enable nginx configuration</label><br>
                                <input type="checkbox" name="enable_nginx_configuration" class="toggleswitch">
                            </div>

                            <div class="form-group ">
                                <label for="name">SSH root path</label><br>
                                <input type="text" class="form-control" name="ssh_root" placeholder="SSH root path">
                            </div>

                            <div class="form-group">
                                <label for="contacts">Contacts</label>
                                <select class="form-control" id="contacts" name="contacts[]" multiple="multiple">
                                    @foreach ($contacts as $contact)

                                        <option value="{{ $contact->id }}">

                                            {{ $contact->email }}

                                        </option>

                                    @endforeach
                                </select>
                            </div>


                            <hr>
                            <h3>Database</h3>

                            <div class="form-group ">
                                <label for="name">Enable database</label><br>
                                <input type="checkbox" name="enable_db" class="toggleswitch">
                            </div>

                            <div class="form-group ">
                                <label for="name">Database host</label><br>
                                <input type="text" class="form-control" name="db_host" placeholder="Database host">
                            </div>

                            <div class="form-group ">
                                <label for="name">Database username</label><br>
                                <input type="text" class="form-control" name="db_username" placeholder="Database username">
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
