@extends ("backend.layouts.master")

@section("head")

<head>

    <meta charset="utf-8">
    <title>Data tables | Veltrix - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('')}}/assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="{{url('')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">

    <!-- Responsive datatable examples -->
    <link href="{{url('')}}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Css -->
    <link href="{{url('')}}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{url('')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{url('')}}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

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
                        <h6 class="page-title">Data tables</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('')}}/#">Veltrix</a></li>
                            <li class="breadcrumb-item"><a href="{{url('')}}/#">Tables</a></li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Default Datatable <span class="float-end"><a href="{{route('event.create')}}" class="btn btn-primary">Add New Events</a></span></h4>
                            <p class="card-title-desc">DataTables has most features enabled by
                                default, so all you need to do to use it with your own tables is to call
                                the construction function: <code>$().DataTable();</code>.
                            </p>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Id</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>


                                <tbody>
                                    
                                    @foreach($events as $event)
                                    <tr>
                                        <form action="{{route('event.destroy', $event->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <th scope="row">{{$event->id}}</th>
                                            <th >{{$event->category_id}}</th>
                                            <td>{{$event->name}}</td>
                                            <td>{{$event->description}}</td>
                                            <td>{{$event->price}}</td>
                                            <td>{{$event->image}}</td>
                                            <td>
                                                <!-- <i  class="fa fa-pencil-square"></i> -->
                                                <a href="{{route('event.edit', $event->id)}}" class="btn btn-primary">Edit</a>
                                                <!-- <i class="fa fa-trash-o"></i> -->
                                                <button class="btn btn-danger">Delete</button>
                                            </td>
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


</div>

@endsection

@section("scripts")

<!-- JAVASCRIPT -->
<script src="{{url('')}}/assets/libs/jquery/jquery.min.js"></script>
<script src="{{url('')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{url('')}}/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{url('')}}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{url('')}}/assets/libs/node-waves/waves.min.js"></script>

<!-- Required datatable js -->
<script src="{{url('')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{url('')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('')}}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{url('')}}/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="{{url('')}}/assets/libs/jszip/jszip.min.js"></script>
<script src="{{url('')}}/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="{{url('')}}/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="{{url('')}}/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{url('')}}/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{url('')}}/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="{{url('')}}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('')}}/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="{{url('')}}/assets/js/pages/datatables.init.js"></script>

<script src="{{url('')}}/assets/js/app.js"></script>

@endsection