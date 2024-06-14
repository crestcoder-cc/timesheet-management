@extends('web.layouts.app')
@section('content')
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-4">Login</h2>
            <p class="text-center">Please sign in to continue with new booking</p>

            <div class="row justify-content-center">
                @if (session('success'))
                    <div class="col-lg-8 mt-3">
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                @error('email')
                <div class="col-lg-8 mt-3">
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                </div>
                @enderror
                <div class="col-md-8">
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Your Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('register') }}">Create an account</a> | <a
                            href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
