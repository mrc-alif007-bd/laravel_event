@extends('backend.layouts.master')

@section('head')
    <head>
        <meta charset="utf-8">
        <title>Event List | Veltrix - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">

        <link href="{{ asset('dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css">
        <link href="{{ asset('dist/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
            rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
            rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    </head>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">Event Management</h6>
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
                        <i class="mdi mdi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title">All Events</h4>
                                    <a href="{{ route('admin.event.create') }}" class="btn btn-success">
                                        <i class="mdi mdi-plus-circle me-1"></i> Create New Event
                                    </a>
                                </div>

                                <p class="card-title-desc mb-4">
                                    Manage all your events from this table. You can edit or delete events at any time.
                                </p>

                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Event Name</th>
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
                                                <td><strong>{{ $event->title }}</strong></td>
                                                <td>{{ $event->venue?->name ?? 'N/A' }}</td>
                                                <td>
                                                    @if ((int) $event->category_id === 1)
                                                        <span class="badge bg-success">Paid</span>
                                                    @else
                                                        <span class="badge bg-secondary">Not Paid</span>
                                                    @endif
                                                </td>
                                                <td>${{ number_format((float) $event->price, 2) }}</td>
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
                                                        <img src="{{ asset($event->image) }}" width="55" class="img-thumbnail"
                                                            alt="{{ $event->title }}" style="border-radius: 4px;">
                                                    @else
                                                        <span class="text-muted">
                                                            <i class="mdi mdi-image-off"></i> No image
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.event.edit', $event->id) }}"
                                                            class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                                            title="Edit Event">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $event->id }}, '{{ addslashes($event->title) }}')"
                                                            data-bs-toggle="tooltip" title="Delete Event">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>

                                                    <form id="delete-form-{{ $event->id }}"
                                                        action="{{ route('admin.event.destroy', $event->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="mdi mdi-information-outline display-4"></i>
                                                        <p class="mt-2">No events found. Click "Create New Event" to add one.
                                                        </p>
                                                    </div>
                                                </td>
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
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable-buttons').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        text: '<i class="mdi mdi-content-copy"></i> Copy',
                        className: 'btn btn-sm btn-primary'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="mdi mdi-file-excel"></i> Excel',
                        className: 'btn btn-sm btn-success'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="mdi mdi-file-pdf"></i> PDF',
                        className: 'btn btn-sm btn-danger'
                    },
                    {
                        extend: 'print',
                        text: '<i class="mdi mdi-printer"></i> Print',
                        className: 'btn btn-sm btn-info'
                    }
                ],
                language: {
                    emptyTable: "No events available",
                    info: "Showing _START_ to _END_ of _TOTAL_ events",
                    infoEmpty: "Showing 0 to 0 of 0 events",
                    infoFiltered: "(filtered from _MAX_ total events)",
                    lengthMenu: "Show _MENU_ events",
                    search: "Search:",
                    zeroRecords: "No matching events found"
                },
                order: [
                    [0, 'desc']
                ],
                pageLength: 10,
                responsive: true,
                columnDefs: [{
                    orderable: false,
                    targets: [6, 7]
                }]
            });

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });

        function confirmDelete(id, title) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete "${title}". This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
