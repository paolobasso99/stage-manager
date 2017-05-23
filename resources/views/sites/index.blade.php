@extends('voyager::master')

@section('content')
    <h1 class="page-title">
        <i class="voyager-browser"></i> Sites
        <a href="{{ route('voyager.sites.create') }}" class="btn btn-success">
            <i class="voyager-plus"></i> Add New
        </a>
    </h1>

    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="dataTable" class="row table table-hover dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Url: activate to sort column ascending">Url</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Rate: activate to sort column ascending">Rate</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Checked At: activate to sort column ascending">Checked At</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Created At: activate to sort column ascending">Created At</th>
                                                <th class="actions sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sites as $site)
                                                <tr role="row" class="odd">
                                                    <td>
                                                        <span>{{ $site->url }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $site->rate }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $site->checked_at }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $site->created_at }}</span>
                                                    </td>
                                                    <td class="no-sort no-click" id="bread-actions">
                                                        <a href="javascript:;" title="Delete" class="btn btn-sm btn-danger pull-right delete" data-id="{{ $site->id }}" id="delete-1">
                                                        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Delete</span>
                                                    </a>
                                                        <a href="{{ route('voyager.sites.edit', ['site' => $site]) }}" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                                        <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Edit</span>
                                                    </a>
                                                        <a href="{{ route('voyager.sites.show', ['site' => $site]) }}" title="View" class="btn btn-sm btn-warning pull-right">
                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">View</span>
                                                    </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete
                        this site?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.sites.destroy', '') }}" id="delete_form" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Yes, delete this site">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection


@section('javascript')
    <script type="text/javascript">

        $(document).ready(function () {
            var table = $('#dataTable').DataTable({
                "order": []
            });
        });


        var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) { // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');
            console.log(form.action);

            $('#delete_modal').modal('show');
        });

    </script>
@endsection
