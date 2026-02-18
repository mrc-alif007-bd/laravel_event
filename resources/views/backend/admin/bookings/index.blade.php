@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Bookings Management | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('') }}/dist/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{ url('') }}/dist/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
            type="text/css">
        <!-- Icons Css -->
        <link href="{{ url('') }}/dist/assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ url('') }}/dist/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

        <!-- DataTables -->
        <link href="{{ url('') }}/dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
            rel="stylesheet" type="text/css">
        <link href="{{ url('') }}/dist/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
            rel="stylesheet" type="text/css">
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
                            <h6 class="page-title">Bookings Management</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Bookings</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <button class="btn btn-success" onclick="exportBookings()">
                                    <i class="mdi mdi-download me-2"></i> Export
                                </button>
                                <button class="btn btn-info" onclick="refreshTable()">
                                    <i class="mdi mdi-refresh me-2"></i> Refresh
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Statistics Cards -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Total Bookings</p>
                                        <h4 class="mb-0">{{ $bookings->count() }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-ticket font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Confirmed</p>
                                        <h4 class="mb-0">{{ $bookings->where('status', 'confirmed')->count() }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-check-circle font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Pending</p>
                                        <h4 class="mb-0">{{ $bookings->where('status', 'pending')->count() }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-clock-outline font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Cancelled</p>
                                        <h4 class="mb-0">{{ $bookings->where('status', 'cancelled')->count() }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-danger">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-close-circle font-size-24"></i>
                                            </span>
                                        </div>
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
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h4 class="card-title">All Bookings</h4>
                                        <p class="card-title-desc">Manage all event bookings from this panel.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-end gap-2">
                                            <!-- Filter Dropdown -->
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-filter me-2"></i>Filter
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByStatus('all')">All Bookings</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByStatus('pending')">Pending</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByStatus('confirmed')">Confirmed</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByStatus('cancelled')">Cancelled</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table id="bookings-table" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Booking Code</th>
                                            <th>Customer</th>
                                            <th>Event</th>
                                            <th>Date</th>
                                            <th>Tickets</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                            <th>Payment</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $booking)
                                            <tr>
                                                <td>{{ $booking->id }}</td>
                                                <td>
                                                    <span class="badge bg-dark">{{ $booking->booking_code }}</span>
                                                </td>
                                                <td>
                                                    {{ $booking->user->name ?? 'N/A' }}<br>
                                                    <small class="text-muted">{{ $booking->user->email ?? '' }}</small>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.events.show', $booking->event_id) }}"
                                                        class="text-primary">
                                                        {{ Str::limit($booking->event->title ?? 'N/A', 30) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ date('d M Y', strtotime($booking->created_at)) }}<br>
                                                    <small
                                                        class="text-muted">{{ $booking->created_at->format('h:i A') }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $booking->number_of_tickets }}</span>
                                                </td>
                                                <td>
                                                    <strong>${{ number_format($booking->total_amount ?? 0, 2) }}</strong><br>
                                                    @if ($booking->discount_amount > 0)
                                                        <small class="text-success">-
                                                            ${{ number_format($booking->discount_amount, 2) }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @switch($booking->status)
                                                        @case('confirmed')
                                                            <span class="badge bg-success">Confirmed</span>
                                                        @break

                                                        @case('pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @break

                                                        @case('cancelled')
                                                            <span class="badge bg-danger">Cancelled</span>
                                                        @break

                                                        @default
                                                            <span class="badge bg-secondary">{{ $booking->status }}</span>
                                                    @endswitch
                                                </td>
                                                <td>
                                                    @if (isset($booking->payment_status))
                                                        @switch($booking->payment_status)
                                                            @case('paid')
                                                                <span class="badge bg-success">Paid</span>
                                                            @break

                                                            @case('pending')
                                                                <span class="badge bg-warning">Pending</span>
                                                            @break

                                                            @case('failed')
                                                                <span class="badge bg-danger">Failed</span>
                                                            @break

                                                            @default
                                                                <span
                                                                    class="badge bg-secondary">{{ $booking->payment_status }}</span>
                                                        @endswitch
                                                    @else
                                                        <span class="badge bg-secondary">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                                            class="btn btn-sm btn-info" title="View Booking">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.bookings.edit', $booking->id) }}"
                                                            class="btn btn-sm btn-warning" title="Edit Booking">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            title="Delete Booking"
                                                            onclick="deleteBooking({{ $booking->id }})">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <form id="delete-form-{{ $booking->id }}"
                                                        action="{{ route('admin.bookings.destroy', $booking->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
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
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this booking? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('') }}/dist/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/node-waves/waves.min.js"></script>

    <!-- DataTables -->
    <script src="{{ url('') }}/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/jszip/jszip.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>

    <script src="{{ url('') }}/dist/assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            window.dataTable = $('#bookings-table').DataTable({
                order: [
                    [0, 'desc']
                ],
                pageLength: 25,
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                dom: '<"row"<"col-md-6"B><"col-md-6"f>>rtip',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search bookings..."
                }
            });
        });

        let deleteId = null;

        function deleteBooking(id) {
            deleteId = id;
            $('#deleteModal').modal('show');
        }

        $('#confirmDelete').on('click', function() {
            if (deleteId) {
                document.getElementById('delete-form-' + deleteId).submit();
            }
        });

        function refreshTable() {
            window.location.reload();
        }

        function exportBookings() {
            window.location.href = "{{ route('admin.bookings.index') }}?export=true";
        }

        function filterByStatus(status) {
            if (status === 'all') {
                window.dataTable.column(7).search('').draw();
            } else {
                window.dataTable.column(7).search(status).draw();
            }
        }
    </script>
@endsection
