@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Venue List | Veltrix - Admin & Dashboard Template</title>
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
                            <h6 class="page-title">Venue Management</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Venues</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.venue.create') }}" class="btn btn-primary">
                                    <i class="mdi mdi-plus me-2"></i> Add New Venue
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
                                    <h4 class="card-title">All Venues</h4>
                                    <div>
                                        <a href="{{ route('admin.venue.create') }}" class="btn btn-success">
                                            <i class="mdi mdi-plus-circle me-1"></i> Create New Venue
                                        </a>
                                    </div>
                                </div>

                                <p class="card-title-desc mb-4">
                                    Manage all your venues from this table. You can edit, view details, or delete any venue.
                                </p>

                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Venue Name</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Capacity</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($venues as $venue)
                                            <tr>
                                                <td>#{{ $venue->id }}</td>
                                                <td>
                                                    <strong>{{ $venue->name }}</strong>
                                                </td>
                                                <td>{{ $venue->address }}</td>
                                                <td>{{ $venue->city }}</td>
                                                <td>
                                                    <span class="badge bg-info">{{ number_format($venue->capacity) }}</span>
                                                </td>
                                                <td>
                                                    @if ($venue->description)
                                                        {{ Str::limit($venue->description, 50) }}
                                                    @else
                                                        <span class="text-muted">No description</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($venue->image)
                                                        <img src="{{ asset($venue->image) }}" width="55" class="img-thumbnail"
                                                            alt="{{ $venue->name }}" style="border-radius: 4px;">
                                                    @else
                                                        <span class="text-muted">
                                                            <i class="mdi mdi-image-off"></i> No image
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($venue->status === 'active')
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <!-- View Details Button -->
                                                        <button type="button" class="btn btn-sm btn-info"
                                                            onclick="viewVenue({{ $venue->id }})" data-bs-toggle="tooltip"
                                                            title="View Details">
                                                            <i class="mdi mdi-eye"></i>
                                                        </button>

                                                        <!-- Edit Button -->
                                                        <a href="{{ route('admin.venue.edit', $venue->id) }}"
                                                            class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                                            title="Edit Venue">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>

                                                        <!-- Toggle Status Button -->
                                                        <button type="button"
                                                            class="btn btn-sm {{ $venue->status === 'active' ? 'btn-warning' : 'btn-success' }}"
                                                            onclick="toggleStatus({{ $venue->id }}, '{{ $venue->name }}', '{{ $venue->status }}')"
                                                            data-bs-toggle="tooltip"
                                                            title="{{ $venue->status === 'active' ? 'Deactivate' : 'Activate' }} Venue">
                                                            <i
                                                                class="mdi mdi-{{ $venue->status === 'active' ? 'close-circle' : 'check-circle' }}"></i>
                                                        </button>

                                                        <!-- Delete Button -->
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $venue->id }}, '{{ $venue->name }}')"
                                                            data-bs-toggle="tooltip" title="Delete Venue">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Hidden Forms -->
                                                    <form id="delete-form-{{ $venue->id }}"
                                                        action="{{ route('admin.venue.destroy', $venue->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    <form id="status-form-{{ $venue->id }}"
                                                        action="{{ route('admin.venue.toggle-status', $venue->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PATCH')
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="mdi mdi-information-outline display-4"></i>
                                                        <p class="mt-2">No venues found. Click "Create New Venue" to add one.
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <!-- Pagination (if using pagination instead of DataTables) -->
                                @if (method_exists($venues, 'links'))
                                    <div class="mt-4">
                                        {{ $venues->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Venue Modal -->
    <div class="modal fade" id="viewVenueModal" tabindex="-1" aria-labelledby="viewVenueModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewVenueModalLabel">Venue Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="venueDetailsContent">
                    <!-- Content will be loaded dynamically -->
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" id="editVenueBtn" class="btn btn-primary">Edit Venue</a>
                </div>
            </div>
        </div>
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
        $(document).ready(function () {
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
                    emptyTable: "No venues available",
                    info: "Showing _START_ to _END_ of _TOTAL_ venues",
                    infoEmpty: "Showing 0 to 0 of 0 venues",
                    infoFiltered: "(filtered from _MAX_ total venues)",
                    lengthMenu: "Show _MENU_ venues",
                    search: "Search:",
                    zeroRecords: "No matching venues found"
                },
                order: [
                    [0, 'desc']
                ],
                pageLength: 10,
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [5, 6, 8] }
                ]
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // View Venue Details
        function viewVenue(id) {
            $('#viewVenueModal').modal('show');

            // AJAX request to fetch venue details
            $.ajax({
                url: '/admin/venue/' + id,
                type: 'GET',
                success: function (response) {
                    var venue = response.venue;
                    var content = `
                            <div class="row">
                                <div class="col-md-4 text-center mb-3">
                                    ${venue.image ?
                            `<img src="{{ asset('') }}${venue.image}" alt="${venue.name}" class="img-fluid rounded" style="max-height: 200px;">` :
                            `<div class="border rounded p-5 bg-light"><i class="mdi mdi-image-off display-1 text-muted"></i></div>`
                        }
                                </div>
                                <div class="col-md-8">
                                    <h4 class="mb-3">${venue.name}</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 30%">ID</th>
                                            <td>#${venue.id}</td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>${venue.address}</td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <td>${venue.city}</td>
                                        </tr>
                                        <tr>
                                            <th>Capacity</th>
                                            <td><span class="badge bg-info">${venue.capacity.toLocaleString()}</span></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>${venue.status === 'active' ?
                            '<span class="badge bg-success">Active</span>' :
                            '<span class="badge bg-danger">Inactive</span>'}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>${new Date(venue.created_at).toLocaleDateString()} at ${new Date(venue.created_at).toLocaleTimeString()}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>${new Date(venue.updated_at).toLocaleDateString()} at ${new Date(venue.updated_at).toLocaleTimeString()}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h5>Description</h5>
                                    <p class="border p-3 rounded bg-light">${venue.description || 'No description provided.'}</p>
                                </div>
                            </div>
                        `;

                    $('#venueDetailsContent').html(content);
                    $('#editVenueBtn').attr('href', '/admin/venue/' + venue.id + '/edit');
                },
                error: function () {
                    $('#venueDetailsContent').html('<div class="alert alert-danger">Failed to load venue details.</div>');
                }
            });
        }

        // Toggle Status function
        function toggleStatus(id, name, currentStatus) {
            const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
            const action = newStatus === 'active' ? 'activate' : 'deactivate';

            Swal.fire({
                title: 'Confirm Status Change',
                text: `Are you sure you want to ${action} "${name}"?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: newStatus === 'active' ? '#28a745' : '#ffc107',
                cancelButtonColor: '#6c757d',
                confirmButtonText: `Yes, ${action} it!`,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('status-form-' + id).submit();
                }
            });
        }

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
        $(document).ready(function () {
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 5000);
        });

        // Bulk Actions
        function bulkAction(action) {
            var selectedIds = [];
            $('.select-row:checked').each(function () {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Selection',
                    text: 'Please select at least one venue to perform this action.'
                });
                return;
            }

            var actionText = action === 'activate' ? 'activate' : 'deactivate';
            var actionColor = action === 'activate' ? '#28a745' : '#ffc107';

            Swal.fire({
                title: `Confirm Bulk ${actionText}`,
                text: `Are you sure you want to ${actionText} ${selectedIds.length} selected venue(s)?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: actionColor,
                cancelButtonColor: '#6c757d',
                confirmButtonText: `Yes, ${actionText} them!`
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit bulk action form
                    $('#bulk-ids').val(selectedIds.join(','));
                    $('#bulk-action').val(action);
                    $('#bulk-action-form').submit();
                }
            });
        }
    </script>
@endsection