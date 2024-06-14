@extends('company.layouts.master')
@section('title', 'Employee Detail')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Employee Details</h4>
            </div>
        </div>
    </div>
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
                            <th scope="row">Date Of Birth</th>
                            <td>{{ $employee->date_of_birth }}</td>
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
                            <th scope="row">Address</th>
                            <td>{{ $employee->address }}</td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
@endsection
