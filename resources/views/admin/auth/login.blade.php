<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxFiat Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        ._logincontainer_5lqi5_1 {
            background:
                linear-gradient(to left, #FFFFFF 60%, transparent 0%),
        url('/assets/logo/image_2024_06_11T13_10_08_538Z.png');
            height: 100vh;
            background-size: cover;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*._logincontainer_5lqi5_1 {*/
        /*    background: linear-gradient(to right, #46ceff 40%, transparent 40%);*/
        /*    height: 100vh;*/
        /*    width: 100vw;*/
        /*    display: flex;*/
        /*    align-items: center;*/
        /*    justify-content: center;*/
        /*}*/

        ._wrapper_5lqi5_10 {
            height: 70%;
            width: 60%;
            display: flex;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        ._wrapper_5lqi5_10 {
            ._left_5lqi5_17 {
                width: 33.5%;
                /*background-color: #d2ff79;*/
                background:
                    url('/assets/logo/image_2024_06_11T13_10_14_943Z.png'); /* Add your image path here */
                display: flex;
                background-size: cover;
                align-items: center;
                justify-content: center;
                border-radius: 10px 0 0 10px;
            }
        }

        ._wrapper_5lqi5_10 {
            & ._left_5lqi5_17 {
                img {
                    width: 75%;
                }
            }
        }

        ._right_1pic1_1 {
            width: 66.5%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        ._right_1pic1_1 {
            form {
                display: flex;
                flex-direction: column;
                text-align: left;
                width: 45%;
                gap: 10px;
            }
        }

        .css-1nrlq1o-MuiFormControl-root {
            display: -webkit-inline-box;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            position: relative;
            min-width: 0;
            padding: 0;
            margin: 0;
            border: 0;
            vertical-align: top;
        }

        .css-14s5rfu-MuiFormLabel-root-MuiInputLabel-root {
            color: rgba(0, 0, 0, 0.6);
            font-family: "Roboto", "Helvetica", "Arial", sans-serif;
            font-weight: 400;
            font-size: 1rem;
            line-height: 1.4375em;
            letter-spacing: 0.00938em;
            padding: 0;
            position: relative;
            display: block;
            transform-origin: top left;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: calc(100% - 24px);
            position: absolute;
            left: 0;
            top: 0;
            -webkit-transform: translate(14px, 16px) scale(1);
            -moz-transform: translate(14px, 16px) scale(1);
            -ms-transform: translate(14px, 16px) scale(1);
            transform: translate(14px, 16px) scale(1);
            -webkit-transition: color 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms, -webkit-transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms, max-width 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
            transition: color 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms, transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms, max-width 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
            z-index: 1;
            pointer-events: none;
        }

        .css-9ddj71-MuiInputBase-root-MuiOutlinedInput-root {
            font-family: "Roboto", "Helvetica", "Arial", sans-serif;
            font-weight: 400;
            font-size: 1rem;
            line-height: 1.4375em;
            letter-spacing: 0.00938em;
            color: rgba(0, 0, 0, 0.87);
            box-sizing: border-box;
            position: relative;
            cursor: text;
            display: -webkit-inline-box;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-align-items: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            position: relative;
            border-radius: 4px;
        }

        .css-1t8l2tu-MuiInputBase-input-MuiOutlinedInput-input {
            font: inherit;
            letter-spacing: inherit;
            color: currentColor;
            padding: 4px 0 5px;
            border: 0;
            box-sizing: content-box;
            background: none;
            height: 1.4375em;
            margin: 0;
            -webkit-tap-highlight-color: transparent;
            display: block;
            min-width: 0;
            width: 100%;
            -webkit-animation-name: mui-auto-fill-cancel;
            animation-name: mui-auto-fill-cancel;
            -webkit-animation-duration: 10ms;
            animation-duration: 10ms;
            padding: 16.5px 14px;
        }

        .css-1d3z3hw-MuiOutlinedInput-notchedOutline {
            text-align: left;
            position: absolute;
            bottom: 0;
            right: 0;
            top: -5px;
            left: 0;
            margin: 0;
            padding: 0 8px;
            pointer-events: none;
            border-radius: inherit;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            min-width: 0%;
            border-color: rgba(0, 0, 0, 0.23);
        }

        .css-yjsfm1 {
            float: unset;
            width: auto;
            overflow: hidden;
            display: block;
            padding: 0;
            height: 11px;
            font-size: 0.75em;
            visibility: hidden;
            max-width: 0.01px;
            -webkit-transition: max-width 50ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
            transition: max-width 50ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
            white-space: nowrap;
        }

        .css-yjsfm1>span {
            padding-left: 5px;
            padding-right: 5px;
            display: inline-block;
            opacity: 0;
            visibility: visible;
        }

        .css-1nrlq1o-MuiFormControl-root {
            display: -webkit-inline-box;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            position: relative;
            min-width: 0;
            padding: 0;
            margin: 0;
            border: 0;
            vertical-align: top;
        }

        .css-14s5rfu-MuiFormLabel-root-MuiInputLabel-root {
            color: rgba(0, 0, 0, 0.6);
            font-family: "Roboto", "Helvetica", "Arial", sans-serif;
            font-weight: 400;
            font-size: 1rem;
            line-height: 1.4375em;
            letter-spacing: 0.00938em;
            padding: 0;
            position: relative;
            display: block;
            transform-origin: top left;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: calc(100% - 24px);
            position: absolute;
            left: 0;
            top: 0;
            -webkit-transform: translate(14px, 16px) scale(1);
            -moz-transform: translate(14px, 16px) scale(1);
            -ms-transform: translate(14px, 16px) scale(1);
            transform: translate(14px, 16px) scale(1);
            -webkit-transition: color 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms, -webkit-transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms, max-width 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
            transition: color 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms, transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms, max-width 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
            z-index: 1;
            pointer-events: none;
        }

        .css-o9k5xi-MuiInputBase-root-MuiOutlinedInput-root {
            font-family: "Roboto", "Helvetica", "Arial", sans-serif;
            font-weight: 400;
            font-size: 1rem;
            line-height: 1.4375em;
            letter-spacing: 0.00938em;
            color: rgba(0, 0, 0, 0.87);
            box-sizing: border-box;
            position: relative;
            cursor: text;
            display: -webkit-inline-box;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-align-items: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            position: relative;
            border-radius: 4px;
            padding-right: 14px;
        }

        .css-nxo287-MuiInputBase-input-MuiOutlinedInput-input {
            font: inherit;
            letter-spacing: inherit;
            color: currentColor;
            padding: 4px 0 5px;
            border: 0;
            box-sizing: content-box;
            background: none;
            height: 1.4375em;
            margin: 0;
            -webkit-tap-highlight-color: transparent;
            display: block;
            min-width: 0;
            width: 100%;
            -webkit-animation-name: mui-auto-fill-cancel;
            animation-name: mui-auto-fill-cancel;
            -webkit-animation-duration: 10ms;
            animation-duration: 10ms;
            padding: 16.5px 14px;
            padding-right: 0;
        }
        .css-1laqsz7-MuiInputAdornment-root {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            height: 0.01em;
            max-height: 2em;
            -webkit-align-items: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            white-space: nowrap;
            color: rgba(0, 0, 0, 0.54);
            margin-left: 8px;
        }
        .css-1yq5fb3-MuiButtonBase-root-MuiIconButton-root {
            display: -webkit-inline-box;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-align-items: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            position: relative;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
            background-color: transparent;
            outline: 0;
            border: 0;
            margin: 0;
            border-radius: 0;
            padding: 0;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            /* vertical-align: middle; */
            -moz-appearance: none;
            -webkit-appearance: none;
            -webkit-text-decoration: none;
            text-decoration: none;
            color: inherit;
            text-align: center;
            -webkit-flex: 0 0 auto;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            font-size: 1.5rem;
            padding: 8px;
            border-radius: 50%;
            overflow: visible;
            color: rgba(0, 0, 0, 0.54);
            -webkit-transition: background-color 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
            transition: background-color 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
            margin-right: -12px;
        }
        .css-i4bv87-MuiSvgIcon-root {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            width: 1em;
            height: 1em;
            display: inline-block;
            fill: currentColor;
            -webkit-flex-shrink: 0;
            -ms-flex-negative: 0;
            flex-shrink: 0;
            -webkit-transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
            transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
            font-size: 1.5rem;
        }
        .css-8je8zh-MuiTouchRipple-root {
            overflow: hidden;
            pointer-events: none;
            position: absolute;
            z-index: 0;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            border-radius: inherit;
        }
        .css-1d3z3hw-MuiOutlinedInput-notchedOutline {
            text-align: left;
            position: absolute;
            bottom: 0;
            right: 0;
            top: -5px;
            left: 0;
            margin: 0;
            padding: 0 8px;
            pointer-events: none;
            border-radius: inherit;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            min-width: 0%;
            border-color: rgba(0, 0, 0, 0.23);
        }
        .css-1wc848c-MuiFormHelperText-root {
            color: rgba(0, 0, 0, 0.6);
            font-family: "Roboto", "Helvetica", "Arial", sans-serif;
            font-weight: 400;
            font-size: 0.75rem;
            line-height: 1.66;
            letter-spacing: 0.03333em;
            text-align: left;
            margin-top: 3px;
            margin-right: 14px;
            margin-bottom: 0;
            margin-left: 14px;
        }
        ._right_1pic1_1 {
            & form {
                ._fpassword_1pic1_16 {
                    width: 100%;
                    text-align: right;
                    font-size: small;
                    text-decoration: none;
                    color: black;
                }
            }
        }
        ._right_1pic1_1 {
            & form {
                ._btn_1pic1_24 {
                    border-radius: 5px;
                    background-color: #0071b2;
                    height: 40px;
                    margin-top: 10px;
                }
            }
        }

    </style>
    <script src="{{asset('assets/js/layout.js')}}"></script>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/custom.min.css')}}?v={{time()}}" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="_logincontainer_5lqi5_1">
    <div class="_wrapper_5lqi5_10">
        <div class="_left_5lqi5_17"><img src="{{asset('assets/logo/Afotracx Color logo - no background.png')}}"></div>
        <div class="_right_1pic1_1">
            <h2 style="width: 45%;">Log in</h2>
            <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                @csrf

                <div class="MuiFormControl-root css-1nrlq1o-MuiFormControl-root">
{{--                    <label class="form-label" for="email">Email</label>--}}
                    <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorPrimary MuiInputBase-formControl css-9ddj71-MuiInputBase-root-MuiOutlinedInput-root">
                        <input aria-invalid="false" id="email" type="text" name="email" placeholder="Email"
                               class="MuiInputBase-input MuiOutlinedInput-input css-1t8l2tu-MuiInputBase-input-MuiOutlinedInput-input" value="">
                        <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-1d3z3hw-MuiOutlinedInput-notchedOutline">
                            <legend class="css-yjsfm1"><span>Email</span></legend>
                        </fieldset>
                    </div>
                    <p class="MuiFormHelperText-root MuiFormHelperText-sizeMedium MuiFormHelperText-contained css-1wc848c-MuiFormHelperText-root"
                       style="font-size: 10px;"></p>
                </div>
                <div class="MuiFormControl-root css-1nrlq1o-MuiFormControl-root">
{{--                    <label class="MuiFormLabel-root MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-sizeMedium MuiInputLabel-outlined MuiFormLabel-colorPrimary MuiInputLabel-root MuiInputLabel-formControl MuiInputLabel-animated MuiInputLabel-sizeMedium MuiInputLabel-outlined css-14s5rfu-MuiFormLabel-root-MuiInputLabel-root"--}}
{{--                           data-shrink="false" for="password">Password</label>--}}
                    <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorPrimary MuiInputBase-formControl MuiInputBase-adornedEnd css-o9k5xi-MuiInputBase-root-MuiOutlinedInput-root">
                        <input aria-invalid="false" id="password" type="password" name="password" placeholder="Password"
                               class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedEnd css-nxo287-MuiInputBase-input-MuiOutlinedInput-input" value="">
                        <div class="MuiInputAdornment-root MuiInputAdornment-positionEnd MuiInputAdornment-outlined MuiInputAdornment-sizeMedium css-1laqsz7-MuiInputAdornment-root">
                            <button id="togglePassword" class="MuiButtonBase-root MuiIconButton-root MuiIconButton-edgeEnd MuiIconButton-sizeMedium css-1yq5fb3-MuiButtonBase-root-MuiIconButton-root"
                                    tabindex="0" type="button">
                                <svg id="passwordIcon" class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-i4bv87-MuiSvgIcon-root"
                                     focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="VisibilityIcon">
                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5M12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5m0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3"></path>
                                </svg>
                                <span class="MuiTouchRipple-root css-8je8zh-MuiTouchRipple-root"></span>
                            </button>
                        </div>
                        <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-1d3z3hw-MuiOutlinedInput-notchedOutline">
                            <legend class="css-yjsfm1"><span>Password</span></legend>
                        </fieldset>
                    </div>
                    <p class="MuiFormHelperText-root MuiFormHelperText-sizeMedium MuiFormHelperText-contained css-1wc848c-MuiFormHelperText-root"
                       style="font-size: 10px;"></p>
                </div>
{{--                <a class="_fpassword_1pic1_16" href="/forgotpassword">forgot password?</a>--}}
                <button class="MuiButtonBase-root MuiButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeMedium MuiButton-containedSizeMedium MuiButton-colorPrimary MuiButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeMedium MuiButton-containedSizeMedium MuiButton-colorPrimary _btn_1pic1_24 css-sghohy-MuiButtonBase-root-MuiButton-root"
                        tabindex="0" type="submit">Login<span class="MuiTouchRipple-root css-8je8zh-MuiTouchRipple-root"></span>
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.innerHTML = '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5M12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5m1-10.08l2.83 2.83-2.83 2.83-1.41-1.41 1.42-1.42-1.42-1.42L13 6.92M8.59 8.76 7.17 10.17l1.42 1.42-1.42 1.42L10 16.41l1.42-1.42L10 13.58l1.42-1.42L8.59 8.76z"></path>';
        } else {
            passwordInput.type = 'password';
            passwordIcon.innerHTML = '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5M12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5m0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3"></path>';
        }
    });
</script>
<script>
    var form_url = '/login-check'
    var redirect_url = '/dashboard'
    var APP_URL = {!! json_encode(url('/admin')) !!};
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/plugins/blockUI/blockUI.js') }}"></script>
<script src="{{ asset('assets/plugins/axios/axios.min.js') }}"></script>
<script src="{{asset('assets/custom-js/custom.js')}}?v={{time()}}"></script>
<script src="{{ asset('assets/custom-js/custom/form.js') }}?v={{time()}}"></script>

<!-- JAVASCRIPT -->
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{asset('assets/js/plugins.js')}}"></script>

<!-- particles js -->
<script src="{{asset('assets/libs/particles.js/particles.js')}}"></script>
<!-- particles app js -->
<script src="{{asset('assets/js/pages/particles.app.js')}}"></script>
<!-- password-addon init -->
<script src="{{asset('assets/js/pages/password-addon.init.js')}}"></script>
</body>
</html>
