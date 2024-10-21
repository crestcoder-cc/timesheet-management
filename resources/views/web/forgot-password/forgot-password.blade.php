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
                    <h1 class="text-center">Forgot Password</h1>
                    <form id="addEditForm">
                        <input type="hidden" id="email" value="{{ $email }}"
                               name="email">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="password" class="form-control mt-2" name="new_password"
                                           placeholder="New Password">
                                </div>
                            </div>
                            </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="password" class="form-control mt-2" name="confirm_password"
                                           placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
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
<script>
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
    let $form = $('#addEditForm')
    $form.on('submit', function (e) {
        e.preventDefault()
        let formData = new FormData($form[0])
        loaderView()
        axios
            .post(APP_URL + '/reset-password-submit', formData)
            .then(function (response) {
                $form[0].reset();
                loaderHide();

                window.location.href = APP_URL + redirect_url


                notificationToast(response.data.message, 'success');
            })
            .catch(function (error) {
                console.log(error)
                notificationToast(error.response.data.message, 'warning')
                loaderHide();
            });
    })
</script>
</body>
</html>
