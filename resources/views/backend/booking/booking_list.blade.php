@extends('backend.layouts.master')

@section('head')
    <head>
        <meta charset="utf-8">
        <title>Booking List | Veltrix - Admin & Dashboard Template</title>
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
    </head>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">Booking Management</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bookings</li>
                            </ol>
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
                                    <h4 class="card-title">All Bookings</h4>
                                    <span class="badge bg-primary">{{ $bookings->count() }} Total</span>
                                </div>

                                <p class="card-title-desc mb-4">
                                    View all ticket bookings, payment details, and current booking status in one place.
                                </p>

                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Customer</th>
                                            <th>Event</th>
                                            <th>Tickets</th>
                                            <th>Total Amount</th>
                                            <th>Booking Status</th>
                                            <th>Payment Status</th>
                                            <th>Method</th>
                                            <th>Booked At</th>
                                            <th>Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bookings as $booking)
                                            <tr>
                                                <td>#{{ $booking->id }}</td>
                                                <td>
                                                    <strong>{{ $booking->name }}</strong><br>
                                                    <small class="text-muted">{{ $booking->email }}</small><br>
                                                    <small class="text-muted">{{ $booking->phone ?: 'N/A' }}</small>
                                                </td>
                                                <td>{{ $booking->event?->title ?? 'Deleted Event' }}</td>
                                                <td><span class="badge bg-info">{{ $booking->number_of_ticket }}</span></td>
                                                <td>${{ number_format((float) $booking->total_amount, 2) }}</td>
                                                <td>
                                                    @php $status = strtolower((string) $booking->status); @endphp
                                                    @if ($status === 'confirmed')
                                                        <span class="badge bg-success">Confirmed</span>
                                                    @elseif ($status === 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ ucfirst($booking->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php $paymentStatus = strtolower((string) $booking->payment_status); @endphp
                                                    @if ($paymentStatus === 'paid')
                                                        <span class="badge bg-success">Paid</span>
                                                    @elseif ($paymentStatus === 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ ucfirst($booking->payment_status) }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $booking->payment_method ?: 'N/A' }}</td>
                                                <td>{{ $booking->created_at?->format('M d, Y h:i A') }}</td>
                                                <td>
                                                    <a href="{{ route('invoice', $booking->id) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="mdi mdi-file-document-outline me-1"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="mdi mdi-information-outline display-4"></i>
                                                        <p class="mt-2">No bookings found.</p>
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
                    emptyTable: "No bookings available",
                    info: "Showing _START_ to _END_ of _TOTAL_ bookings",
                    infoEmpty: "Showing 0 to 0 of 0 bookings",
                    infoFiltered: "(filtered from _MAX_ total bookings)",
                    lengthMenu: "Show _MENU_ bookings",
                    search: "Search:",
                    zeroRecords: "No matching bookings found"
                },
                order: [
                    [0, 'desc']
                ],
                pageLength: 10,
                responsive: true,
                columnDefs: [{
                    orderable: false,
                    targets: [1, 9]
                }]
            });

            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
@endsection
