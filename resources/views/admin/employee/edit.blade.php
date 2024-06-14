@extends('admin.layouts.master')
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
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Employee</h5>
                </div>

                <div class="card-body">
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                        @csrf
                        <input type="hidden" id="edit_value" value="{{$employee->id}}" name="edit_value">
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           value="{{$employee->first_name}}"
                                           id="first_name" name="first_name"
                                           placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="name" class="form-label">Last Name</label>
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           value="{{$employee->last_name}}"
                                           id="last_name" name="last_name"
                                           placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           value="{{$employee->email}}"
                                           id="email" name="email"
                                           placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="mobile_no" class="form-label">Mobile No</label>
                                <div class="form-group">
                                    <input type="number" class="form-control"
                                           value="{{$employee->mobile_no}}"
                                           id="mobile_no" name="mobile_no"
                                           placeholder="Mobile No">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="date_of_birth" class="form-label">Date Of Birth</label>
                                <div class="form-group">
                                    <input type="text" class="form-control dob-date-picker"
                                           value="{{$employee->date_of_birth}}"
                                           id="date_of_birth" name="date_of_birth"
                                           placeholder="Date Of Birth">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <div class="form-group">
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="male" @if($employee->gender == 'male') selected @endif>Male</option>
                                        <option value="female" @if($employee->gender == 'female') selected @endif>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="department" class="form-label">Department</label>
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           value="{{$employee->department}}"
                                           id="department" name="department"
                                           placeholder="Department">
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <div class="form-group">
                                    <textarea class="form-control" id="address" name="address">{{$employee->address}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-sm">Save</button>
                            <a href="{{ route('admin.employee.index') }}"
                               class="btn btn-danger btn-sm">Cancel</a>
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
