    @extends ("backend.layouts.master")

    @section("head")

    <head>
        <meta charset="utf-8" />
        <title>Dashboard | Velonic - Bootstrap 5 Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
        <meta content="Techzaa" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">

        <!-- Daterangepicker css -->
        <link rel="stylesheet" href="{{ asset('dist/assets/vendor/daterangepicker/daterangepicker.css') }}">

        <!-- Vector Map css -->
        <link rel="stylesheet"
            href="{{ asset('dist/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}">

        <!-- Theme Config Js -->
        <script src="dist/assets/js/config.js"></script>

        <!-- App css -->
        <link rel="stylesheet" type="text/css" id="app-style" href="{{ asset('dist/assets/css/app.min.css') }}" />

        <!-- Icons css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/assets/css/icons.min.css') }}" />
    </head>

    @endsection


    @section("content")

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Velonic</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Welcome!</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Welcome!</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card widget-flat text-bg-pink">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="ri-eye-line widget-icon"></i>
                                </div>
                                <h6 class="text-uppercase mt-0" title="Customers">Daily Visits</h6>
                                <h2 class="my-2">8,652</h2>
                                <p class="mb-0">
                                    <span class="badge bg-white bg-opacity-10 me-1">2.97%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-xxl-3 col-sm-6">
                        <div class="card widget-flat text-bg-purple">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="ri-wallet-2-line widget-icon"></i>
                                </div>
                                <h6 class="text-uppercase mt-0" title="Customers">Revenue</h6>
                                <h2 class="my-2">$9,254.62</h2>
                                <p class="mb-0">
                                    <span class="badge bg-white bg-opacity-10 me-1">18.25%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-xxl-3 col-sm-6">
                        <div class="card widget-flat text-bg-info">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="ri-shopping-basket-line widget-icon"></i>
                                </div>
                                <h6 class="text-uppercase mt-0" title="Customers">Orders</h6>
                                <h2 class="my-2">753</h2>
                                <p class="mb-0">
                                    <span class="badge bg-white bg-opacity-25 me-1">-5.75%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-xxl-3 col-sm-6">
                        <div class="card widget-flat text-bg-primary">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="ri-group-2-line widget-icon"></i>
                                </div>
                                <h6 class="text-uppercase mt-0" title="Customers">Users</h6>
                                <h2 class="my-2">63,154</h2>
                                <p class="mb-0">
                                    <span class="badge bg-white bg-opacity-10 me-1">8.21%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div> <!-- end col-->
                </div>

                
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-12">
                        <!-- Todo-->
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="p-3">
                                    <div class="card-widgets">
                                        <a href="javascript:;" data-bs-toggle="reload"><i
                                                class="ri-refresh-line"></i></a>
                                        <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button"
                                            aria-expanded="false" aria-controls="yearly-sales-collapse"><i
                                                class="ri-subtract-line"></i></a>
                                        <a href="#" data-bs-toggle="remove"><i
                                                class="ri-close-line"></i></a>
                                    </div>
                                    <h5 class="header-title mb-0">Projects</h5>
                                </div>

                                <div id="yearly-sales-collapse" class="collapse show">

                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Project Name</th>
                                                    <th>Start Date</th>
                                                    <th>Due Date</th>
                                                    <th>Status</th>
                                                    <th>Assign</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Velonic Admin v1</td>
                                                    <td>01/01/2015</td>
                                                    <td>26/04/2015</td>
                                                    <td><span
                                                            class="badge bg-info-subtle text-info">Released</span>
                                                    </td>
                                                    <td>Techzaa Studio</td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Velonic Admin v1.3</td>
                                                    <td>01/01/2015</td>
                                                    <td>31/05/2015</td>
                                                    <td><span
                                                            class="badge bg-danger-subtle text-danger">Cool</span>
                                                    </td>
                                                    <td>Techzaa Studio</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div>
                     <!-- end col-->
                </div>
                <!-- end row -->

            </div>
            <!-- container -->

        </div>
        <!-- content -->

        <!-- Footer Start -->
        @include("backend.layouts.footer")
        <!-- end Footer -->

    </div>

    @endsection

    @section("scripts")
    <!-- Vendor js -->
    <script src="{{ url('') }}/dist/assets/js/vendor.min.js"></script>

    <!-- Daterangepicker js -->
    <script src="{{ url('') }}/dist/assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ url('') }}/dist/assets/vendor/daterangepicker/daterangepicker.js"></script>

    <!-- Apex Charts js -->
    <script src="{{ url('') }}/dist/assets/vendor/apexcharts/apexcharts.min.js"></script>

    <!-- Vector Map js -->
    <script src="{{ url('') }}/dist/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js">
    </script>
    <script
        src="{{ url('') }}/dist/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js">
    </script>

    <!-- Dashboard App js -->
    <script src="{{ url('') }}/dist/assets/js/pages/dashboard.js"></script>


    <!-- App js -->
    <script src="{{ url('') }}/dist/assets/js/app.min.js"></script>
    @endsection