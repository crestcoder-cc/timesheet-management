@extends('company.layouts.master')
@section('title')
    Employee
@endsection
@section('header')
    <div class="col-md-6">
        <div class="breadcrumb">
            <span>Dashboards</span>
            <span>/</span>
            <span>Detail of Employee</span>

        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Employee Details</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th scope="row">First Name</th>
                                <td>{{ $employee->first_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Last Name</th>
                                <td>{{ $employee->last_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>{{ $employee->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Mobile No</th>
                                <td>{{ $employee->mobile_no }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Registration Date</th>
                                <td>{{ $employee->registration_date }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Gender</th>

                                <td>{{ ucfirst($employee->gender) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Department</th>
                                <td>{{ $employee->department }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Location</th>
                                <td>{{ $employee->location }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Address</th>
                                <td>{{ $employee->address }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Overtime Permission</th>
                                <td>{{ ucfirst($employee->overtime_permission) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="theme-table">
                    <div class="tab-heading mb-5">
                        <h5 class="card-title">Employee Tasks</h5>
                        <input type="text" name="date_range" id="date_range" value="" />
                    </div>
                    <div class="table-responsive">
                        <table id="basic-1" class="table table-striped nowrap">
                            <thead>
                            <tr>
                                <th>Client</th>
                                <th>Project</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Total Hours</th>
                                <th>OT Hours</th>
                                <th>Location</th>
                                <th>Status</th>

                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        $('input[name="date_range"]').daterangepicker({
            startDate: moment().subtract(1, 'M'),
            endDate: moment(),
            locale: {
                format: 'DD-MM-YYYY'
            }
        });
    </script>
    <script>
        let datatable_url = '/get-employee-task/' + '{{$employee->id}}'

        $.extend(true, $.fn.dataTable.defaults, {
            columns: [
                {data: 'client', name: 'client'},
                {data: 'project', name: 'project'},
                {data: 'description', name: 'description'},
                {data: 'date', name: 'date'},
                {data: 'start_time', name: 'start_time'},
                {data: 'end_time', name: 'end_time'},
                {data: 'total_hour', name: 'total_hour'},
                {data: 'ot_hour', name: 'ot_hour'},
                {data: 'location', name: 'location'},
                {data: 'status', name: 'status'},
            ],
            order: [0, 'desc']
        })
    </script>
    <script src="{{ asset('assets/company/custom/datatable.js') }}?v={{time()}}"></script>

@endsection
