@extends('web.layouts.master')
@section('title')
    Update Profile
@endsection
@section('content')
    <div class="mt-5">
        <h2 class="text-center">User Profile Update</h2>
        <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
            @csrf
            <div class="profile-container container form-container">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="first_name" name="first_name"
                           placeholder="First Name" value="{{$users->first_name}}">
                    <label for="first_name">First Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="last_name" id="last_name"
                           placeholder="Last Name" value="{{$users->last_name}}">
                    <label for="last_name">Last Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="email" id="email"
                           placeholder="Email" value="{{$users->email}}">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="password" id="password"
                           placeholder="Password" value="">
                    <label for="password">Password</label>
                </div>
                <button type="submit" class="btn btn-primary text-center">Save</button>
            </div>
        </form>
    </div>
@endsection
@section('custom-script')
    <script>
        var form_url = '/update-profile-store'
        var redirect_url = '/profile'
    </script>
    <script src="{{ asset('assets/web/custom/form.js') }}?v={{time()}}"></script>
@endsection
