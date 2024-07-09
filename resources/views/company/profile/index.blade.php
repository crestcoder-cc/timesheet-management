@extends('company.layouts.master')
@section('title')
    Profile
@endsection
@section('header')
    <div class="col-md-6">
        <div class="breadcrumb">
            <span>Dashboards</span>
            <span>/</span>
            <span>Profile</span>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="theme-table">
                    <div class="tab-heading">
                        <h3>Profile </h3>
                    </div>
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="edit_value" value="{{ Auth::guard('company')->user()->id }}"
                               name="edit_value">
                        <input type="hidden" id="form-method" value="add">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control"
                                       name="name" id="name"
                                       value="{{ Auth::guard('company')->user()->name }}"
                                       placeholder="Name" required/>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control"
                                       name="person_name" id="person_name"
                                       value="{{ Auth::guard('company')->user()->person_name }}"
                                       placeholder="Person Name" required/>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control"
                                       name="email" readonly id="email"
                                       value="{{ Auth::guard('company')->user()->email }}"
                                       placeholder="Email" required/>
                            </div>
                            <div class="col-md-6">
                                <input type="password" class="form-control"
                                       name="password" id="password"
                                       placeholder="Reset Password"/>
                            </div>

                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-dark">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var form_url = '/updateProfile'
        var redirect_url = '/my-profile'
    </script>
    <script src="{{ asset('assets/admin/custom/form.js') }}?v={{time()}}"></script>
@endsection
