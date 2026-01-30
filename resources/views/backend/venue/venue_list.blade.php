@extends("backend.layouts.master")

@section("head")
<head>
    <meta charset="utf-8">
    <title>Venue List | Veltrix - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ url('assets/images/favicon.ico') }}">

    <!-- DataTables CSS -->
    <link href="{{ url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet">
</head>
@endsection

@section("content")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Venue List</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('#') }}">Veltrix</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('#') }}">Tables</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Venue List</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-cog me-2"></i> Settings
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ url('#') }}">Action</a>
                                    <a class="dropdown-item" href="{{ url('#') }}">Another action</a>
                                    <a class="dropdown-item" href="{{ url('#') }}">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('#') }}">Separated link</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Venue Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">
                                Venue List
                                <span class="float-end">
                                    <a href="{{ route('venue.create') }}" class="btn btn-primary">Add New Venue</a>
                                </span>
                            </h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Capacity</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($venues as $venue)
                                    <tr>
                                        <td>{{ $venue->id }}</td>
                                        <td>{{ $venue->name }}</td>
                                        <td>{{ $venue->address }}</td>
                                        <td>{{ ucfirst($venue->city) }}</td>
                                        <td>{{ $venue->capacity }}</td>
                                        <td>{{ Str::limit($venue->description, 40) }}</td>
                                        <td>
                                            @if($venue->image)
                                                <img src="{{ asset($venue->image) }}" width="60" class="rounded">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($venue->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('venue.edit', $venue->id) }}" class="badge bg-primary">Edit</a>
                                            <form action="{{ route('venue.destroy', $venue->id) }}" method="POST" style="display:inline;">
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
<script src="{{ url('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>

<script src="{{ url('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Init DataTables (like event list page) -->
<script src="{{ url('assets/js/pages/datatables.init.js') }}"></script>

<script src="{{ url('assets/js/app.js') }}"></script>
@endsection
