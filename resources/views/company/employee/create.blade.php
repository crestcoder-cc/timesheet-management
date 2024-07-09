@extends('company.layouts.master')
@section('title')
    Employee
@endsection
@section('header')
    <div class="col-md-6">
        <div class="breadcrumb">
            <span>Dashboards</span>
            <span>/</span>
            <span>List of Employee</span>
            <span>/</span>
            <span>Add Employee</span>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="theme-table">
                    <div class="tab-heading">
                        <h3>Add Employee Information</h3>
                    </div>
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                        @csrf
                        <input type="hidden" id="edit_value" value="0" name="edit_value">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" id="first_name" name="first_name" placeholder="First Name"
                                       class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="last_name" name="last_name" placeholder="Last Name"
                                       class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="email" name="email" placeholder="Email"
                                       class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="mobile_no" name="mobile_no" placeholder="Mobile No"
                                       class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="date" id="date_of_birth" name="date_of_birth" placeholder="Date Of Birth"
                                       class="form-control dob-date-picker">
                            </div>
                            <div class="col-md-6 ">
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="department"
                                       name="department"
                                       placeholder="Department">
                            </div>
                            <div class="col-md-6 ">
                                <select class="form-control" id="location" name="location">
                                    <option value="">Select Location</option>
                                    <option value="Work From Home">Work From Home</option>
                                    <option value="Work From Office">Work From Office</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <textarea type="text" id="address" name="address" placeholder="Address"
                                          class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12 text-end">
                                <button class="btn btn-dark">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        let form_url = '/employee'
        let redirect_url = '/employee'
    </script>
    <script src="{{ asset('assets/admin/custom/form.js') }}?v={{time()}}"></script>
@endsection
