<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login {{ config('app.name') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('login-assets/images/icons/favicon.ico') }}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-assets/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-assets/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-assets/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login-assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login-assets/css/main.css') }}">
    <!--===============================================================================================-->
</head>

<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{ asset('login-assets/images/img-01.png') }}" alt="IMG">
            </div>

            <form id="formLogin" class="login100-form validate-form">
					<span class="login100-form-title">
						KIDDIELAND
					</span>

                <div class="wrap-input100">
                    <input class="input100" type="text" name="username" placeholder="Username" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Login
                    </button>
                </div>

{{--                <div class="text-center p-t-12">--}}
{{--						<span class="txt1">--}}
{{--							Forgot--}}
{{--						</span>--}}
{{--                    <a class="txt2" href="#">--}}
{{--                        Username / Password?--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <div class="text-center p-t-136">--}}
{{--                    <a class="txt2" href="#">--}}
{{--                        Create your Account--}}
{{--                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
            </form>
        </div>
    </div>
</div>

<!--===============================================================================================-->
<script src="{{ asset('login-assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('login-assets/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('login-assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('login-assets/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('login-assets/vendor/tilt/tilt.jquery.min.js') }}"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let formLogin = $('#formLogin');

    $(document).ready(function () {
        formLogin.submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('auth-api-submit') }}',
                method: 'post',
                data: $(this).serialize(),
                beforeSend: function() {
                    Swal.showLoading();
                },
                success: function (response) {
                    if (response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 800,
                            onClose: function () {
                                window.location = '{{ route('admin') }}';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Login Failed',
                            text: 'Silahkan cek username atau password anda',
                        });
                    }
                },
                error: function (response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'System error',
                    });
                }
            });
        });
    });
</script>
</body>
</html>
