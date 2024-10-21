@extends('company.layouts.master')
@section('title')
    Clients
@endsection
@section('header')
    <div class="col-md-6">
        <div class="breadcrumb">
            <span>Dashboards</span>
            <span>/</span>
            <span>Total Clients</span>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="theme-table">
                    <div class="tab-heading mb-5">
                        <h3>Total Clients</h3>
                        <a href="{{route('company.project.create')}}" class="btn btn-primary">+ Add Client</a>
                    </div>
                    <table id="basic-1"  class="table table-striped nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        let datatable_url = '/get-project'
        let redirect_url = '/project'
        let form_url = '/project'
        const sweetalert_delete_title = 'Delete Project ?'
        const sweetalert_delete_text = 'Are you sure want to delete this record ?'

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'name', name: 'name'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [0, 'desc']
        })
    </script>
    <script src="{{ asset('assets/admin/custom/datatable.js') }}?v={{time()}}"></script>
@endsection
