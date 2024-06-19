@extends('company.layouts.master')
@section('title','Employee')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Employees</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h5 class="card-title mb-0">Add Employee</h5>
                </div>

                <div class="card-body">
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                        @csrf
                        <input type="hidden" id="edit_value" value="0" name="edit_value">
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-3">
                                <div class="form-group floating-label-group">
                                    <input type="text" class="form-control floating-input" id="first_name" name="first_name"
                                           placeholder="">
                                <label for="first_name" class="floating-label">First Name</label>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group floating-label-group">
                                    <input type="text" class="form-control floating-input" id="last_name" name="last_name"
                                           placeholder="">
                                <label for="name" class="floating-label">Last Name</label>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group floating-label-group">
                                    <input type="text" class="form-control floating-input" id="email" name="email"
                                           placeholder="">
                                <label for="email" class="floating-label">Email</label>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group floating-label-group">
                                    <input type="number" class="form-control floating-input" id="mobile_no" name="mobile_no"
                                           placeholder="">
                                <label for="mobile_no" class="floating-label">Mobile No</label>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group floating-label-group">
                                    <input type="text" class="form-control floating-input dob-date-picker" id="date_of_birth" name="date_of_birth"
                                           placeholder="">
                                <label for="date_of_birth" class="floating-label">Date Of Birth</label>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group floating-label-group">
                                    <select class="form-control floating-input" id="gender" name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                <label for="gender" class="floating-label">Gender</label>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group floating-label-group">
                                    <input type="text" class="form-control floating-input" id="department" name="department"
                                           placeholder="">
                                <label for="department" class="floating-label">Department</label>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <div class="form-group floating-label-group">
                                    <textarea class="form-control floating-input" id="address" name="address"></textarea>
                                <label for="address" class="floating-label">Address</label>
                                </div>
                            </div>
{{--                            <div class="col-lg-6 mb-3">--}}
{{--                                <div class="form-group floating-label-group">--}}
{{--                                    <input type="password" class="form-control floating-input" id="password" name="password"--}}
{{--                                           placeholder="">--}}
{{--                                <label for="password" class="floating-label">Password</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            <a href="{{ route('admin.employee.index') }}"
                               class="btn btn-blue btn-sm">Cancel</a>
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
    <script src="{{ asset('assets/custom-js/custom/form.js') }}"></script>
@endsection
