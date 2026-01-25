@extends ("backend.layouts.master")

@section("head")

<head>

    <meta charset="utf-8">
    <title>Form Elements | Veltrix - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('')}}/assets/images/favicon.ico">

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
                        <h6 class="page-title">Event Add Form </h6>
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

                            <h4 class="card-title">Edit Event</h4>
                            <p class="card-title-desc">DataTables has most features enabled by
                                default, so all you need to do to use it with your own tables is to call
                                the construction function: <code>$().DataTable();</code>.
                            </p>

                            <!-- ######Main Table ######## -->
                            <form action="{{route('event.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category ID</label>
                                    <div class="col-sm-10">
                                        <select name="category" class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Event Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="e_name" placeholder="Artisanal kale" id="example-text-input">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" type="text" name="description" id="example-text-input" placeholder="Artisanal kale"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="price" placeholder="Artisanal kale" id="example-text-input">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="image" placeholder="Artisanal kale" id="example-text-input">
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



    

</div>
@endsection

@section("scripts")
<!-- JAVASCRIPT -->
<script src="{{url('')}}/assets/libs/jquery/jquery.min.js"></script>
<script src="{{url('')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{url('')}}/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{url('')}}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{url('')}}/assets/libs/node-waves/waves.min.js"></script>

<script src="{{url('')}}/assets/js/app.js"></script>
@endsection