@extends ("backend.layouts.master")

@section("head")

<head>

    <meta charset="utf-8">
    <title>Form Elements | Veltrix - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('')}}/dist/assets/images/favicon.ico">

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
                        <h6 class="page-title">Event Edit Form </h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('')}}/#">Veltrix</a></li>
                            <li class="breadcrumb-item"><a href="{{url('')}}/#">Forms</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Elements</li>
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

                            <h4 class="card-title">Add Event</h4>
                            <p class="card-title-desc">DataTables has most features enabled by
                                default, so all you need to do to use it with your own tables is to call
                                the construction function: <code>$().DataTable();</code>.
                            </p>

                            <!-- ######Main Table ######## -->
                            <form action="{{route('category.store')}}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="c_name" value="{{old('e_name')}}" placeholder="Artisanal kale" id="example-text-input">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" type="text" name="description" value="{{old('description')}}" id="example-text-input" placeholder="Artisanal kale"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class=" form-control btn btn-success">Submit</button>
                            </form>

                            <!-- end row -->
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
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

@section("scripts")
<!-- JAVASCRIPT -->
<script src="{{url('')}}/dist/assets/libs/jquery/jquery.min.js"></script>
<script src="{{url('')}}/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{url('')}}/dist/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{url('')}}/dist/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{url('')}}/dist/assets/libs/node-waves/waves.min.js"></script>

<script src="{{url('')}}/dist/assets/js/app.js"></script>
@endsection