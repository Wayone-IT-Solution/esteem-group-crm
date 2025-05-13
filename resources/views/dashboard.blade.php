@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row page-title">
            <div class="col-sm-6">
                <h3>Ecommerce Dashboard</h3>
            </div>
            <div class="col-sm-6">
                <nav>
                    <ol class="breadcrumb justify-content-sm-end align-items-center">
                        <li class="breadcrumb-item"> <a href="index.html">
                                <svg class="svg-color">
                                    <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Ecommerce Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid ecommerce-dashboard">
        <div class="row">
            <div class="col-xl-9">
                <div class="row">
                    <!-- Order Delivery-->
                    <div class="col-md-4">
                        <div class="card progress-items">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex gap-2">
                                            <h5 class="f-18 font-light">Total Sale</h5>
                                            <div class="badge align-items-center d-flex badge-light-danger">
                                                <svg class="feather me-1 pt-0 stroke-danger">
                                                    <use
                                                        href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-up-right">
                                                    </use>
                                                </svg><span class="f-w-500">3.4%</span>
                                            </div>
                                        </div>
                                        <h3 class="f-26 f-w-600 mt-3">$ 12,463</h3>
                                    </div>
                                    <div class="flex-shrink-0 bg-light-primary">
                                        <svg class="svg-w-23 fill-primary">
                                            <use
                                                href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Product-discount">
                                            </use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body progress-card pt-0">
                                <div>
                                    <p class="f-w-500">20% since Last Month</p>
                                </div>
                                <div class="order-chart">
                                    <div class="chart" id="sale-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card progress-items">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex gap-2">
                                            <h5 class="f-18 font-light">New Orders</h5>
                                            <div class="badge align-items-center d-flex badge-light-success">
                                                <svg class="feather me-1 pt-0 stroke-success">
                                                    <use
                                                        href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-down-right">
                                                    </use>
                                                </svg><span class="f-w-500">4.5%</span>
                                            </div>
                                        </div>
                                        <h3 class="f-26 f-w-600 mt-3">$ 51,325</h3>
                                    </div>
                                    <div class="flex-shrink-0 bg-light-secondary">
                                        <svg class="svg-w-30 fill-secondary">
                                            <use
                                                href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#order-product">
                                            </use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body progress-card pt-0">
                                <div>
                                    <p class="f-w-500">14% since Last Month</p>
                                </div>
                                <div class="order-chart">
                                    <div class="chart" id="order-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card progress-items">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex gap-2">
                                            <h5 class="f-18 font-light">Order Delivery</h5>
                                            <div class="badge align-items-center d-flex badge-light-danger">
                                                <svg class="feather me-1 pt-0 stroke-danger">
                                                    <use
                                                        href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#arrow-up-right">
                                                    </use>
                                                </svg><span class="f-w-500">2.3%</span>
                                            </div>
                                        </div>
                                        <h3 class="f-26 f-w-600 mt-3">$ 32,587</h3>
                                    </div>
                                    <div class="flex-shrink-0 bg-light-tertiary">
                                        <svg class="svg-w-31 fill-tertiary">
                                            <use
                                                href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#delivery-van">
                                            </use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body progress-card pt-0">
                                <div>
                                    <p class="f-w-500">10% since Last Month</p>
                                </div>
                                <div class="order-chart">
                                    <div class="chart" id="delivery-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-7">
                        <!-- Invoice menu-->
                        <div class="card">
                            <div class="card-header pb-0">
                                <h4>Top Selling Products</h4>
                                <div class="dropdown icon-dropdown">
                                    <button class="btn dropdown-toggle" id="userdropdown08" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="icon-more-alt"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown08"><a
                                            class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                            href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body selling-table checkbox-checked">
                                <div class="table-responsive">
                                    <table class="table" id="sell-product">
                                        <thead>
                                            <tr>
                                                <th class="form-check">
                                                    <input class="form-check-input" type="checkbox">
                                                </th>
                                                <th>Product Name</th>
                                                <th>Order Id</th>
                                                <th>Email</th>
                                                <th>Stock</th>
                                                <th>Amount </th>
                                                <th>Payment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input class="form-check-input" type="checkbox">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="flex-shrink-0"><img class="img-30 b-r-10"
                                                                src="{{ asset('assets/images/dashboard2/order/watch.png') }}"
                                                                alt=""></div>
                                                        <div class="flex-grow-1"> <a href="product.html">
                                                                <h6 class="f-w-500">Mi Watch Revolve</h6><span
                                                                    class="font-light f-w-400 f-13">10 April 2024</span>
                                                            </a></div>
                                                    </div>
                                                </td>
                                                <td>#787669</td>
                                                <td><span class="font-light">Zahid@gmail.com</span></td>
                                                <td>2637</td>
                                                <td>$30.00</td>
                                                <td>
                                                    <button class="btn edge-btn f-13 w-100 btn-light-primary">Done</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input class="form-check-input" type="checkbox">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="flex-shrink-0"><img class="img-30 b-r-10"
                                                                src="{{ asset('assets/images/dashboard2/order/flower.png') }}"
                                                                alt=""></div>
                                                        <div class="flex-grow-1"> <a href="product.html">
                                                                <h6 class="f-w-500">Tree Stylish Pot</h6><span
                                                                    class="font-light f-w-400 f-13">16 June 2024</span>
                                                            </a></div>
                                                    </div>
                                                </td>
                                                <td>#749U8F</td>
                                                <td><span class="font-light">Anna12@gmail.com</span></td>
                                                <td>6237</td>
                                                <td>$20.00</td>
                                                <td>
                                                    <button
                                                        class="btn edge-btn f-13 w-100 btn-light-tertiary">Pending</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input class="form-check-input" type="checkbox">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="flex-shrink-0"><img class="img-30 b-r-10"
                                                                src="{{ asset('assets/images/dashboard2/order/bench.png') }}"
                                                                alt=""></div>
                                                        <div class="flex-grow-1"> <a href="product.html">
                                                                <h6 class="f-w-500">Wood Chair Dark</h6><span
                                                                    class="font-light f-w-400 f-13">23 May 2024</span>
                                                            </a></div>
                                                    </div>
                                                </td>
                                                <td>#509478</td>
                                                <td><span class="font-light">Laura@gmail.com</span></td>
                                                <td>3237</td>
                                                <td>$12.00</td>
                                                <td>
                                                    <button class="btn edge-btn f-13 w-100 btn-light-primary">Done</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input class="form-check-input" type="checkbox">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="flex-shrink-0"><img class="img-30 b-r-10"
                                                                src="{{ asset('assets/images/dashboard2/order/shoes.png') }}"
                                                                alt=""></div>
                                                        <div class="flex-grow-1"> <a href="product.html">
                                                                <h6 class="f-w-500">Sneakers For Men</h6><span
                                                                    class="font-light f-w-400 f-13">12 April 2024</span>
                                                            </a></div>
                                                    </div>
                                                </td>
                                                <td>#738445</td>
                                                <td><span class="font-light">Rache87@gmail.com</span></td>
                                                <td>3746</td>
                                                <td>$62.00</td>
                                                <td>
                                                    <button
                                                        class="btn edge-btn f-13 w-100 btn-light-tertiary">Pending</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-5">
                        <div class="card">
                            <div class="card-header">
                                <h4>Category Overview</h4>
                                <div class="dropdown icon-dropdown">
                                    <button class="btn dropdown-toggle" id="userdropdown03" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="icon-more-alt"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown03"><a
                                            class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                            href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body category">
                                <div class="row">
                                    <div class="col-xl-6 col-6">
                                        <ul>
                                            <li class="d-flex align-items-center bg-light card-hover">
                                                <div class="flex-shrink-0">
                                                    <div class="circle-dot-primary"> <span></span></div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="f-w-500">Men & Women Fashion</h6><span
                                                        class="f-13 font-light">13.5k Products Sold</span>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center bg-light card-hover">
                                                <div class="flex-shrink-0">
                                                    <div class="circle-dot-secondary"> <span></span></div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="f-w-500">Home Furniture</h6><span
                                                        class="f-13 font-light">10.3k Products Sold</span>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center bg-light card-hover">
                                                <div class="flex-shrink-0">
                                                    <div class="circle-dot-tertiary"> <span></span></div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="f-w-500">Mobiles & Computers</h6><span
                                                        class="f-13 font-light">22.4k Products Sold</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-xl-6 col-6">
                                        <div class="category-chart" id="category"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <!-- Invoice menu-->
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>Manage Order</h4>
                        <div class="dropdown icon-dropdown">
                            <button class="btn dropdown-toggle" id="userdropdown01" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown01"><a
                                    class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                    href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a></div>
                        </div>
                    </div>
                    <div class="card-body manage-order">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="flex-shrink-0"> <img class="img-fluid img-42 b-r-10"
                                                    src="{{ asset('assets/images/avatar/2.jpg') }}" alt=""></div>
                                            <div class="flex-grow-1"> <a href="user-profile.html">
                                                    <h6 class="f-w-500">Elle Amberson</h6><span
                                                        class="f-13">Elle34@gmail.com</span>
                                                </a></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-block text-end">
                                            <h6 class="f-w-500">$254.23</h6><span class="f-w-500">564 Sale</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="flex-shrink-0"> <img class="img-fluid img-42 b-r-10"
                                                    src="{{ asset('assets/images/avatar/5.jpg') }}" alt=""></div>
                                            <div class="flex-grow-1"> <a href="user-profile.html">
                                                    <h6 class="f-w-500">Anna Catmire</h6><span
                                                        class="f-13">anna12@gmail.com</span>
                                                </a></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-block text-end">
                                            <h6 class="f-w-500">$658.32</h6><span class="f-w-500">654 Sale</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="flex-shrink-0"> <img class="img-fluid img-42 b-r-10"
                                                    src="{{ asset('assets/images/avatar/9.jpg') }}" alt=""></div>
                                            <div class="flex-grow-1"> <a href="user-profile.html">
                                                    <h6 class="f-w-500">Laura Dagson</h6><span
                                                        class="f-13">laura@gmail.com</span>
                                                </a></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-block text-end">
                                            <h6 class="f-w-500">$352.95</h6><span class="f-w-500">347 Sale</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="flex-shrink-0"> <img class="img-fluid img-42 b-r-10"
                                                    src="{{ asset('assets/images/avatar/8.jpg') }}" alt=""></div>
                                            <div class="flex-grow-1"> <a href="user-profile.html">
                                                    <h6 class="f-w-500">Rachel Green</h6><span
                                                        class="f-13">Rache87@gmail.com</span>
                                                </a></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-block text-end">
                                            <h6 class="f-w-500">$852.65</h6><span class="f-w-500">254 Sale</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="flex-shrink-0"> <img class="img-fluid img-42 b-r-10"
                                                    src="{{ asset('assets/images/avatar/13.jpg') }}" alt=""></div>
                                            <div class="flex-grow-1"> <a href="user-profile.html">
                                                    <h6 class="f-w-500">Fran Loain</h6><span
                                                        class="f-13">fran34@gmail.com</span>
                                                </a></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-block text-end">
                                            <h6 class="f-w-500">$359.95</h6><span class="f-w-500">349 Sale</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="flex-shrink-0"> <img class="img-fluid img-42 b-r-10"
                                                    src="{{ asset('assets/images/avatar/7.jpg') }}" alt=""></div>
                                            <div class="flex-grow-1"> <a href="user-profile.html">
                                                    <h6 class="f-w-500">Loie Fenter</h6><span
                                                        class="f-13">loie234@gmail.com</span>
                                                </a></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-block text-end">
                                            <h6 class="f-w-500">$358.94</h6><span class="f-w-500">584 Sale</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card sales-summary">
                    <div class="card-header">
                        <h4>Sales Summary</h4>
                        <div class="dropdown icon-dropdown">
                            <button class="btn dropdown-toggle" id="userdropdown07" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown07"><a
                                    class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                    href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="current-sale-container order-container">
                            <div class="overview-wrapper" id="orderoverview"></div>
                            <div class="back-bar-container">
                                <div id="order-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card product-offer">
                    <div class="card-header">
                        <h4>Product Offer</h4>
                        <div class="dropdown icon-dropdown">
                            <button class="btn dropdown-toggle" id="userdropdown04" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown04"><a
                                    class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                    href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="item text-center"><img class="img-fluid"
                                            src="{{ asset('assets/images/dashboard2/headphone.png') }}"
                                            alt=""><img class="product-gif img-fluid"
                                            src="{{ asset('assets/images/gif/new.gif') }}" alt="">
                                        <div class="product-content">
                                            <h4><a class="f-18" href="product.html">Wireless Apple Airpods</a></h4>
                                            <h5 class="font-primary f-w-600 f-16 mt-1">$130.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="item text-center"><img class="img-fluid"
                                            src="{{ asset('assets/images/dashboard2/9.png') }}" alt=""><img
                                            class="product-gif img-fluid" src="{{ asset('assets/images/gif/new.gif') }}"
                                            alt="">
                                        <div class="product-content">
                                            <h4><a class="f-18" href="product.html">Wireless Apple Airpods</a></h4>
                                            <h5 class="font-primary f-w-600 f-16 mt-1">$130.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="item text-center"><img class="img-fluid"
                                            src="{{ asset('assets/images/dashboard2/7.png') }}" alt=""><img
                                            class="product-gif img-fluid" src="{{ asset('assets/images/gif/new.gif') }}"
                                            alt="">
                                        <div class="product-content">
                                            <h4><a class="f-18" href="product.html">Wireless Apple Airpods</a></h4>
                                            <h5 class="font-primary f-w-600 f-16 mt-1">$130.00</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination"> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <!-- Sale Progress menu-->
                <div class="card sale-progress">
                    <div class="card-header pb-0">
                        <h4>Sale Progress</h4>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="icon-more-alt"></i></li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                        <p class="desc mb-0 mt-1"><span></span><code></code><span></span></p>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li class="d-flex gap-3 bg-light-primary">
                                <div class="flex-shrink-0 border-primary"><img
                                        src="{{ asset('assets/images/dashboard2/product/1.png') }}" alt=""></div>
                                <div class="flex-grow-1">
                                    <h5>Mobiles , Computers</h5><span>50% Best Offer</span>
                                    <div class="progress progress-striped-primary">
                                        <div class="progress-bar" style="width: 55%" role="progressbar"
                                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div><span class="badge f-14 b-r-0 bg-light-primary">
                                    <svg class="svg-w-20 stroke-primary">
                                        <use
                                            href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3">
                                        </use>
                                    </svg><span class="f-w-500">4.5%</span></span>
                            </li>
                            <li class="d-flex gap-3 bg-light-secondary">
                                <div class="flex-shrink-0 border-secondary"><img
                                        src="{{ asset('assets/images/dashboard2/product/2.png') }}" alt=""></div>
                                <div class="flex-grow-1">
                                    <h5>Home , Kitchen</h5><span>Combo Offer</span>
                                    <div class="progress progress-striped-secondary">
                                        <div class="progress-bar" style="width: 55%" role="progressbar"
                                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div><span class="badge f-14 b-r-0 bg-light-secondary">
                                    <svg class="svg-w-20 stroke-secondary">
                                        <use
                                            href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3">
                                        </use>
                                    </svg><span class="f-w-500">2.4%</span></span>
                            </li>
                            <li class="d-flex gap-3 bg-light-tertiary">
                                <div class="flex-shrink-0 border-tertiary"><img
                                        src="{{ asset('assets/images/dashboard2/product/3.png') }}" alt=""></div>
                                <div class="flex-grow-1">
                                    <h5>Beauty , Health</h5><span>Weekend sale</span>
                                    <div class="progress progress-striped-tertiary">
                                        <div class="progress-bar" style="width: 55%" role="progressbar"
                                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div><span class="badge f-14 b-r-0 bg-light-tertiary">
                                    <svg class="svg-w-20 stroke-tertiary">
                                        <use
                                            href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#right-3">
                                        </use>
                                    </svg><span class="f-w-500">3.5%</span></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <!-- Seller card-->
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>Best Sellers</h4>
                        <div class="dropdown icon-dropdown">
                            <button class="btn dropdown-toggle" id="userdropdown02" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown02"><a
                                    class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                    href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a></div>
                        </div>
                    </div>
                    <div class="card-body pt-0 seller-table">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Price</th>
                                        <th>Product</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="flex-shrink-0"><img class="b-r-10"
                                                        src="{{ asset('assets/images/avatar/6.jpg') }}" alt="">
                                                </div>
                                                <div class="flex-grow-1"> <a href="user-profile.html">
                                                        <h6 class="f-w-500">John Keter</h6><span class="f-w-400 f-13">06
                                                            Aug 2024</span>
                                                    </a></div>
                                            </div>
                                        </td>
                                        <td>$76.00</td>
                                        <td>Brand Shoes</td>
                                        <td>$54,653</td>
                                        <td> <a class="btn edge-btn f-12 w-100 btn-light-primary">Sold</a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="flex-shrink-0"><img class="b-r-10"
                                                        src="{{ asset('assets/images/user/8.jpg') }}" alt="">
                                                </div>
                                                <div class="flex-grow-1"> <a href="user-profile.html">
                                                        <h6 class="f-w-500">Harry Venter</h6><span class="f-w-400 f-13">09
                                                            June 2024</span>
                                                    </a></div>
                                            </div>
                                        </td>
                                        <td>$65.00</td>
                                        <td>Headphone</td>
                                        <td>$65,412</td>
                                        <td> <a class="btn edge-btn f-12 w-100 btn-light-tertiary">Out of stock</a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="flex-shrink-0"><img class="b-r-10"
                                                        src="{{ asset('assets/images/user/15.jpg') }}" alt="">
                                                </div>
                                                <div class="flex-grow-1"> <a href="user-profile.html">
                                                        <h6 class="f-w-500">Loadin Deo</h6><span class="f-w-400 f-13">23
                                                            May 2024</span>
                                                    </a></div>
                                            </div>
                                        </td>
                                        <td>$95.00</td>
                                        <td>Cell Phone</td>
                                        <td>$32,012</td>
                                        <td> <a class="btn edge-btn f-12 w-100 btn-light-secondary">Sell</a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="flex-shrink-0"><img class="b-r-10"
                                                        src="{{ asset('assets/images/user/14.jpg') }}" alt="">
                                                </div>
                                                <div class="flex-grow-1"> <a href="user-profile.html">
                                                        <h6 class="f-w-500">Horen Hors</h6><span class="f-w-400 f-13">17
                                                            Jan 2024</span>
                                                    </a></div>
                                            </div>
                                        </td>
                                        <td>$34.00</td>
                                        <td>Fashion</td>
                                        <td>$75,152</td>
                                        <td> <a class="btn edge-btn f-12 w-100 btn-light-tertiary">Sold</a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="flex-shrink-0"><img class="b-r-10"
                                                        src="{{ asset('assets/images/avatar/9.jpg') }}" alt="">
                                                </div>
                                                <div class="flex-grow-1"> <a href="user-profile.html">
                                                        <h6 class="f-w-500">Fenter Jessy</h6><span class="f-w-400 f-13">04
                                                            Aug 2024</span>
                                                    </a></div>
                                            </div>
                                        </td>
                                        <td>$34.00</td>
                                        <td>Bookshop</td>
                                        <td>$12,152</td>
                                        <td> <a class="btn edge-btn f-12 w-100 btn-light-secondary">Sell</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body discount-product">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="discount-title">Add Product</h4>
                                <div class="main-box border-primary mx-auto">
                                    <svg class="svg-w-24 fill-primary">
                                        <use
                                            href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#shopping-bag">
                                        </use>
                                    </svg>
                                </div>
                                <hr>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="discount-content font-light f-w-500">Create a new Product</h4>
                                    <div class="bg-light-primary rounded">
                                        <svg class="feather">
                                            <use
                                                href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#plus">
                                            </use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <h4 class="discount-title">Add Discount</h4>
                                <div class="main-box border-secondary mx-auto">
                                    <svg class="svg-w-24 fill-secondary">
                                        <use
                                            href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#Product-discount">
                                        </use>
                                    </svg>
                                </div>
                                <hr>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="discount-content font-light f-w-500">Apply a new Discount</h4>
                                    <div class="bg-light-secondary rounded">
                                        <svg class="feather">
                                            <use
                                                href="https://admin.pixelstrap.net/edmin/assets/svg/feather-icons/dist/feather-sprite.svg#plus">
                                            </use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card track-order">
                        <div class="card-body">
                            <h4>Your order has already been sent.</h4>
                            <p class="font-light f-14">Use this tracking number to keep track of your order.</p>
                            <h5>5435987456325894</h5><a class="btn btn-primary" href="javascript:void(0)">Check Your Order
                                Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <!-- Invoice menu-->
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>Sales By Product</h4>
                        <div class="dropdown icon-dropdown">
                            <button class="btn dropdown-toggle" id="userdropdown06" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown06"><a
                                    class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                    href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a></div>
                        </div>
                    </div>
                    <div class="card-body sale-product pt-0">
                        <div class="row">
                            <div class="col-5">
                                <h5 class="f-w-500 mb-1 mt-2">Current YTD</h5>
                                <h6 class="font-light">Feb 2, 2024 to Jan 23,</h6>
                            </div>
                            <div class="col-7">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected="">Current YTD</option>
                                    <option value="1">Current MTD</option>
                                    <option value="2">YTD earning</option>
                                    <option value="3">YTD Net Pay</option>
                                    <option value="4">MTD Earning</option>
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>%Sold</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Rocks</td>
                                    <td>$5.874</td>
                                    <td>28.63%</td>
                                    <td>
                                        <div class="progress-showcase">
                                            <div class="progress sm-progress-bar progress-border-primary">
                                                <div class="progress-bar" role="progressbar" style="width: 50%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Trimming</td>
                                    <td>$2.256</td>
                                    <td>24.75%</td>
                                    <td>
                                        <div class="progress-showcase">
                                            <div class="progress sm-progress-bar progress-border-secondary">
                                                <div class="progress-bar" role="progressbar" style="width: 30%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Maintenance</td>
                                    <td>$1.954</td>
                                    <td>35.35%</td>
                                    <td>
                                        <div class="progress-showcase">
                                            <div class="progress sm-progress-bar progress-border-tertiary">
                                                <div class="progress-bar" role="progressbar" style="width: 80%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pest Control</td>
                                    <td>$4.158</td>
                                    <td>15.63%</td>
                                    <td>
                                        <div class="progress-showcase">
                                            <div class="progress sm-progress-bar progress-border-primary">
                                                <div class="progress-bar" role="progressbar" style="width: 40%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Installation</td>
                                    <td>$9.861</td>
                                    <td>95.98%</td>
                                    <td>
                                        <div class="progress-showcase">
                                            <div class="progress sm-progress-bar progress-border-secondary">
                                                <div class="progress-bar" role="progressbar" style="width: 60%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <th>Total</th>
                                    <th class="font-dark f-w-800">$9,978</th>
                                    <th> </th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid ends-->
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 footer-copyright">
                    <p class="mb-0">Copyright 2024 © Edmin Template by pixelstrap.</p>
                </div>
                <div class="col-md-6">
                    <p class="float-end mb-0">Hand crafted &amp; made with
                        <svg class="svg-color footer-icon">
                            <use href="https://admin.pixelstrap.net/edmin/assets/svg/iconly-sprite.svg#footer-heart"></use>
                        </svg>
                    </p>
                </div>
            </div>
        </div>
    </footer>
@endsection
