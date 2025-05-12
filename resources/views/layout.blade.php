<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Esteem Group">
    <meta name="keywords" content="Esteem Group">
    <meta name="author" content="Esteem Group">
    <title>Esteem Group | Admin</title>
    <!-- Favicon icon-->
    <link rel="icon" href="{{ asset('assets/images/favicon/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.png') }}" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <!-- Font awesome icon css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/fortawesome/fontawesome-free/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/fortawesome/fontawesome-free/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/fortawesome/fontawesome-free/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/fortawesome/fontawesome-free/css/regular.css') }}">
    <!-- Ico Icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icon/icofont/icofont.css') }}">
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
    <!-- Apex Chart css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/apexcharts/dist/apexcharts.css') }}">
    <!-- Data Table css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/simple-datatables/dist/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/swiper/swiper-bundle.min.css') }}">
    <!-- App css-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">

</head>

<body>
    <!-- tap to top-->
    {{-- <div class="tap-top">
        <svg class="feather">
            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-up">
            </use>
        </svg>
    </div> --}}
    <!-- loader-->
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>
    <main class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page header start -->

        <header class="page-header row">
            <div class="logo-wrapper d-flex align-items-center col-auto"><a href="index.html"><img class="for-light"
                        src="{{ asset('assets/images/logo.png') }}" style="width: 110px;" alt="logo"><img
                        class="for-dark" src="{{ asset('assets/images/logo.png') }}" style="width: 110px;"
                        alt="logo"></a><a class="close-btn" href="javascript:void(0)">
                    <div class="toggle-sidebar">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </a></div>
            <div class="page-main-header col">
                <div class="header-left d-lg-block d-none">

                </div>
                <div class="nav-right">
                    <ul class="header-right">


                        <!-- Notification menu-->

                        <!-- Bookmark menu-->

                        <!-- Cart menu-->

                        <!-- Bookmark menu-->

                        <li class="profile-dropdown custom-dropdown" style="position: relative;">
                            <div class="d-flex align-items-center" style="cursor: pointer;">
                                <img style="width: 100px; height: 60px;" src="{{ asset('assets/images/logo.png') }}"
                                    alt="">
                                <div class="flex-grow-1">
                                    <h5>{{ Auth::user()->name ?? '' }}</h5>
                                    <span>{{ Auth::user()->role ?? '' }}</span>
                                </div>
                            </div>
                            <div class="custom-menu overflow-hidden">
                                <ul>
                                    <li class="d-flex">
                                        <svg class="svg-color">
                                            <use
                                                href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Profile">
                                            </use>
                                        </svg>
                                        <a class="ms-2" href="user-profile.html">Change Password</a>
                                    </li>
                                    <li class="d-flex">
                                        <svg class="svg-color">
                                            <use
                                                href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Login">
                                            </use>
                                        </svg>
                                        <a class="ms-2" href="{{ url('auth/logout') }}">Log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const trigger = document.querySelector('.profile-dropdown > .d-flex');
                                const menu = document.querySelector('.profile-dropdown .custom-menu');

                                trigger.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    menu.classList.toggle('show');
                                });

                                document.addEventListener('click', function() {
                                    menu.classList.remove('show');
                                });
                            });
                        </script>

                        <style>
                            .custom-menu {
                                display: none;
                                position: absolute;
                                background: white;
                                z-index: 1000;
                                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                            }

                            .custom-menu.show {
                                display: block;
                            }
                        </style>

                    </ul>
                </div>
            </div>
        </header>

        <!-- Page header end-->
        <div class="page-body-wrapper">

            <!-- Page sidebar start-->
            <div class="overlay"></div>
            <aside class="page-sidebar" data-sidebar-layout="stroke-svg">
                <div class="left-arrow" id="left-arrow">
                    <svg class="feather">
                        <use
                            href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-left">
                        </use>
                    </svg>
                </div>
                <div id="sidebar-menu">
                    <ul class="sidebar-menu" id="simple-bar">
                        <li class="pin-title sidebar-list p-0">
                            <h5 class="sidebar-main-title">Pinned</h5>
                        </li>
                        <li class="line pin-line"></li>

                        <li class="sidebar-list">
                            <a class="sidebar-link" href="{{ url('/admin') }}">
                                <span>
                                    <i class="fa-solid fa-gauge me-2"></i>
                                    Dashboard
                                </span>
                            </a>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                <span class="d-flex align-items-center text-nowrap">
                                    <i class="fa-solid fa-users-rectangle me-2"></i>
                                    Department & Users
                                </span>
                                <i class="fa-solid fa-angle-down toggle-icon"></i>
                            </a>
                            <ul class="sidebar-submenu" style="display: none;">
                                <li>
                                    <a href="{{ route('admin.all_users') }}">
                                        <i class="fa-solid fa-user-group me-2"></i> All Users
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.department') }}">
                                        <i class="fa-solid fa-building-user me-2"></i> Departments
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-list">
                            <a class="sidebar-link" href="{{ route('admin.companies') }}">
                                <span>
                                    <i class="fa-solid fa-building-columns me-2"></i>
                                    Companies
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link" href="{{ route('admin.roles') }}">
                                <span>
                                    <i class="fa-solid fa-user-shield me-2"></i>
                                    Role Management
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link" href="{{ url('auth/logout') }}">
                                <span>
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                                    Logout
                                </span>
                            </a>
                        </li>

                    </ul>
                    </li>

                </div>
                <div class="right-arrow" id="right-arrow">
                    <svg class="feather">
                        <use
                            href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-right">
                        </use>
                    </svg>
                </div>
            </aside>
            <!-- Page sidebar end-->
            <div class="page-body">



                @yield('content')






            </div>
    </main>
    <!-- jquery-->
    <script src="{{ asset('assets/js/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- bootstrap js-->
    <script src="{{ asset('assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Sidebar js-->
    <script src="{{ asset('assets/js/sidebar.js') }}"></script>
    <!-- Apexchart js-->
    <script src="{{ asset('assets/js/vendors/apexcharts/dist/apexcharts.min.js') }}"></script>
    <!-- Datatable js-->
    <script src="{{ asset('assets/js/vendors/simple-datatables/dist/umd/simple-datatables.js') }}"></script>
    <!-- dashboard 2 js-->
    <script src="{{ asset('assets/js/dashboard/dashboard-2.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
    <!-- scrollable-->
    <script src="{{ asset('assets/js/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <!-- customizer-->
    {{-- <script src="{{ asset('assets/js/theme-customizer/customizer.js') }}"></script> --}}
    <!-- custom script -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    {{-- Font Awsome --}}
    <script src="https://kit.fontawesome.com/71be5731d3.js" crossorigin="anonymous"></script>
</body>


</html>
