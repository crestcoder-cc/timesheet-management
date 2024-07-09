@extends('admin.layouts.master')
@section('title')
    Dashboard
@endsection
@section('header')
    <div class="col-md-6">
        <div class="breadcrumb">
            <span>Dashboards</span>
            <span>/</span>
            <span>List of Companies</span>
            <span>/</span>
            <span>Add Company</span>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="theme-table">
                    <div class="tab-heading">
                        <h3>Add Company Information</h3>
                    </div>
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                        @csrf
                        <input type="hidden" id="edit_value" value="0" name="edit_value">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" id="name" name="name" placeholder="Company Name"
                                       class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="person_name" name="person_name" placeholder="Person Name"
                                       class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="contact_no" name="contact_no" placeholder="Contact No"
                                       class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="email" name="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <textarea type="text" id="address" name="address" placeholder="Address"
                                          class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                        <div class="col-md-12 text-end">
                            <div class="saveform">
                                <button class="btn btn-dark">Save</button>
                            </div>
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
        let form_url = '/company'
        let redirect_url = '/company'
    </script>
    <script src="{{ asset('assets/admin/custom/form.js') }}?v={{time()}}"></script>
@endsection
