@extends('admin.layouts.master')
@section('title')
    Company Detail
@endsection
@section('header')
    <div class="col-md-6">
        <div class="breadcrumb">
            <span>Dashboards</span>
            <span>/</span>
            <span>Company Detail</span>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="company-info">
                    <div class="comapny-titles">Company Information</div>
                    <div class="comapny-det">
                        <div class="c-info">
                            <span>Company</span>
                            <p> {{$company->name}}</p>
                        </div>

                        <div class="c-info">
                            <span>Contact No.</span>
                            <p>{{$company->contact_no}}</p>
                        </div>
                        <div class="c-info">
                            <span>Contact Email</span>
                            <p>{{$company->email}}</p>
                        </div>
                    </div>
                </div>
                <div class="company-info">
                    <div class="comapny-det">
                        <div class="c-info">
                            <span>Person Name</span>
                            <p> {{$company->person_name}}</p>

                        </div>

                        <div class="c-info">
                            <span>Unique Id</span>
                            <p> {{$company->unique_id}}</p>
                        </div>
                        <div class="c-info">
                            <span>Address</span>
                            <p>{{$company->address}}</p>
                        </div>
                    </div>
                </div>
                <div class="theme-table">
                    <div class="tab-heading mb-5">
                        <h3>Company Employee</h3>
                    </div>
                    <table id="basic-1" class="table table-striped nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
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
        let company_id = '{{$company->id}}'
        let datatable_url = `/get-company-wise-employee/${company_id}`;
        let redirect_url = '/employee'
        let form_url = '/employee'
        const sweetalert_delete_title = 'Delete Employee ?'
        const sweetalert_delete_text = 'Are you sure want to delete this record ?'

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'mobile_no', name: 'mobile_no'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [0, 'desc']
        })
    </script>
    <script src="{{ asset('assets/admin/custom/datatable.js') }}?v={{time()}}"></script>
@endsection
