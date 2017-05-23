@extends('voyager::master')

@section('content')
    <h1 class="page-title">
        <i class="voyager-browser"></i> Sites
        <a href="{{ route('voyager.sites.create') }}" class="btn btn-success">
            <i class="voyager-plus"></i> Add New
        </a>
    </h1>

    <div class="page-content container-fluid">
        <div class="alerts">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="dataTable"></label></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="dataTable" class="row table table-hover dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending" style="width: 330px;">Address</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Created At: activate to sort column ascending" style="width: 249px;">Created At</th>
                                                <th class="actions sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 397px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr role="row" class="odd">
                                                <td>
                                                    <div class="readmore" style="max-height: none;">paolo.basso99@gmail.com</div>
                                                </td>
                                                <td>
                                                    <span>2017-05-22 13:19:44</span>
                                                </td>
                                                <td class="no-sort no-click" id="bread-actions">
                                                    <a href="javascript:;" title="Delete" class="btn btn-sm btn-danger pull-right delete" data-id="1" id="delete-1">
                                                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Delete</span>
                                                </a>
                                                    <a href="http://localhost/admin/emails/1/edit" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                                    <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Edit</span>
                                                </a>
                                                    <a href="http://localhost/admin/emails/1" title="View" class="btn btn-sm btn-warning pull-right">
                                                    <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">View</span>
                                                </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous disabled" id="dataTable_previous"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0">Previous</a></li>
                                            <li class="paginate_button active"><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0">1</a></li>
                                            <li class="paginate_button next disabled" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0">Next</a></li>
                                        </ul>
                                    </div>
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
                    <form action="{{ route('voyager.sites.destroy', ['site' => 1]) }}" id="delete_form" method="POST">
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
