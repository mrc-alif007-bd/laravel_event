@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Booking Details | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('dist/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
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
                            <h6 class="page-title">Booking Details</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user.bookings.index') }}">My Bookings</a>
                                </li>
                                <li class="breadcrumb-item active">Booking #{{ $booking->booking_code ?? $booking->id }}
                                </li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('user.bookings.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i> Back to Bookings
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

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-md">
                                            <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                <i class="mdi mdi-ticket font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h4 class="card-title mb-1">Booking Information</h4>
                                        <p class="text-muted mb-0">Booking Code: <span
                                                class="fw-bold text-dark">#{{ $booking->booking_code ?? 'N/A' }}</span></p>
                                    </div>
                                    <div>
                                        @php
                                            $statusClasses = [
                                                'pending' => 'badge-soft-warning',
                                                'confirmed' => 'badge-soft-success',
                                                'cancelled' => 'badge-soft-danger',
                                                'completed' => 'badge-soft-info',
                                            ];
                                            $statusClass = $statusClasses[$booking->status] ?? 'badge-soft-secondary';
                                        @endphp
                                        <span class="badge {{ $statusClass }} p-3">{{ ucfirst($booking->status) }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <h5 class="font-size-15 mb-2">Event Details</h5>
                                            <div class="p-3 border rounded">
                                                <h6>{{ $booking->event->name }}</h6>
                                                <p class="text-muted mb-2">
                                                    <i class="mdi mdi-map-marker me-1"></i> {{ $booking->event->venue }}
                                                </p>
                                                <p class="text-muted mb-2">
                                                    <i class="mdi mdi-calendar me-1"></i>
                                                    {{ $booking->event->start_date ? $booking->event->start_date->format('l, F d, Y') : 'N/A' }}
                                                </p>
                                                <p class="text-muted mb-0">
                                                    <i class="mdi mdi-clock me-1"></i>
                                                    {{ $booking->event->start_time ? $booking->event->start_time->format('h:i A') : 'N/A' }}
                                                    -
                                                    {{ $booking->event->end_time ? $booking->event->end_time->format('h:i A') : 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <h5 class="font-size-15 mb-2">Ticket Details</h5>
                                            <div class="p-3 border rounded">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Number of Tickets:</span>
                                                    <span class="fw-bold">{{ $booking->number_of_tickets }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Price per Ticket:</span>
                                                    <span>${{ number_format($booking->ticket_price ?? 0, 2) }}</span>
                                                </div>
                                                @if ($booking->discount_amount > 0)
                                                    <div class="d-flex justify-content-between mb-2 text-success">
                                                        <span>Discount:</span>
                                                        <span>-${{ number_format($booking->discount_amount, 2) }}</span>
                                                    </div>
                                                @endif
                                                <hr class="my-2">
                                                <div class="d-flex justify-content-between">
                                                    <span class="fw-bold">Total Amount:</span>
                                                    <span
                                                        class="fw-bold text-primary">${{ number_format($booking->final_amount ?? $booking->total_amount, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($booking->payments->isNotEmpty())
                                    <div class="mb-4">
                                        <h5 class="font-size-15 mb-2">Payment History</h5>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Payment ID</th>
                                                        <th>Date</th>
                                                        <th>Amount</th>
                                                        <th>Method</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($booking->payments as $payment)
                                                        <tr>
                                                            <td>#{{ $payment->id }}</td>
                                                            <td>{{ $payment->created_at->format('M d, Y h:i A') }}</td>
                                                            <td>${{ number_format($payment->amount, 2) }}</td>
                                                            <td>{{ ucfirst($payment->payment_method) }}</td>
                                                            <td>
                                                                @php
                                                                    $paymentClasses = [
                                                                        'completed' => 'badge-soft-success',
                                                                        'pending' => 'badge-soft-warning',
                                                                        'failed' => 'badge-soft-danger',
                                                                    ];
                                                                    $paymentClass =
                                                                        $paymentClasses[$payment->status] ??
                                                                        'badge-soft-secondary';
                                                                @endphp
                                                                <span
                                                                    class="badge {{ $paymentClass }}">{{ ucfirst($payment->status) }}</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                @if ($booking->status == 'pending' && $booking->payments->isEmpty())
                                    <div class="alert alert-warning">
                                        <i class="mdi mdi-information-outline me-2"></i>
                                        This booking requires payment to be confirmed.
                                        <a href="{{ route('user.payments.create', ['booking_id' => $booking->id]) }}"
                                            class="alert-link">Make Payment Now</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Booking Timeline</h5>
                                <div class="timeline">
                                    <div class="timeline-item pb-4">
                                        <div class="timeline-dot bg-success"></div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">Booking Created</h6>
                                            <small
                                                class="text-muted">{{ $booking->created_at->format('M d, Y h:i A') }}</small>
                                        </div>
                                    </div>

                                    @if ($booking->payments->isNotEmpty())
                                        <div class="timeline-item pb-4">
                                            <div class="timeline-dot bg-info"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-1">Payment Made</h6>
                                                <small
                                                    class="text-muted">{{ $booking->payments->first()->created_at->format('M d, Y h:i A') }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($booking->status == 'confirmed')
                                        <div class="timeline-item pb-4">
                                            <div class="timeline-dot bg-success"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-1">Booking Confirmed</h6>
                                                <small
                                                    class="text-muted">{{ $booking->updated_at->format('M d, Y h:i A') }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($booking->status == 'cancelled')
                                        <div class="timeline-item pb-4">
                                            <div class="timeline-dot bg-danger"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-1">Booking Cancelled</h6>
                                                <small
                                                    class="text-muted">{{ $booking->updated_at->format('M d, Y h:i A') }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="timeline-item">
                                        <div class="timeline-dot bg-secondary"></div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">Event Date</h6>
                                            <small
                                                class="text-muted">{{ $booking->event->start_date ? $booking->event->start_date->format('M d, Y') : 'N/A' }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($booking->status == 'pending')
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Actions</h5>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('user.payments.create', ['booking_id' => $booking->id]) }}"
                                            class="btn btn-success">
                                            <i class="mdi mdi-credit-card me-2"></i> Proceed to Payment
                                        </a>
                                        <button type="button" class="btn btn-danger"
                                            onclick="cancelBooking({{ $booking->id }})">
                                            <i class="mdi mdi-close me-2"></i> Cancel Booking
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>

    <!-- Cancel Booking Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.bookings.cancel', $booking->id) }}" method="POST" id="cancelForm">
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
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>

    <script>
        function cancelBooking(bookingId) {
            $('#cancelModal').modal('show');
        }
    </script>
@endsection
