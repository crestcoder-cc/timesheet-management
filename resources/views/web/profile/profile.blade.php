@extends('web.layouts.master')
@section('title')
    Profile
@endsection
@section('content')
    <div class="mt-5 profile-container container ">
        <h2>User Profile</h2>
        <img src="https://img.freepik.com/premium-photo/cartoonish-3d-animation-boy-glasses-with-blue-hoodie-orange-shirt_899449-25777.jpg" alt="User Image">
        <p>
            <strong>Name:</strong> {{$users->first_name . ' ' .$users->last_name }}
        </p>
        <p><strong>Email:</strong> {{$users->email}}</p>
        <p><strong>Password:</strong> Karan@1234</p>
        <p><strong>Company Name:</strong> {{$users->company_name}}</p>
        <a href="{{route('update-profile')}}" class="btn">Edit Profile</a>
    </div>
@endsection
@section('custom-script')
    <script>
        var modal_form_url = '/task-store'
        var redirect_url = '/home'
    </script>
    <script src="{{ asset('assets/web/custom/form.js') }}?v={{time()}}"></script>
@endsection
