@extends('admin.layouts.master')
@section('title','Company')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Companies</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Add Company</h5>
                </div>

                <div class="card-body">
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                        @csrf
                        <input type="hidden" id="edit_value" value="0" name="edit_value">
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-3">
                                <label for="name" class="form-label">Company Name</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Company Name">
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="person_name" class="form-label">Person Name</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="person_name" name="person_name"
                                           placeholder="Person Name">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="contact_no" class="form-label">Contact No</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="contact_no" name="contact_no"
                                           placeholder="Contact No">
                                </div>
                            </div>
{{--                            <div class="col-lg-6 mb-3">--}}
{{--                                <label for="mobile_no" class="form-label">Department</label>--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="text" class="form-control" id="department" name="department"--}}
{{--                                           placeholder="Department">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-lg-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" name="email"
                                           placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Password">
                                </div>
                            </div>

{{--                            <div class="col-lg-6 mb-3">--}}
{{--                                <label for="address" class="form-label">Address</label>--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="text" class="form-control" id="address" name="address"--}}
{{--                                           placeholder="Address">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-6 mb-3">--}}
{{--                                <label for="area" class="form-label">Area</label>--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="text" class="form-control"--}}
{{--                                           id="area" name="area"--}}
{{--                                           placeholder="Area">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-4 mb-3">--}}
{{--                                <label for="pincode" class="form-label">Pincode</label>--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="text" class="form-control" id="pincode" name="pincode"--}}
{{--                                           placeholder="Pincode">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-4 mb-3">--}}
{{--                                <label for="state" class="form-label">State<span--}}
{{--                                        class="text-danger"></span></label>--}}
{{--                                <input type="text" class="form-control tt-input"--}}
{{--                                       placeholder="State" id="state"--}}
{{--                                       name="state" autocomplete="off" spellcheck="false" dir="auto"--}}
{{--                                       value=""--}}
{{--                                       style="position: relative; vertical-align: top; background-color: transparent;">--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-4 mb-3">--}}
{{--                                <label for="city" class="form-label">City<span--}}
{{--                                        class="text-danger"></span></label>--}}
{{--                                <input type="text" class="form-control tt-input"--}}
{{--                                       placeholder="City" id="city"--}}
{{--                                       name="city" autocomplete="off" spellcheck="false" dir="auto"--}}
{{--                                       value=""--}}
{{--                                       style="position: relative; vertical-align: top; background-color: transparent;">--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-12 mb-3">--}}
{{--                                <label for="location" class="form-label">Location</label>--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="text" class="form-control" id="location" name="location"--}}
{{--                                           placeholder="Location">--}}
{{--                                    <input type="hidden" id="latitude" name="latitude"/>--}}
{{--                                    <input type="hidden" id="longitude" name="longitude"/>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-12 mb-3">--}}
{{--                                <div id="map-canvas" style="height:300px;"></div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-sm">Save</button>
                            <a href="{{ route('admin.company.index') }}"
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
        let form_url = '/company'
        let redirect_url = '/company'
    </script>
    <script src="{{ asset('assets/custom-js/custom/form.js') }}"></script>
@endsection
