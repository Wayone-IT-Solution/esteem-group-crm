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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicon icon-->
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify-icons/themify-icons/css/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/apexcharts/dist/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/simple-datatables/dist/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">

    <style>
        .simplebar-content-wrapper {
            background-color: #26477a !important;
        }

        .sidebar-link {
            color: white !important;
        }


        .badge {
            font-size: 11px;
            padding: 3px 7px;
            border-radius: 10px;
        }



        /* Hardened submenu styles */
        .sidebar-submenu {
            display: none;
            /* background-color: #1e3a66 !important; */
            padding-left: 20px;
            transition: all 0.3s ease;
            list-style: none;
        }

        .sidebar-submenu.show {
            display: block !important;
        }

        .sidebar-submenu li a {
            color: #d1d7e0 !important;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
        }

        .sidebar-submenu li a:hover {
            color: #ffffff !important;
            background-color: #2a4e8a !important;
        }

        .toggle-icon {
            transition: transform 0.3s ease;
        }

        .toggle-icon.rotate {
            transform: rotate(90deg);
        }

        .toggle-icon.down.rotate {
            transform: rotate(180deg);
        }

        /* Ensure no external styles interfere */
        .sidebar-menu,
        .sidebar-submenu {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>

    <main class="page-wrapper compact-wrapper" id="pageWrapper">
        <header class="page-header row">
            <div class="logo-wrapper d-flex align-items-center col-auto">
                <a href="{{url('admin')}}">
                    <img class="for-light" src="{{ asset('assets/images/logo.png') }}" style="width: 110px;" alt="logo">
                    <img class="for-dark" src="{{ asset('assets/images/logo.png') }}" style="width: 110px;" alt="logo">
                </a>
                <a class="close-btn" href="javascript:void(0)">
                    <div class="toggle-sidebar">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </a>
            </div>
            <div class="page-main-header col">
                <div class="header-left d-lg-block d-none"></div>
                <div class="nav-right">
                    <ul class="header-right">
                        <li class="profile-dropdown custom-dropdown" style="position: relative;">
                            <div class="d-flex align-items-center" style="cursor: pointer;">
                                <img style="width: 100px; height: 60px;" src="{{ asset('assets/images/logo.png') }}" alt="">
                                <div class="flex-grow-1">
                                    <h5>{{ Auth::user()->name ?? '' }}</h5>
                                    <span>{{ Auth::user()->role ?? '' }}</span>
                                </div>
                            </div>
                            <div class="custom-menu overflow-hidden">
                                <ul>
                                    <li class="d-flex">
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
        <div class="page-body-wrapper">
            <div class="overlay"></div>
            <aside class="page-sidebar" data-sidebar-layout="stroke-svg">
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
                        @role('admin')
                        <hr>


                        <li class="sidebar-list">
                            <a class="sidebar-link" href="{{ route('admin.users.all') }}">
                                <span>
                                    <i class="fa-solid fa-users-rectangle me-2"></i>
                                    All Users
                                </span>
                            </a>
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
                            <a class="sidebar-link" href="{{ route('admin.department') }}">
                                <span>
                                    <i class="fa-solid fa-building-user me-2"></i> Departments
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
                            <a class="sidebar-link" href="{{ route('admin.status.index') }}">
                                <span>
                                    <i class="fa-solid fa-toggle-on me-2"></i>
                                    Status Management
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link" href="{{ route('admin.request.all') }}">
                                <span>
                                    <i class=" fa-solid fa-paper-plane me-2"></i>
                                    Request Management
                                </span>
                            </a>
                        </li>
                        @endrole()
                        <hr>
                        <li class="sidebar-list">
                            <a class="sidebar-link d-flex align-items-center justify-content-between" href="javascript:void(0)" data-toggle="submenu">
                                <span class="d-flex align-items-center text-nowrap">
                                    <i class="fa-solid fa-users-rectangle me-2"></i>
                                    Enquiries
                                </span>
                                <i class="fa-solid fa-angle-down toggle-icon down"></i>
                            </a>

                            @php
                            use App\Models\Company;
                            use App\Models\LeadModel;
                            use Illuminate\Support\Facades\Auth;

                            $user = Auth::user();
                            $isAdmin = $user->role === 'admin';
                            $userId = $user->id;

                            $companies = Company::with('status')->get();
                            @endphp

                            <ul class="sidebar-submenu">
                                @foreach ($companies as $company)
                                @php
                                $companyName = $company->name ?? '';
                                $words = explode(' ', $companyName);
                                $displayName = count($words) > 3 ? implode(' ', array_slice($words, 0, 3)) . '...' : $companyName;
                                @endphp

                                <li class="sidebar-list">
                                    <a class="sidebar-link" href="javascript:void(0)">
                                        <i class="fa-solid fa-building-columns me-2"></i>
                                        <span>{{ $displayName }}</span>
                                    </a>
                                    <ul class="sidebar-submenu" style="display: none;">
                                        @if (!empty($company->status))
                                        @foreach ($company->status as $status)
                                        @php
                                        $query = LeadModel::where('company_id', $company->id)
                                        ->where('status', $status->status);

                                        if (!$isAdmin) {
                                        $query->whereHas('assinges', function ($q) use ($userId) {
                                        $q->where('user_id', $userId);
                                        });
                                        }

                                        $leadCount = $query->count();
                                        @endphp

                                        <li>
                                            <a href="{{ url('admin/leads/'.$company->id.'/'.$status->status) }}" style="font-size: 13px;width: 200px;">
                                                <i class="fa-solid fa-toggle-on me-2"></i>
                                                {{ $status->status ?? '' }}
                                                <span class="badge bg-warning ms-2">{{ $leadCount }}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <hr>
                        <li class="sidebar-list">
                            <a class="sidebar-link" href="{{ url('auth/logout') }}">
                                <span>
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                                    Logout
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
            <div class="page-body">
                @yield('content')
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/js/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/dashboard-2.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('functions/comman.js') }}"></script>
    <script src="https://kit.fontawesome.com/71be5731d3.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Sidebar script loaded'); // Debug: Confirm script runs

            // Select all links with data-toggle="submenu"
            const toggleLinks = document.querySelectorAll('[data-toggle="submenu"]');

            toggleLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation(); // Prevent parent events

                    console.log('Toggle link clicked:', this.textContent); // Debug: Track clicks

                    // Find the next submenu
                    const submenu = this.nextElementSibling;
                    if (!submenu || !submenu.classList.contains('sidebar-submenu')) {
                        console.log('No submenu found for:', this.textContent); // Debug
                        return;
                    }

                    // Toggle submenu visibility
                    const isVisible = submenu.classList.contains('show');
                    submenu.classList.toggle('show', !isVisible);

                    // Toggle icon rotation
                    const icon = this.querySelector('.toggle-icon');
                    if (icon) {
                        icon.classList.toggle('rotate', !isVisible);
                    }

                    // Close other submenus at the same level
                    const parentList = this.closest('.sidebar-submenu') || this.closest('.sidebar-menu');
                    const siblingSubmenus = parentList.querySelectorAll(':scope > li > .sidebar-submenu.show, :scope > .sidebar-list > .sidebar-submenu.show');
                    siblingSubmenus.forEach(sibling => {
                        if (sibling !== submenu) {
                            sibling.classList.remove('show');
                            const siblingIcon = sibling.previousElementSibling.querySelector('.toggle-icon');
                            if (siblingIcon) {
                                siblingIcon.classList.remove('rotate');
                            }
                        }
                    });

                    console.log('Submenu toggled:', submenu.classList.contains('show')); // Debug
                });
            });

            // Prevent submenu links from closing parent menu
            document.querySelectorAll('.sidebar-submenu a:not([data-toggle="submenu"])').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.stopPropagation(); // Allow navigation without toggling
                    console.log('Navigating to:', this.href); // Debug
                });
            });
        });
    </script>
</body>

</html>