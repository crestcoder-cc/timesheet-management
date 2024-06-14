@extends('web.layouts.app')
@section('content')
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-4">Forgot Password ?</h2>
            <p class="text-center">Please enter your email so we will sent you reset password link</p>

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
                    <form method="post" action="{{ route('forgotPassword') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Forgot Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
