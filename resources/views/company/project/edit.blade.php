@extends('company.layouts.master')
@section('title')
    Edit Client
@endsection
@section('header')
    <div class="col-md-6">
        <div class="breadcrumb">
            <span>Dashboards</span>
            <span>/</span>
            <span>List of Clients</span>
            <span>/</span>
            <span>Edit Client</span>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="theme-table">
                    <div class="tab-heading">
                        <h3>Edit Client Information</h3>
                    </div>
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                        @csrf
                        <input type="hidden" id="edit_value" value="{{$project->id}}" name="edit_value">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" id="name" name="name" value="{{$project->name}}" placeholder="Project Name"
                                       class="form-control">
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
        let form_url = '/project'
        let redirect_url = '/project'
    </script>
    <script src="{{ asset('assets/admin/custom/form.js') }}?v={{time()}}"></script>
@endsection
