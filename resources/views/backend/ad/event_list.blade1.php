@extends ("backend.layouts.master")


@section("head")

<head>

    <meta charset="utf-8">
    <title>Data tables | Veltrix - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('')}}/dist/assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="{{url('')}}/dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('')}}/dist/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">

    <!-- Responsive datatable examples -->
    <link href="{{url('')}}/dist/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Css -->
    <link href="{{url('')}}/dist/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{url('')}}/dist/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{url('')}}/dist/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

</head>
@endsection


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        @section("content")
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h6 class="page-title">Data tables</h6>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{url('')}}/dist/#">Veltrix</a></li>
                                    <li class="breadcrumb-item"><a href="{{url('')}}/dist/#">Tables</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data tables</li>
                                </ol>
                            </div>
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <div class="dropdown">
                                        <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-cog me-2"></i> Settings
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{url('')}}/dist/#">Action</a>
                                            <a class="dropdown-item" href="{{url('')}}/dist/#">Another action</a>
                                            <a class="dropdown-item" href="{{url('')}}/dist/#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{url('')}}/dist/#">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Buttons example</h4>
                                    <p class="card-title-desc">The Buttons extension for DataTables
                                        provides a common set of options, API methods and styling to display
                                        buttons on a page that will interact with a DataTable. The core library
                                        provides the based framework upon which plug-ins can built.
                                    </p>

                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                          
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script> Veltrix<span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span>
                        </div>
                    </div>
                </div>
            </footer>


        </div>
        @endsection
        <!-- end main content-->


    <!-- JAVASCRIPT -->
    @section("scripts")
    <script src="{{url('')}}/dist/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/node-waves/waves.min.js"></script>

    <!-- Required datatable js -->
    <script src="{{url('')}}/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="{{url('')}}/dist/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/jszip/jszip.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{url('')}}/dist/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="{{url('')}}/dist/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{url('')}}/dist/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="{{url('')}}/dist/assets/js/pages/datatables.init.js"></script>

    <script src="{{url('')}}/dist/assets/js/app.js"></script>
    @endsection

</body>

</html>