@extends('admin.layouts.master')
@section('title')
    Dashboard
@endsection
@section('header')
    <div class="col-md-6">
        <div class="breadcrumb">
            <span>Dashboards</span>
            <span>/</span>
            <span>Total Companies</span>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
{{--                <div class="company-info">--}}
{{--                    <div class="comapny-titles">Company Information</div>--}}
{{--                    <div class="comapny-det">--}}
{{--                        <div class="c-info">--}}
{{--                            <span>Company</span>--}}
{{--                            <p>Grandin & Co.</p>--}}
{{--                        </div>--}}
{{--                        <div class="c-info">--}}
{{--                            <span>Contact No.</span>--}}
{{--                            <p>+27 98250 98250</p>--}}
{{--                        </div>--}}
{{--                        <div class="c-info">--}}
{{--                            <span>Contact Email</span>--}}
{{--                            <p>demon@grandin.com</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="theme-table">
                    <div class="tab-heading mb-5">
                        <h3>Total Companies</h3>
                        <a href="{{route('admin.company.create')}}" class="btn btn-primary">+ Add Company</a>
                    </div>
                    <table id="basic-1"  class="table table-striped nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Contact No</th>
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
        let datatable_url = '/get-company'
        let redirect_url = '/company'
        let form_url = '/company'
        const sweetalert_delete_title = 'Delete Company ?'
        const sweetalert_delete_text = 'Are you sure want to delete this record ?'

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'contact_no', name: 'contact_no'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [0, 'desc']
        })
    </script>
    <script src="{{ asset('assets/admin/custom/datatable.js') }}?v={{time()}}"></script>
@endsection
