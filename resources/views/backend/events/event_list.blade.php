@extends ("backend.layouts.master")

@section("head")

<head>
    <meta charset="utf-8">
    <title>Events List | Veltrix</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('dist/assets/images/favicon.ico') }}">

    <!-- DataTables -->
    <link href="{{ url('dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ url('dist/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ url('dist/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="{{ url('dist/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('dist/assets/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ url('dist/assets/css/app.min.css') }}" rel="stylesheet">
</head>
@endsection

@section("content")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Events List</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Veltrix</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Events</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-cog me-2"></i> Settings
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">
                                Events List
                                <span class="float-end">
                                    <a href="{{ route('event.create') }}" class="btn btn-primary">Add New Event</a>
                                </span>
                            </h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Venue</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($events as $event)
                                    <tr>
                                        <td>{{ $event->id }}</td>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->venue ? $event->venue->name : 'N/A' }}</td>
                                        <td>
                                            {{ $event->category_id == 1 ? 'Paid' : 'Not Paid' }}
                                        </td>
                                        <td>{{ $event->price }}</td>
                                        <td>
                                            @if($event->status == 1)
                                            <span class="badge bg-info">Upcoming</span>
                                            @elseif($event->status == 2)
                                            <span class="badge bg-success">Completed</span>
                                            @else
                                            <span class="badge bg-danger">Canceled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{ asset($event->image) }}" width="60" class="img-thumbnail">
                                        </td>
                                        <td>
                                            <a href="{{ route('event.edit', $event->id) }}" class="badge bg-primary">Edit</a>
                                            <form action="{{ route('event.destroy', $event->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="badge bg-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- page-content -->
</div> <!-- main-content -->
@endsection

@section("scripts")
<script src="{{ url('dist/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/node-waves/waves.min.js') }}"></script>

<script src="{{ url('dist/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ url('dist/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('dist/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ url('dist/assets/js/pages/datatables.init.js') }}"></script>
<script src="{{ url('dist/assets/js/app.js') }}"></script>
@endsection