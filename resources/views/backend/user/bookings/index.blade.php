@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>My Bookings | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">

        <!-- DataTables -->
        <link href="{{ asset('dist/assets/libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css">
        <link href="{{ asset('dist/assets/libs/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css">

        <!-- Bootstrap Css -->
        <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('dist/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
    </head>
@endsection

@section('content')
    <div class="main-content" style="color: black ">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">My Bookings</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">My Bookings</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('user.events.index') }}" class="btn btn-primary">
                                    <i class="mdi mdi-plus-circle me-2"></i> Book New Event
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Booking History</h4>

                                <table id="bookings-table" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Booking Code</th>
                                            <th>Event</th>
                                            <th>Date</th>
                                            <th>Tickets</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                            <th>Payment Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($bookings as $booking)
                                            <tr>
                                                <td>
                                                    <span class="fw-bold">#{{ $booking->booking_code ?? 'N/A' }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                    <i class="mdi mdi-calendar"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-0">{{ $booking->event->name ?? 'N/A' }}</h6>
                                                            <p class="text-muted mb-0">
                                                                @if ($booking->event && $booking->event->venue)
                                                                    @php
                                                                        $venue = $booking->event->venue;
                                                                        // Check if venue is a string, object, or array
                                                                        if (is_string($venue)) {
                                                                            // Try to decode if it's JSON
    $decodedVenue = json_decode($venue, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        echo $decodedVenue['name'] ??
            ($decodedVenue['city'] ?? $venue);
    } else {
        echo $venue;
    }
} elseif (is_object($venue)) {
    echo $venue->name ??
        ($venue->city ??
            'Venue #' . $venue->id);
} elseif (is_array($venue)) {
    echo $venue['name'] ??
        ($venue['city'] ?? 'Venue information');
} else {
    echo 'Venue information';
                                                                        }
                                                                    @endphp
                                                                @else
                                                                    No venue specified
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="color: black ">
                                                    {{ $booking->event && $booking->event->start_date ? \Carbon\Carbon::parse($booking->event->start_date)->format('M d, Y') : 'N/A' }}
                                                    <br>
                                                    <small class="text-muted"
                                                        style="color: black ">{{ $booking->created_at->format('h:i A') }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-soft-primary"
                                                        style="color: black ">{{ $booking->number_of_tickets }}</span>
                                                </td>
                                                <td>
                                                    <span class="fw-bold"
                                                        style="color: black ">${{ number_format($booking->final_amount ?? $booking->total_amount, 2) }}</span>
                                                </td>
                                                <td>
                                                    @php
                                                        $statusClasses = [
                                                            'pending' => 'badge-soft-warning',
                                                            'confirmed' => 'badge-soft-success',
                                                            'cancelled' => 'badge-soft-danger',
                                                            'completed' => 'badge-soft-info',
                                                            'refunded' => 'badge-soft-secondary',
                                                        ];
                                                        $statusClass =
                                                            $statusClasses[$booking->status] ?? 'badge-soft-secondary';
                                                    @endphp
                                                    <span style="color: black "
                                                        class="badge {{ $statusClass }}">{{ ucfirst($booking->status) }}</span>
                                                </td>
                                                <td>
                                                    @php
                                                        $paymentStatus =
                                                            $booking->payments && $booking->payments->first()
                                                                ? $booking->payments->first()->status
                                                                : 'pending';
                                                        $paymentClasses = [
                                                            'paid' => 'badge-soft-success',
                                                            'pending' => 'badge-soft-warning',
                                                            'failed' => 'badge-soft-danger',
                                                            'refunded' => 'badge-soft-secondary',
                                                        ];
                                                        $paymentClass =
                                                            $paymentClasses[$paymentStatus] ?? 'badge-soft-secondary';
                                                    @endphp
                                                    <span style="color: black "
                                                        class="badge {{ $paymentClass }}">{{ ucfirst($paymentStatus) }}</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('user.bookings.show', $booking->id) }}"
                                                            class="btn btn-sm btn-info waves-effect waves-light"
                                                            data-bs-toggle="tooltip" title="View Details">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        @if ($booking->status == 'pending')
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger waves-effect waves-light"
                                                                onclick="cancelBooking({{ $booking->id }})"
                                                                data-bs-toggle="tooltip" title="Cancel Booking">
                                                                <i class="mdi mdi-close"></i>
                                                            </button>
                                                        @endif
                                                        @if ($booking->payments && $booking->payments->isEmpty() && $booking->status != 'cancelled')
                                                            <a href="{{ route('user.payments.create', ['booking_id' => $booking->id]) }}"
                                                                class="btn btn-sm btn-success waves-effect waves-light"
                                                                data-bs-toggle="tooltip" title="Make Payment">
                                                                <i class="mdi mdi-credit-card"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    <div class="py-5">
                                                        <i class="mdi mdi-ticket-outline"
                                                            style="font-size: 48px; color: #ccc;"></i>
                                                        <h5 class="mt-3">No Bookings Found</h5>
                                                        <p class="text-muted">You haven't made any bookings yet.</p>
                                                        <a href="{{ route('user.events.index') }}"
                                                            class="btn btn-primary mt-2">
                                                            Browse Events
                                                        </a>
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
                <!-- end row -->

                <!-- Booking Statistics -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Total Bookings</p>
                                        <h4 class="mb-0">{{ $bookings->count() }}</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                        <i class="mdi mdi-ticket font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Total Spent</p>
                                        <h4 class="mb-0">${{ number_format($bookings->sum('final_amount'), 2) }}</h4>
                                    </div>
                                    <div class="text-success ms-auto">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Upcoming Events</p>
                                        <h4 class="mb-0">{{ $bookings->where('event.start_date', '>', now())->count() }}
                                        </h4>
                                    </div>
                                    <div class="text-info ms-auto">
                                        <i class="mdi mdi-calendar-clock font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Total Tickets</p>
                                        <h4 class="mb-0">{{ $bookings->sum('number_of_tickets') }}</h4>
                                    </div>
                                    <div class="text-warning ms-auto">
                                        <i class="mdi mdi-ticket-confirmation font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>

    <!-- Cancel Booking Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Cancel Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="cancelForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <p>Are you sure you want to cancel this booking?</p>
                        <div class="alert alert-warning">
                            <i class="mdi mdi-alert-circle me-2"></i>
                            This action cannot be undone. Refunds will be processed according to our cancellation policy.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm Cancellation</button>
                    </div>
                </form>
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

    <!-- DataTables -->
    <script src="{{ asset('dist/assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('dist/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#bookings-table').DataTable({
                responsive: true,
                order: [
                    [2, 'desc']
                ],
                language: {
                    emptyTable: "No bookings found"
                }
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });

        // Cancel booking function
        function cancelBooking(bookingId) {
            $('#cancelForm').attr('action', '{{ route('user.bookings.index') }}/' + bookingId + '/cancel');
            $('#cancelModal').modal('show');
        }
    </script>
@endsection
