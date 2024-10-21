<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee - Login</title>
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
                        <img class="mb-2" src="{{asset('assets/logo/Afotracx Color logo - no background.png')}}"
                             alt="logo">
                    </div>
                    <h1 class="text-center">Sign In</h1>
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                        @csrf
                        <input type="text" name="email" class="form-control" placeholder="Email">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="forgotpwd text-end">
                            <a href="#" id="userForgotPassword">Forgot Password?</a>
                        </div>
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
                    <p>&copy; {{date('Y')}} AfoTracx Pro</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="forgotPasswordModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Forgot Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" data-parsley-validate="" id="forgotPasswordForm" role="form">
                @csrf
                <div class="modal-body">
                    <div class="form-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="forgot_email" id="forgot_email"
                                           placeholder="Email" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="forgot_password_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var form_url = '/login-check'
    var redirect_url = '/home'
    var APP_URL = {!! json_encode(url('/')) !!};
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('assets/plugins/blockUI/blockUI.js') }}"></script>
<script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script src="{{asset('assets/web/custom/custom.js')}}?v={{time()}}"></script>
<script src="{{ asset('assets/web/custom/form.js') }}?v={{time()}}"></script>
<script>
    $('#userForgotPassword').on('click', function () {
        $('#forgotPasswordModal').modal('show');
    })

    $('#forgot_password_submit').on('click', function () {
        let email = $('#forgot_email').val()
        if (email === '') {
            notificationToast('Please Enter Email', 'warning')
            return false
        }
        loaderView()
        axios
            .post(APP_URL + '/send-mail', {
                email: email,
            })
            .then(function (response) {
                $('#forgotPasswordModal').modal('hide')
                loaderHide()
                notificationToast(response.data.message, 'success')
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })
    })
</script>
</body>
</html>
