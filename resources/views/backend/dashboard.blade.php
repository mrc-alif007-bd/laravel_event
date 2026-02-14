    @extends ("backend.layouts.master")

    @section("head")

    <head>

        <meta charset="utf-8">
        <title>Dashboard | Veltrix - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{url('')}}/dist/assets/images/favicon.ico">

        <link href="{{url('')}}/dist/assets/libs/chartist/chartist.min.css" rel="stylesheet">

        <!-- Bootstrap Css -->
        <link href="{{url('')}}/dist/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{url('')}}/dist/assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{url('')}}/dist/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

    </head>


    @endsection


    @section("content")

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">User Dashboard</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Welcome to User Dashboard</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <div class="dropdown">
                                    <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-cog me-2"></i> Settings
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{url('')}}/#">Action</a>
                                        <a class="dropdown-item" href="{{url('')}}/#">Another action</a>
                                        <a class="dropdown-item" href="{{url('')}}/#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{url('')}}/#">Separated link</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-start mini-stat-img me-4">
                                        <img src="{{url('')}}/dist/assets/images/services-icon/01.png" alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase text-white-50">Orders</h5>
                                    <h4 class="fw-medium font-size-24">1,685 <i
                                            class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                    <div class="mini-stat-label bg-success">
                                        <p class="mb-0">+ 12%</p>
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <div class="float-end">
                                        <a href="{{url('')}}/#" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                                    </div>

                                    <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-start mini-stat-img me-4">
                                        <img src="{{url('')}}/dist/assets/images/services-icon/02.png" alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase text-white-50">Revenue</h5>
                                    <h4 class="fw-medium font-size-24">52,368 <i
                                            class="mdi mdi-arrow-down text-danger ms-2"></i></h4>
                                    <div class="mini-stat-label bg-danger">
                                        <p class="mb-0">- 28%</p>
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <div class="float-end">
                                        <a href="{{url('')}}/#" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                                    </div>

                                    <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-start mini-stat-img me-4">
                                        <img src="{{url('')}}/dist/assets/images/services-icon/03.png" alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase text-white-50">Average Price</h5>
                                    <h4 class="fw-medium font-size-24">15.8 <i
                                            class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                    <div class="mini-stat-label bg-info">
                                        <p class="mb-0"> 00%</p>
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <div class="float-end">
                                        <a href="{{url('')}}/#" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                                    </div>

                                    <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-start mini-stat-img me-4">
                                        <img src="{{url('')}}/dist/assets/images/services-icon/04.png" alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase text-white-50">Product Sold</h5>
                                    <h4 class="fw-medium font-size-24">2436 <i
                                            class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                    <div class="mini-stat-label bg-warning">
                                        <p class="mb-0">+ 84%</p>
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <div class="float-end">
                                        <a href="{{url('')}}/#" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                                    </div>

                                    <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Latest Transaction</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">(#) Id</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col" colspan="2">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">#14256</th>
                                                <td>
                                                    <div>
                                                        <img src="{{url('')}}/dist/assets/images/users/user-2.jpg" alt=""
                                                            class="avatar-xs rounded-circle me-2"> Philip Smead
                                                    </div>
                                                </td>
                                                <td>15/1/2018</td>
                                                <td>$94</td>
                                                <td><span class="badge bg-success">Delivered</span></td>
                                                <td>
                                                    <div>
                                                        <a href="{{url('')}}/#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">#14261</th>
                                                <td>
                                                    <div>
                                                        <img src="{{url('')}}/dist/assets/images/users/user-2.jpg" alt=""
                                                            class="avatar-xs rounded-circle me-2"> Philip Smead
                                                    </div>
                                                </td>
                                                <td>15/1/2018</td>
                                                <td>$94</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>
                                                    <div>
                                                        <a href="{{url('')}}/#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->



            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->




    </div>

    @endsection

    @section("scripts")
    <script src="{{url('')}}/dist/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/node-waves/waves.min.js"></script>


    <!-- Peity chart-->
    <script src="{{url('')}}/dist/assets/libs/peity/jquery.peity.min.js"></script>

    <!-- Plugin Js-->
    <script src="{{url('')}}/dist/assets/libs/chartist/chartist.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js"></script>

    <script src="{{url('')}}/dist/assets/js/pages/dashboard.init.js"></script>

    <script src="{{url('')}}/dist/assets/js/app.js"></script>
    @endsection