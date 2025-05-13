<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Esteem Group>
    <meta name=" keywords" content="Esteem Group">
    <meta name="author" content="pixelstrap">
    <title>Esteem Group | CRM </title>
    <!-- Favicon icon-->
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <!-- Font awesome icon css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/%40fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/%40fortawesome/fontawesome-free/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/%40fortawesome/fontawesome-free/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/%40fortawesome/fontawesome-free/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/%40fortawesome/fontawesome-free/css/regular.css') }}">
    <!-- Ico Icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/%40icon/icofont/icofont.css') }}">
    <!-- Flag Icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- Themify Icon css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/vendors/themify-icons/themify-icons/css/themify.css') }}">
    <!-- Animation css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css/animate.css') }}">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/vendors/weather-icons/css/weather-icons.min.css') }}">
    <!-- App css-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <!-- tap to top-->
    <div class="tap-top">
        <svg class="feather">
            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-up">
            </use>
        </svg>
    </div>
    <!-- login page start-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-7 login_one_image"><img class="bg-img-cover bg-center"
                    src="{{ asset('assets/images/crm.png') }}" alt="looginpage"></div>
            <div class="col-xl-5 p-0">
                <div class="login-card login-dark login-bg">
                    <div>
                        <div><a class="logo" href="javascript:void(0)"><img style="width: auto; height:60px;"
                                    class="img-fluid for-light" src="{{ asset('assets/images/logo.png') }}"
                                    alt="looginpage"><img class="for-dark m-auto"
                                    src="{{ asset('assets/images/logo.png') }}" alt="logo"></a></div>
                        <div class="login-main">
                            <form method="post" class="theme-form mb-5" id="loginform"
                                action="{{ route('validate.login') }}">

                                @csrf()
                                <h2 class="text-center">Sign in to account</h2>
                                <p class="text-center">Enter your email &amp; password to login</p>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email" required=""
                                        placeholder="Test@gmail.com">
                                    <div class="error" id="email-error"></div>

                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" name="password" type="password" required
                                            placeholder="*********" id="password">

                                        <!-- Toggle Button -->
                                        <div class="show-hide" onclick="togglePassword()">
                                            <span class="show"></span>
                                        </div>

                                        <div class="error" id="password-error"></div>
                                    </div>
                                </div>

                                <!-- Script to toggle password visibility -->
                                <script>
                                    function togglePassword() {
                                        const passwordInput = document.getElementById('password');
                                        const toggleIcon = document.querySelector('.show-hide .show');

                                        if (passwordInput.type === 'password') {
                                            passwordInput.type = 'text';
                                            toggleIcon.classList.add('active'); // Optional: style the icon differently when visible
                                        } else {
                                            passwordInput.type = 'password';
                                            toggleIcon.classList.remove('active');
                                        }
                                    }
                                </script>
                                <div class="form-group mb-0 checkbox-checked">
                                    <div class="form-check checkbox-solid-info">
                                        <input class="form-check-input" id="solid6" type="checkbox">
                                        <label class="form-check-label" for="solid6">Remember password </label>
                                        <div class="text-end mt-3"><button type="submit" id="loginbutton"
                                                class="btn btn-primary btn-block w-100 text-white"
                                                href="index.html">Sign in </button></div>
                                    </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jquery-->
        <script src="{{ asset('assets/js/vendors/jquery/dist/jquery.min.js') }}"></script>
        <!-- bootstrap js-->
        <script src="{{ asset('assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/config.js') }}"></script>
        <!-- scrollbar js-->
        <!-- scrollable-->
        <script src="{{ asset('assets/js/password.js') }}"></script>
        <!-- customizer-->
        <!-- custom script -->
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{{ asset('functions/auth.js') }}"></script>


    </div>
</body>

</html>
