<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Timesheet Management - Login</title>
    <link rel="icon" href="{{asset('assets/logo/Afotracx Color logo - no background.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/logo/Afotracx Color logo - no background.png')}}"
          type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


</head>
<body>
<div class="login-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 offset-lg-2 offset-md-1">
                <div class="login-box">
                    <div class="login-logo" style="background-color: black">
                        <img class="mb-2" src="{{asset('assets/logo/Afotracx Color logo - no background.png')}}" alt="logo">
                    </div>
                    <h1 class="text-center">Sign In</h1>
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                        @csrf
                        <input type="text" name="email" class="form-control" placeholder="Email">
                        <input type="password" name="password" class="form-control" placeholder="Password">
{{--                        <div class="forgotpwd text-end">--}}
{{--                            <a href="#">Forgot Password?</a>--}}
{{--                        </div>--}}
                        <button type="submit" class="btn btn-dark d-block">Sign In</button>

{{--                        <div class="keep-signed">--}}
{{--                            <input type="checkbox" id="signin">--}}
{{--                            <label for="signin">Keep me signed in</label>--}}
{{--                        </div>--}}
                    </form>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <div class="copyright">
                    <p>&copy; 2024 Guardian Link</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var form_url = '/login-check'
    var redirect_url = '/dashboard'
    var APP_URL = {!! json_encode(url('/admin')) !!};
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/plugins/blockUI/blockUI.js') }}"></script>
<script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script src="{{asset('assets/admin/custom/custom.js')}}?v={{time()}}"></script>
<script src="{{ asset('assets/admin/custom/form.js') }}?v={{time()}}"></script>
</body>
</html>
