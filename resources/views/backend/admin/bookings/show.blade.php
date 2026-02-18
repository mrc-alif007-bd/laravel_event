@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Booking Details | {{ config('app.name') }}</title>
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
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.bookings.index') }}">Bookings</a></li>
                                <li class="breadcrumb-item active">Booking Details</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning">
                                    <i class="mdi mdi-pencil me-2"></i> Edit Booking
                                </a>
                                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-8">
                        <!-- Booking Information -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title mb-0">Booking Information</h4>
                                    <span class="badge bg-dark" style="font-size: 14px;">{{ $booking->booking_code }}</span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th style="width: 40%;">Booking ID:</th>
                                                <td><strong>#{{ $booking->id }}</strong></td>
                                            </tr>
                                            <tr>
                                                <th>Booking Date:</th>
                                                <td>{{ $booking->created_at->format('d M Y, h:i A') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status:</th>
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
                                            </tr>
                                            <tr>
                                                <th>Payment Status:</th>
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
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th style="width: 40%;">Number of Tickets:</th>
                                                <td><span class="badge bg-info">{{ $booking->number_of_tickets }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Ticket Price:</th>
                                                <td>${{ number_format($booking->ticket_price ?? 0, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Discount:</th>
                                                <td class="text-success">
                                                    -${{ number_format($booking->discount_amount ?? 0, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Amount:</th>
                                                <td><strong>${{ number_format($booking->total_amount ?? 0, 2) }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Final Amount:</th>
                                                <td>
                                                    <h5 class="text-primary">
                                                        ${{ number_format($booking->final_amount ?? $booking->total_amount, 2) }}
                                                    </h5>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Event Details -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Event Details</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ $booking->event->image ? asset($booking->event->image) : url('') }}/dist/assets/images/events/default-event.jpg"
                                            alt="{{ $booking->event->title }}" class="img-fluid rounded"
                                            style="width: 100%; height: 150px; object-fit: cover;">
                                    </div>
                                    <div class="col-md-8">
                                        <h5>
                                            <a href="{{ route('admin.events.show', $booking->event_id) }}"
                                                class="text-primary">
                                                {{ $booking->event->title }}
                                            </a>
                                        </h5>
                                        <table class="table table-borderless">
                                            <tr>
                                                <th style="width: 30%;">Venue:</th>
                                                <td>{{ $booking->event->venue->name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date & Time:</th>
                                                <td>{{ date('d M Y', strtotime($booking->event->event_date)) }} |
                                                    {{ $booking->event->start_time }} - {{ $booking->event->end_time }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Category:</th>
                                                <td>
                                                    <span
                                                        class="badge bg-info">{{ $booking->event->category->name ?? 'N/A' }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Details -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Customer Details</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th style="width: 35%;">Name:</th>
                                                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email:</th>
                                                <td>{{ $booking->user->email ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone:</th>
                                                <td>{{ $booking->user->phone ?? 'N/A' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th style="width: 35%;">Customer ID:</th>
                                                <td>#{{ $booking->user->id ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Member Since:</th>
                                                <td>{{ isset($booking->user) ? $booking->user->created_at->format('d M Y') : 'N/A' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment History -->
                        @if ($booking->payments && $booking->payments->count() > 0)
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Payment History</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Payment ID</th>
                                                    <th>Amount</th>
                                                    <th>Payment Method</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($booking->payments as $payment)
                                                    <tr>
                                                        <td>#{{ $payment->id }}</td>
                                                        <td>${{ number_format($payment->amount ?? 0, 2) }}</td>
                                                        <td>{{ $payment->payment_method ?? 'N/A' }}</td>
                                                        <td>
                                                            @if ($payment->status == 'completed')
                                                                <span class="badge bg-success">Completed</span>
                                                            @elseif($payment->status == 'pending')
                                                                <span class="badge bg-warning">Pending</span>
                                                            @else
                                                                <span class="badge bg-danger">Failed</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $payment->created_at->format('d M Y, h:i A') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <!-- Status Timeline -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Status Timeline</h5>
                                <div class="timeline">
                                    <div class="timeline-item pb-3">
                                        <div class="timeline-badge">
                                            <i class="mdi mdi-circle bg-success"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-0">Booking Created</h6>
                                            <small
                                                class="text-muted">{{ $booking->created_at->format('d M Y, h:i A') }}</small>
                                        </div>
                                    </div>

                                    @if ($booking->status == 'confirmed')
                                        <div class="timeline-item pb-3">
                                            <div class="timeline-badge">
                                                <i class="mdi mdi-circle bg-success"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Booking Confirmed</h6>
                                                <small
                                                    class="text-muted">{{ $booking->updated_at->format('d M Y, h:i A') }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($booking->payment_status == 'paid')
                                        <div class="timeline-item pb-3">
                                            <div class="timeline-badge">
                                                <i class="mdi mdi-circle bg-success"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Payment Completed</h6>
                                                <small
                                                    class="text-muted">{{ $booking->updated_at->format('d M Y, h:i A') }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($booking->status == 'cancelled')
                                        <div class="timeline-item pb-3">
                                            <div class="timeline-badge">
                                                <i class="mdi mdi-circle bg-danger"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Booking Cancelled</h6>
                                                <small
                                                    class="text-muted">{{ $booking->updated_at->format('d M Y, h:i A') }}</small>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Quick Actions</h5>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-primary" onclick="printBooking()">
                                        <i class="mdi mdi-printer me-2"></i> Print Invoice
                                    </button>
                                    <button class="btn btn-outline-success" onclick="sendEmail()">
                                        <i class="mdi mdi-email me-2"></i> Send Email
                                    </button>
                                    <button class="btn btn-outline-info" onclick="downloadTicket()">
                                        <i class="mdi mdi-ticket me-2"></i> Download Ticket
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Meta Information -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Additional Information</h5>
                                <dl class="row mb-0">
                                    <dt class="col-sm-5">Last Updated:</dt>
                                    <dd class="col-sm-7">{{ $booking->updated_at->format('d M Y, h:i A') }}</dd>

                                    @if ($booking->deleted_at)
                                        <dt class="col-sm-5">Deleted At:</dt>
                                        <dd class="col-sm-7">{{ $booking->deleted_at->format('d M Y, h:i A') }}</dd>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>

    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline-item {
            position: relative;
            border-left: 2px solid #e9ecef;
            padding-left: 20px;
            margin-left: 10px;
        }

        .timeline-item:last-child {
            border-left-color: transparent;
        }

        .timeline-badge {
            position: absolute;
            left: -29px;
            top: 0;
            background: white;
            padding: 0 5px;
        }

        .timeline-badge i {
            font-size: 16px;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ url('') }}/dist/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ url('') }}/dist/assets/js/app.js"></script>

    <script>
        function printBooking() {
            window.print();
        }

        function sendEmail() {
            // Implement email sending functionality
            alert('Email functionality will be implemented here');
        }

        function downloadTicket() {
            // Implement ticket download functionality
            alert('Ticket download will be implemented here');
        }
    </script>
@endsection
