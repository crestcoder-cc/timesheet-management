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
                <div class="card-header mb-3">
                    <h5 class="card-title mb-0">Edit Company</h5>
                </div>

                <div class="card-body">
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                        @csrf
                        <input type="hidden" id="edit_value" value="{{$company->id}}" name="edit_value">
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-3">
                                <div class="form-group floating-label-group">
                                    <input type="text" class="form-control floating-input"
                                           value="{{$company->name}}"
                                           id="name" name="name" placeholder=" " required>
                                    <label for="name" class="floating-label">Company Name</label>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <div class="form-group floating-label-group">
                                    <input type="text" class="form-control floating-input" value="{{$company->person_name}}" id="person_name" name="person_name" placeholder=" " required>
                                    <label for="person_name" class="floating-label">Person Name</label>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group floating-label-group">
                                    <input type="number" class="form-control floating-input" value="{{$company->contact_no}}" id="contact_no" name="contact_no" placeholder=" " required>
                                    <label for="contact_no" class="floating-label">Contact No</label>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <div class="form-group floating-label-group">
                                    <input type="email" class="form-control floating-input" value="{{$company->email}}" id="email" name="email" placeholder=" " required>
                                    <label for="email" class="floating-label">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            <a href="{{ route('admin.company.index') }}"
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
        let form_url = '/company'
        let redirect_url = '/company'
    </script>
    <script src="{{ asset('assets/custom-js/custom/form.js') }}"></script>
@endsection
