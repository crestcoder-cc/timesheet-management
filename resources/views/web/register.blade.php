@extends('web.layouts.app')
@section('content')
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-4">Register</h2>
            <p class="text-center">Please sign up to continue with new booking</p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="post" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="mobile_no" placeholder="Your Mobile No">
                            @error('mobile_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Your Password">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}">Already have an account ? Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
