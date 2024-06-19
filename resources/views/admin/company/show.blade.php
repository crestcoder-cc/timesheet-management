@extends('admin.layouts.master')
@section('title', 'Company Detail')
@section('content')
    <style>
        .info-section {
            margin-top: 20px;
        }
        .info-section h5 {
            font-weight: bold;
        }
        .info-section p {
            margin-bottom: 5px;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Company Details</h4>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Company Details</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="col-md-4">
                        <h4>Personal info</h4>
                        <p><strong>Company Name:</strong> {{$company->name}}</p>
                        <p><strong>Person Name:</strong> {{$company->person_name}}</p>
{{--                        <p><strong>Date of Birth:</strong> {{$company->date_of_birth}}</p>--}}
{{--                        <p><strong>Gender:</strong> {{$company->gender}}</p>--}}
                    </div>
                    <div class="col-md-4">
                        <h4>Company info</h4>
                        <p><strong>Unique ID:</strong> {{$company->unique_id}}</p>
{{--                        <p><strong>Department:</strong> {{$company->department}}</p>--}}
                    </div>
                    <div class="col-md-4">
                        <h4>Contact info</h4>
                        <p><strong>Contact No:</strong> {{$company->contact_no}}</p>
                        <p><strong>Email:</strong> {{$company->email}}</p>
                        <p><strong>Address:</strong> {{$company->address}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Company Employee</h5>
                </div>
                    <div class="card-body">
                        <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                               id="basic-1" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
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
    <script src="{{ asset('assets/custom-js/custom/datatable.js') }}?v={{time()}}"></script>
@endsection
