@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Event Types | Veltrix - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">

        <!-- DataTables -->
        <link href="{{ asset('dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css">
        <link href="{{ asset('dist/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
            rel="stylesheet" type="text/css">

        <!-- Responsive datatable examples -->
        <link href="{{ asset('dist/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
            rel="stylesheet" type="text/css">

        <!-- Bootstrap Css -->
        <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('dist/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

        <!-- SweetAlert CSS -->
        <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    </head>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">Event Types Management</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Event Types</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                                    <i class="mdi mdi-plus me-2"></i> Add New Event Type
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

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
                                    <h4 class="card-title">All Event Types</h4>
                                    <div>
                                        <a href="{{ route('admin.category.create') }}" class="btn btn-success">
                                            <i class="mdi mdi-plus-circle me-1"></i> Create New Event Type
                                        </a>
                                    </div>
                                </div>

                                <p class="card-title-desc mb-4">
                                    Manage all your event types from this table. You can edit, view details, or delete any
                                    event type.
                                </p>

                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Event Type Name</th>
                                            <th>Description</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($cats as $cat)
                                            <tr>
                                                <td>#{{ $cat->id }}</td>
                                                <td>
                                                    <strong>{{ $cat->name }}</strong>
                                                </td>
                                                <td>
                                                    @if ($cat->description)
                                                        {{ Str::limit($cat->description, 50) }}
                                                    @else
                                                        <span class="text-muted">No description</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $cat->created_at ? $cat->created_at->format('d M Y') : 'N/A' }}
                                                    <br>
                                                    <small
                                                        class="text-muted">{{ $cat->created_at ? $cat->created_at->diffForHumans() : '' }}</small>
                                                </td>
                                                <td>
                                                    @if ($cat->status ?? true)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.category.edit', $cat->id) }}"
                                                            class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                                            title="Edit Event Type">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $cat->id }}, '{{ $cat->name }}')"
                                                            data-bs-toggle="tooltip" title="Delete Event Type">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Delete Form (Hidden) -->
                                                    <form id="delete-form-{{ $cat->id }}"
                                                        action="{{ route('admin.category.destroy', $cat->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="mdi mdi-information-outline display-4"></i>
                                                        <p class="mt-2">No event types found. Click "Create New Event
                                                            Type" to add one.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <!-- Pagination (if using pagination instead of DataTables) -->
                                @if (method_exists($cats, 'links'))
                                    <div class="mt-4">
                                        {{ $cats->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <span class="text-muted">
                            &copy; {{ date('Y') }} Veltrix - Crafted with <i class="mdi mdi-heart text-danger"></i> by
                            Themesbrand
                        </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

@section('scripts')
    <!-- JAVASCRIPT -->
    <script src="{{ asset('dist/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('dist/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Buttons examples -->
    <script src="{{ asset('dist/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('dist/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- SweetAlert -->
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- App JS -->
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>

    <!-- Custom Scripts -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable with buttons
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
                    emptyTable: "No event types available",
                    info: "Showing _START_ to _END_ of _TOTAL_ event types",
                    infoEmpty: "Showing 0 to 0 of 0 event types",
                    infoFiltered: "(filtered from _MAX_ total event types)",
                    lengthMenu: "Show _MENU_ event types",
                    search: "Search:",
                    zeroRecords: "No matching event types found"
                },
                order: [
                    [0, 'desc']
                ], // Sort by ID descending by default
                pageLength: 10,
                responsive: true
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // Delete confirmation using SweetAlert
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete "${name}". This action cannot be undone!`,
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

        // Auto-hide alerts after 5 seconds
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
@endsection
