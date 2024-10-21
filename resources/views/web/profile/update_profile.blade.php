@extends('web.layouts.master')
@section('title')
    Update Profile
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
<style>
    .header-img {
        background: #ff5a5f;
        border-radius: 10px 10px 0 0;
        padding: 20px;
        text-align: center;
        position: relative;
    }

    .header-img img {
        border-radius: 50%;
        border: 5px solid #fff;
        width: 100px;
        height: 100px;
        object-fit: cover;
    }

    .a {
        display: inline-block;
        margin-top: 10px;
        padding: 5px 10px;
        background: #63A5A9;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
    }

    .profile-container {
        padding: 20px;
    }

    .form-floating label {
        padding: 0 10px;
    }
</style>
@section('content')
    <div class="mt-5">
        <div class="row mt-5 justify-content-center">
            <div class="col-4 text-center">
                <h2 class="text-center">User Profile Update</h2>
                <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                    @csrf
                    <div class="profile-container container form-container">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                   placeholder="First Name" value="{{$users->first_name }}">
                            <label for="first_name">First Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   placeholder="Last Name" value="{{ $users->last_name}}">
                            <label for="last_name">Last Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="Email" value="{{$users->email}}" readonly>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                   placeholder="Company Name" value="{{$users->company_name}}">
                            <label for="company_name">Company Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control dropify" data-default-file="{{asset(Auth::user()->image)}}" id="image" name="image">
                            <label for="company_name">Image</label>
                        </div>
                        <button type="submit" class="btn btn-primary text-center">Save</button>
                        <button type="button" class="btn btn-primary text-center">
                            <a class="text-white no-underline" href="{{route('profile')}}">Back</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var form_url = '/update-profile-store'
        var redirect_url = '/profile'
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
    <script src="{{ asset('assets/web/custom/form.js') }}?v={{time()}}"></script>
@endsection
