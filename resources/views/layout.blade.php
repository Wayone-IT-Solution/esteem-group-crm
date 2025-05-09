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
    <link rel="icon" href="{{ asset('assets/images/favicon/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.png')}}" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <!-- Font awesome icon css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/fortawesome/fontawesome-free/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/fortawesome/fontawesome-free/css/brands.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/fortawesome/fontawesome-free/css/solid.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/fortawesome/fontawesome-free/css/regular.css')}}">
    <!-- Ico Icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icon/icofont/icofont.css')}}">
    <!-- Flag Icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css')}}">
    <!-- Themify Icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify-icons/themify-icons/css/themify.css')}}">
    <!-- Animation css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css/animate.css')}}">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/weather-icons/css/weather-icons.min.css')}}">
    <!-- Apex Chart css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/apexcharts/dist/apexcharts.css')}}">
    <!-- Data Table css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/simple-datatables/dist/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/swiper/swiper-bundle.min.css')}}">
    <!-- App css-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css')}}" media="screen">
</head>

<body>
    <!-- tap to top-->
    <div class="tap-top">
        <svg class="feather">
            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-up"></use>
        </svg>
    </div>
    <!-- loader-->
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>
    <main class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page header start -->
        <header class="page-header row">
            <div class="logo-wrapper d-flex align-items-center col-auto"><a href="index.html"><img class="for-light" src="{{ asset('assets/images/logo.png')}}" style="width: 110px;" alt="logo"><img class="for-dark" src="{{ asset('assets/images/logo.png')}}" style="width: 110px;"  alt="logo"></a><a class="close-btn" href="javascript:void(0)">
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
                       
                        <li class="profile-dropdown custom-dropdown">
                            <div class="d-flex align-items-center"><img style="width: 140xp; height: 40px;" src="{{ asset('assets/images/logo.png')}}" alt="">
                                <div class="flex-grow-1">
                                    <h5>{{ Auth::user()->name ?? '' }}</h5><span>{{ Auth::user()->role ?? '' }}</span>
                                </div>
                            </div>
                            <div class="custom-menu overflow-hidden">
                                <ul>
                                    <li class="d-flex">
                                        <svg class="svg-color">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Profile"></use>
                                        </svg><a class="ms-2" href="user-profile.html">Change Password</a>
                                    </li>
                                    
                                    <li class="d-flex">
                                        <svg class="svg-color">
                                            <use href="{{ url('auth/logout') }}"></use>
                                        </svg><a class="ms-2" href="{{ url('auth/logout') }}">Log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
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
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-left"></use>
                    </svg>
                </div>
                <div id="sidebar-menu">
                    <ul class="sidebar-menu" id="simple-bar">
                        <li class="pin-title sidebar-list p-0">
                            <h5 class="sidebar-main-title">Pinned</h5>
                        </li>
                        <li class="line pin-line"></li>
                        <li class="sidebar-main-title">General</li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Home"></use>
                                </svg><span>Dashboard</span>
                                <div class="badge badge-primary rounded-pill">3</div>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="index.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Default</a></li>
                                <li><a href="dashboard-02.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Ecommerce</a></li>
                                <li><a href="dashboard-03.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Project</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pie"></use>
                                </svg><span>Widgets</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="general-widget.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>General</a></li>
                                <li><a href="chart-widget.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Chart</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Document"></use>
                                </svg><span>Page Layout</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="box-layout.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Box Layout</a><a href="layout-rtl.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>RTL</a><a href="layout-dark.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Dark</a></li>
                            </ul>
                        </li>
                        <li class="line"> </li>
                        <li class="sidebar-main-title">Applications</li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Info-circle"></use>
                                </svg><span>Project</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="project-list.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Project List</a></li>
                                <li> <a href="projectcreate.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Create New</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="file-manager.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Paper"></use>
                                </svg><span>File Manager</span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="kanban-board.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Wallet"></use>
                                </svg><span>Kanban Board</span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Bag"></use>
                                </svg><span>Ecommerce</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="product.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Product</a></li>
                                <li><a href="product-page.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Product Page </a></li>
                                <li><a href="add-products.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Add Product </a></li>
                                <li><a href="list-products.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Product List</a></li>
                                <li><a href="payment-details.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Payment Details </a></li>
                                <li><a href="order-history.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Order History </a></li>
                                <li><a class="submenu-title" href="javascript:void(0)">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Invoice
                                        <svg class="feather">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                        </svg></a>
                                    <ul class="according-submenu">
                                        <li><a href="invoice-1.html">
                                                Invoice-1</a></li>
                                        <li><a href="invoice-2.html">
                                                Invoice-2</a></li>
                                        <li><a href="invoice-3.html">
                                                Invoice-3</a></li>
                                        <li><a href="invoice-4.html">
                                                Invoice-4</a></li>
                                        <li><a href="invoice-5.html">
                                                Invoice-5</a></li>
                                        <li><a href="invoice-template.html">
                                                Invoice-6</a></li>
                                    </ul>
                                </li>
                                <li><a href="cart.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Cart </a></li>
                                <li><a href="list-wish.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Wishlist </a></li>
                                <li><a href="checkout.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Checkout </a></li>
                                <li><a href="pricing.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Pricing</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="letter-box.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Message"></use>
                                </svg><span>Letter Box</span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Chat"></use>
                                </svg><span>Chat</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="private-chat.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Private Chat</a></li>
                                <li><a href="group-chat.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Group Chat</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Profile"></use>
                                </svg><span>Users</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="user-profile.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>User Profile</a></li>
                                <li><a href="edit-profile.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>User Edit</a></li>
                                <li><a href="user-cards.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>User Cards</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="bookmark.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Bookmark"></use>
                                </svg><span>Bookmarks</span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="contacts.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Contacts"></use>
                                </svg><span>Contacts</span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="task.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Tick-square"></use>
                                </svg><span>Tasks </span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="calendar-basic.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Calendar"></use>
                                </svg><span>Calendar</span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="social-app.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Camera"></use>
                                </svg><span>Social App </span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="to-do.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Edit"></use>
                                </svg><span>To-Do </span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="search.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Search"></use>
                                </svg><span>Search Result</span></a>
                        </li>
                        <li class="line"></li>
                        <li class="sidebar-main-title">Components</li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="buttons.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#More-box"></use>
                                </svg><span>Buttons </span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Folder"></use>
                                </svg><span>Ui Kits</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="typography.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Typography</a></li>
                                <li><a href="avatars.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Avatars</a></li>
                                <li><a href="grid.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Grid</a></li>
                                <li><a href="helper-classes.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Helper Classes</a></li>
                                <li><a href="tag-pills.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Tag & Pills</a></li>
                                <li><a href="progress.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Progress</a></li>
                                <li><a href="popover.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Popover</a></li>
                                <li><a href="tooltip.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Tooltip</a></li>
                                <li><a href="alert.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Alert</a></li>
                                <li><a href="modal.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Modal</a></li>
                                <li><a href="dropdown.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Dropdown</a></li>
                                <li><a href="according.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Accordion</a></li>
                                <li><a href="bootstrap-tabs.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Tabs</a></li>
                                <li><a href="list.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Lists</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Ticket-star"></use>
                                </svg><span>Bonus Ui</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="scrollable.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Scrollable </a></li>
                                <li><a href="breadcrumbs.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Breadcrumb</a></li>
                                <li><a href="pagination.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Pagination</a></li>
                                <li><a href="ribbons.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Ribbons</a></li>
                                <li><a href="tree.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Tree View</a></li>
                                <li><a href="toasts.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Toast</a></li>
                                <li><a href="rating.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Rating</a></li>
                                <li><a href="dropzone.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Dropzone</a></li>
                                <li><a href="tour.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Tour</a></li>
                                <li><a href="sweetalert.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Sweetalert2</a></li>
                                <li><a href="modal-animated.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Animated Modal</a></li>
                                <li><a href="slider.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Slider</a></li>
                                <li><a href="range-slider.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Range Slider</a></li>
                                <li><a href="image-cropper.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Image Cropper</a></li>
                                <li><a href="basic-card.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Basic Card</a></li>
                                <li><a href="creative-card.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Creative Card</a></li>
                                <li><a href="dragabble.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Draggable Card</a></li>
                                <li><a href="timeline.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Timeline</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Category"></use>
                                </svg><span>Animation</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="wow.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Wow Animation</a></li>
                                <li><a href="aos.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>AOS Animation</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Activity"></use>
                                </svg><span>Icons</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="flag-icon.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Flag Icon</a></li>
                                <li><a href="font-awesome.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Fontawesome Icon</a></li>
                                <li><a href="feather-icon.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Feather Icon</a></li>
                                <li><a href="iconly-icon.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Iconly Icon</a></li>
                                <li><a href="ico-icon.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Ico Icon</a></li>
                                <li><a href="themify-icon.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Themify icon</a></li>
                                <li><a href="whether-icon.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Whether Icon</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Chart"></use>
                                </svg><span>Charts</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="apexchart.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Apexchart</a></li>
                                <li><a href="chartist.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Chartist</a></li>
                                <li><a href="chartjs.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Chartjs</a></li>
                            </ul>
                        </li>
                        <li class="line"></li>
                        <li class="sidebar-main-title">Forms & table</li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Filter"></use>
                                </svg><span>Form Controls</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="base_input.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Base Input</a></li>
                                <li><a href="radio-checkbox-control.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Check & Radio Box</a></li>
                                <li><a href="input-group.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Input Groups</a></li>
                                <li><a href="megaoptions.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Mega Options</a></li>
                                <li><a href="form-validation.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Form validation</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Scan"></use>
                                </svg><span>Form Widgets</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="datepicker.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Date picker </a></li>
                                <li><a href="touchspin.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Touchspin</a></li>
                                <li><a href="select2.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>select 2</a></li>
                                <li><a href="switch.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Switch</a></li>
                                <li><a href="typeahead.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Typeahead</a></li>
                                <li><a href="clipboard.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Clipboard</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Icon-plus"></use>
                                </svg><span>Form Layout</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="form-wizard.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Form wizard 1</a></li>
                                <li><a href="form-wizard-two.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Form wizard 2</a></li>
                                <li><a href="two-factor.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Two Factor</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Edit-line"></use>
                                </svg><span>Tables</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a class="submenu-title" href="javascript:void(0)">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Bootstrap Table
                                        <svg class="feather">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                        </svg></a>
                                    <ul class="according-submenu">
                                        <li><a href="basic-table.html">
                                                Basic Tables</a></li>
                                        <li><a href="table_components.html">
                                                Table Components</a></li>
                                    </ul>
                                </li>
                                <li><a class="submenu-title" href="javascript:void(0)">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Data Tables
                                        <svg class="feather">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                        </svg></a>
                                    <ul class="according-submenu">
                                        <li><a href="datatable-basic-init.html">
                                                Basic Init</a></li>
                                        <li><a href="datatable-advance.html">
                                                Advance Init</a></li>
                                        <li><a href="datatable-API.html">
                                                API</a></li>
                                        <li><a href="datatable-data-source.html">
                                                Data Sources</a></li>
                                    </ul>
                                </li>
                                <li><a href="datatable-ext-autofill.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Ex. Data Tables</a></li>
                                <li><a href="jsgrid-table.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Js Grid Table</a></li>
                            </ul>
                        </li>
                        <li class="line"> </li>
                        <li class="sidebar-main-title">Pages</li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="landing-page.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Wallet"></use>
                                </svg><span>Landing Page</span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="sample-page.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Paper-plus"></use>
                                </svg><span>Sample Page</span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="translate.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Play"></use>
                                </svg><span>Translate</span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="https://admin.pixelstrap.net/edmin/starter-kit/index.html" target="_blank">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Star"></use>
                                </svg><span>Starter kit</span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Password"></use>
                                </svg><span>Others</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a class="submenu-title" href="javascript:void(0)">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Error Page
                                        <svg class="feather">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                        </svg></a>
                                    <ul class="according-submenu">
                                        <li><a href="error-page1.html">
                                                Error Page 1</a></li>
                                        <li><a href="error-page2.html">
                                                Error Page 2</a></li>
                                        <li><a href="error-page3.html">
                                                Error Page 3</a></li>
                                        <li><a href="error-page4.html">
                                                Error Page 4</a></li>
                                        <li><a href="error-page5.html">
                                                Error Page 5</a></li>
                                        <li><a href="error-page6.html">
                                                Error Page 6</a></li>
                                    </ul>
                                </li>
                                <li><a class="submenu-title" href="javascript:void(0)">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Authentication
                                        <svg class="feather">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                        </svg></a>
                                    <ul class="according-submenu">
                                        <li><a href="login.html">
                                                Login simple</a></li>
                                        <li><a href="login_one.html">
                                                Login With Bg Image</a></li>
                                        <li><a href="login_two.html">
                                                Login With Image Two</a></li>
                                        <li><a href="login-bs-validation.html">
                                                Login With Validation</a></li>
                                        <li><a href="login-bs-tt-validation.html">
                                                Login With Tooltip</a></li>
                                        <li><a href="login-sa-validation.html">
                                                Login With Sweetalert</a></li>
                                        <li><a href="sign-up.html">
                                                Register Simple</a></li>
                                        <li><a href="sign-up-one.html">
                                                Register With Bg Image</a></li>
                                        <li><a href="sign-up-two.html">
                                                Register With Image Two</a></li>
                                        <li><a href="sign-up-wizard.html">
                                                Register Wizard</a></li>
                                        <li><a href="unlock.html">
                                                Unlock User</a></li>
                                        <li><a href="forget-password.html">
                                                Forget Password</a></li>
                                        <li><a href="reset-password.html">
                                                Reset Password</a></li>
                                        <li><a href="maintenance.html">
                                                Maintenance</a></li>
                                    </ul>
                                </li>
                                <li><a class="submenu-title" href="javascript:void(0)">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Coming Soon
                                        <svg class="feather">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                        </svg></a>
                                    <ul class="according-submenu">
                                        <li><a href="comingsoon.html">
                                                Coming Simple</a></li>
                                        <li><a href="comingsoon-bg-video.html">
                                                Coming With Bg Video</a></li>
                                        <li><a href="comingsoon-bg-img.html">
                                                Coming With Bg Image</a></li>
                                    </ul>
                                </li>
                                <li><a class="submenu-title" href="javascript:void(0)">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Email Template
                                        <svg class="feather">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                        </svg></a>
                                    <ul class="according-submenu">
                                        <li><a href="basic-template.html">
                                                Basic Email</a></li>
                                        <li><a href="email-header.html">
                                                Basic With Header</a></li>
                                        <li><a href="template-email.html">
                                                Ecomerce Template</a></li>
                                        <li><a href="template-email-2.html">
                                                Email Template 2</a></li>
                                        <li><a href="ecommerce-templates.html">
                                                Ecommerce Email</a></li>
                                        <li><a href="email-order-success.html">
                                                Order Success </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="line"> </li>
                        <li class="sidebar-main-title">MISCELLANEOUS</li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Gallery"></use>
                                </svg><span>Gallery</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="gallery.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Gallery Grid</a></li>
                                <li><a href="gallery-with-description.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Gallery Grid Desc</a></li>
                                <li><a href="gallery-masonry.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Masonry Gallery</a></li>
                                <li><a href="masonry-gallery-with-disc.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Masonry With Desc</a></li>
                                <li><a href="gallery-hover.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Hover Effects</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Game"></use>
                                </svg><span>Blog</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="blog.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Blog Details</a></li>
                                <li><a href="blog-single.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Blog Single</a></li>
                                <li><a href="add-post.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Add Post</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="faq.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Danger"></use>
                                </svg><span>FAQ</span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Filter-2"></use>
                                </svg><span>Job Search</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="job-cards-view.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Cards View</a></li>
                                <li><a href="job-list-view.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>List View</a></li>
                                <li><a href="job-details.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Job Details</a></li>
                                <li><a href="job-apply.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Apply</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Work"></use>
                                </svg><span>Learning</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="learning-list-view.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Learning List</a></li>
                                <li><a href="learning-detailed.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Detailed Course</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="pinned-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                                </svg>
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Discovery"></use>
                                </svg><span>Maps</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li><a href="data-map.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Data Maps</a></li>
                                <li><a href="vector-map.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Vector Maps</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="javascript:void(0)">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Shield"></use>
                                </svg><span>Editors</span>
                                <svg class="feather">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#chevron-right"></use>
                                </svg></a>
                            <ul class="sidebar-submenu">
                                <li> <a href="quilleditor.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>Quilljs Editor</a></li>
                                <li><a href="ace-code-editor.html">
                                        <svg class="svg-menu">
                                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3"></use>
                                        </svg>ACE Code Editor</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="knowledgebase.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Setting"></use>
                                </svg><span>Knowledgebase</span></a>
                        </li>
                        <li class="sidebar-list">
                            <svg class="pinned-icon">
                                <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Pin"></use>
                            </svg><a class="sidebar-link" href="support-ticket.html">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Ticket"></use>
                                </svg><span>Support Ticket</span></a>
                        </li>
                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow">
                    <svg class="feather">
                        <use href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-right"></use>
                    </svg>
                </div>
            </aside>
            <!-- Page sidebar end-->
            <div class="page-body">



   @yield('content')






      </div>
    </main>
    <!-- jquery-->
    <script src="{{ asset('assets/js/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- bootstrap js-->
    <script src="{{ asset('assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/config.js')}}"></script>
    <!-- Sidebar js-->
    <script src="{{ asset('assets/js/sidebar.js')}}"></script>
    <!-- Apexchart js-->
    <script src="{{ asset('assets/js/vendors/apexcharts/dist/apexcharts.min.js')}}"></script>
    <!-- Datatable js-->
    <script src="{{ asset('assets/js/vendors/simple-datatables/dist/umd/simple-datatables.js')}}"></script>
    <!-- dashboard 2 js-->
    <script src="{{ asset('assets/js/dashboard/dashboard-2.js')}}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('assets/js/scrollbar/simplebar.js')}}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js')}}"></script>
    <!-- scrollable-->
    <script src="{{ asset('assets/js/vendors/swiper/swiper-bundle.min.js')}}"></script>
    <!-- customizer-->
    <script src="{{ asset('assets/js/theme-customizer/customizer.js')}}"></script>
    <!-- custom script -->
    <script src="{{ asset('assets/js/script.js')}}"></script>
</body>


</html>