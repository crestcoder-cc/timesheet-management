@extends('web.layouts.master')
@section('title')
    Profile
@endsection

<style>
    .header-img {
        background: #63A5A9;
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

    .edit-profile {
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
                <div class="header-img">
                    <img src="{{asset(Auth::user()->image)}}"
                        alt="Profile Picture">
                </div>

                <div class="profile-container container form-container">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="first_name" name="first_name"
                               placeholder="First Name" value="{{$users->first_name .' ' . $users->last_name}}"
                               readonly>
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="Email" value="{{$users->email}}" readonly>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="company_name" name="company_name"
                               placeholder="Company Name" value="{{$users->company_name}}" readonly>
                        <label for="company_name">Company Name</label>
                    </div>

                </div>
                <a class="edit-profile" href="{{route('update-profile')}}">Edit Profile</a>
                <a class="edit-profile" href="{{route('reset-password')}}">Reset Password</a>
                <a class="edit-profile" href="{{route('home')}}">Back</a>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var modal_form_url = '/task-store'
        var redirect_url = '/home'
    </script>

    <script src="{{ asset('assets/web/custom/form.js') }}?v={{time()}}"></script>
@endsection
