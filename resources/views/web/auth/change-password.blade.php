@extends('web.layouts.master')
@section('title')
    Reset-Password
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
        background: #000;
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
                    <img
                        src="https://img.freepik.com/premium-photo/cartoonish-3d-animation-boy-glasses-with-blue-hoodie-orange-shirt_899449-25777.jpg"
                        alt="Profile Picture">
                </div>
                <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                    @csrf
                    <div class="profile-container container form-container">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="current_password" name="current_password"
                                   placeholder="Current Password">
                            <label for="current_password">Current Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="new_password" name="new_password"
                                   placeholder="New Password">
                            <label for="new_password">New Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="confirm_password" name="confirm_password"
                                   placeholder="Confirm Password">
                            <label for="confirm_password">Confirm Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary text-center">Save</button>
                        <button type="button" class="btn btn-primary text-center">
                           <a href="{{route('profile')}}" class="text-white no-underline">Back</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var form_url = '/update-password-store'
        var redirect_url = '/home'
    </script>
    <script src="{{ asset('assets/web/custom/form.js') }}?v={{time()}}"></script>
@endsection
