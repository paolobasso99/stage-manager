@extends('voyager::bread.edit-add')

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">Edit server</h3>
                    </div>

                    <form role="form" class="form-edit-add" action="{{ route('voyager.servers.update', ['server' => $server]) }}" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        {{ method_field('PUT') }}

                        <div class="panel-body">

                            <div class="form-group ">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $server->name }}">
                            </div>

                            <div class="form-group ">
                                <label for="ip">Ip</label>
                                <input type="text" class="form-control" name="ip" placeholder="Ip" value="{{ $server->ip }}">
                            </div>


                            <hr>
                            <h3>SSH configuration</h3>

                            <div class="form-group ">
                                <label for="enable_console">Enable console</label><br>
                                <input type="checkbox" name="enable_console" class="toggleswitch" @if ($server->enable_console) checked="" @endif>
                            </div>

                            <div class="form-group ">
                                <label for="enable_crontab">Enable crontab</label><br>
                                <input type="checkbox" name="enable_crontab" class="toggleswitch" @if ($server->enable_crontab) checked="" @endif>
                            </div>

                            <div class="form-group ">
                                <label for="ssh_username">SSH username</label>
                                <input type="text" class="form-control" name="ssh_username" placeholder="SSH username" value="{{ $server->ssh_username }}">
                            </div>

                            <div class="form-group ">
                                <label for="ssh_password">SSH password <small>(leave blank to keep the same password)</small></label>
                                <input type="password" class="form-control" name="ssh_password" placeholder="SSH password">
                            </div>

                            <div class="form-group">
                                <label for="key_id">Key</label>
                                <select class="form-control" id="key" name="key_id">
                                    @foreach ($keys as $key)
                                        @if (is_null($server->key_id))
                                            <option selected value>Select a key</option>
                                        @endif

                                        <option value="{{ $key->id }}"
                                            @if (!is_null($server->key_id))
                                                @if ($server->key_id == $key->id)
                                                    selected
                                                @endif
                                            @endif>

                                            {{ $key->name }}

                                        </option>

                                    @endforeach
                                </select>
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

        $("#key").select2({
            placeholder: "Select a key",
            allowClear: true
        });

    </script>
@endsection
