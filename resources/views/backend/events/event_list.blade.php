@extends('backend.layouts.master')

@section('head')
    <head>
        <meta charset="utf-8">
        <title>Events List | Veltrix</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">
        <link href="{{ asset('dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    </head>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">Events Management</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Events</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.event.create') }}" class="btn btn-primary">
                                    <i class="mdi mdi-plus me-2"></i> Add New Event
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">All Events</h4>

                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Venue</th>
                                            <th>Type</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($events as $event)
                                            <tr>
                                                <td>#{{ $event->id }}</td>
                                                <td>{{ $event->title }}</td>
                                                <td>{{ $event->venue?->name ?? 'N/A' }}</td>
                                                <td>{{ (int) $event->category_id === 1 ? 'Paid' : 'Not Paid' }}</td>
                                                <td>{{ $event->price }}</td>
                                                <td>
                                                    @if ((int) $event->status === 1)
                                                        <span class="badge bg-info">Upcoming</span>
                                                    @elseif ((int) $event->status === 2)
                                                        <span class="badge bg-success">Completed</span>
                                                    @else
                                                        <span class="badge bg-danger">Canceled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($event->image)
                                                        <img src="{{ asset($event->image) }}" width="55" class="img-thumbnail" alt="Event">
                                                    @else
                                                        <span class="text-muted">No image</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('admin.event.destroy', $event->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this event?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No events found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('dist/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>
@endsection
