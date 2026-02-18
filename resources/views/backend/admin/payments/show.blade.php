@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Payment Details | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Payment Details</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.payments.index') }}">Payments</a></li>
                                <li class="breadcrumb-item active">Payment Details</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-8">
                        <!-- Payment Information -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title mb-0">Payment Information</h4>
                                    <span class="badge bg-dark" style="font-size: 14px;">Payment #{{ $payment->id }}</span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th style="width: 40%;">Transaction ID:</th>
                                                <td><strong>{{ $payment->transaction_id ?? 'N/A' }}</strong></td>
                                            </tr>
                                            <tr>
                                                <th>Amount:</th>
                                                <td>
                                                    <h4 class="text-primary">${{ number_format($payment->amount, 2) }}</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Payment Method:</th>
                                                <td>
                                                    @switch($payment->method)
                                                        @case('cash')
                                                            <span class="badge bg-primary">Cash</span>
                                                        @break

                                                        @case('card')
                                                            <span class="badge bg-info">Card</span>
                                                        @break

                                                        @case('bank_transfer')
                                                            <span class="badge bg-secondary">Bank Transfer</span>
                                                        @break

                                                        @case('online')
                                                            <span class="badge bg-success">Online</span>
                                                        @break

                                                        @default
                                                            <span class="badge bg-dark">{{ $payment->method }}</span>
                                                    @endswitch
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th style="width: 40%;">Status:</th>
                                                <td>
                                                    @switch($payment->status)
                                                        @case('completed')
                                                            <span class="badge bg-success">Completed</span>
                                                        @break

                                                        @case('pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @break

                                                        @case('failed')
                                                            <span class="badge bg-danger">Failed</span>
                                                        @break

                                                        @case('refunded')
                                                            <span class="badge bg-info">Refunded</span>
                                                        @break

                                                        @default
                                                            <span class="badge bg-secondary">{{ $payment->status }}</span>
                                                    @endswitch
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Payment Date:</th>
                                                <td>
                                                    @if ($payment->paid_at)
                                                        {{ $payment->paid_at->format('d M Y, h:i A') }}
                                                    @else
                                                        <span class="badge bg-warning">Not Paid</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Created At:</th>
                                                <td>{{ $payment->created_at->format('d M Y, h:i A') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Details -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Booking Details</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th style="width: 35%;">Booking Code:</th>
                                                <td>
                                                    <span
                                                        class="badge bg-dark">{{ $payment->booking->booking_code ?? 'N/A' }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Number of Tickets:</th>
                                                <td>{{ $payment->booking->number_of_tickets ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Ticket Price:</th>
                                                <td>${{ number_format($payment->booking->ticket_price ?? 0, 2) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th style="width: 35%;">Discount:</th>
                                                <td class="text-success">
                                                    -${{ number_format($payment->booking->discount_amount ?? 0, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Amount:</th>
                                                <td>${{ number_format($payment->booking->total_amount ?? 0, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Booking Status:</th>
                                                <td>
                                                    @switch($payment->booking->status ?? '')
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
                                                            <span
                                                                class="badge bg-secondary">{{ $payment->booking->status ?? 'N/A' }}</span>
                                                    @endswitch
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('admin.bookings.show', $payment->booking_id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="mdi mdi-eye me-2"></i> View Full Booking
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Customer Information</h4>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="avatar-lg mx-auto mb-3">
                                            <div class="avatar-title bg-soft-primary text-primary rounded-circle"
                                                style="font-size: 2rem;">
                                                {{ substr($payment->booking->user->name ?? 'U', 0, 1) }}
                                            </div>
                                        </div>
                                        <h5>{{ $payment->booking->user->name ?? 'N/A' }}</h5>
                                        <p class="text-muted">Customer ID: #{{ $payment->booking->user->id ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-8">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th style="width: 30%;">Email:</th>
                                                <td>{{ $payment->booking->user->email ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone:</th>
                                                <td>{{ $payment->booking->user->phone ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Member Since:</th>
                                                <td>{{ isset($payment->booking->user) ? $payment->booking->user->created_at->format('d M Y') : 'N/A' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Event Details -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Event Details</h5>
                                <div class="text-center mb-3">
                                    <img src="{{ $payment->booking->event->image ? asset($payment->booking->event->image) : url('') }}/dist/assets/images/events/default-event.jpg"
                                        alt="{{ $payment->booking->event->title }}" class="img-fluid rounded"
                                        style="width: 100%; height: 150px; object-fit: cover;">
                                </div>
                                <h6 class="text-center">
                                    <a href="{{ route('admin.events.show', $payment->booking->event_id) }}"
                                        class="text-primary">
                                        {{ $payment->booking->event->title ?? 'N/A' }}
                                    </a>
                                </h6>
                                <hr>
                                <table class="table table-sm">
                                    <tr>
                                        <td><i class="mdi mdi-map-marker text-primary me-2"></i> Venue:</td>
                                        <td>{{ $payment->booking->event->venue->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="mdi mdi-calendar text-primary me-2"></i> Date:</td>
                                        <td>{{ isset($payment->booking->event) ? date('d M Y', strtotime($payment->booking->event->event_date)) : 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="mdi mdi-clock text-primary me-2"></i> Time:</td>
                                        <td>{{ $payment->booking->event->start_time ?? 'N/A' }} -
                                            {{ $payment->booking->event->end_time ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Update Payment Status -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Update Payment Status</h5>
                                <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Payment Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="completed"
                                                {{ $payment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>
                                                Failed</option>
                                            <option value="refunded"
                                                {{ $payment->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="mdi mdi-update me-2"></i> Update Status
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Payment Timeline -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Payment Timeline</h5>
                                <div class="timeline">
                                    <div class="timeline-item pb-3">
                                        <div class="timeline-badge">
                                            <i class="mdi mdi-circle bg-primary"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-0">Payment Created</h6>
                                            <small
                                                class="text-muted">{{ $payment->created_at->format('d M Y, h:i A') }}</small>
                                        </div>
                                    </div>

                                    @if ($payment->paid_at)
                                        <div class="timeline-item pb-3">
                                            <div class="timeline-badge">
                                                <i class="mdi mdi-circle bg-success"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Payment Completed</h6>
                                                <small
                                                    class="text-muted">{{ $payment->paid_at->format('d M Y, h:i A') }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($payment->status == 'refunded')
                                        <div class="timeline-item pb-3">
                                            <div class="timeline-badge">
                                                <i class="mdi mdi-circle bg-info"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Payment Refunded</h6>
                                                <small
                                                    class="text-muted">{{ $payment->updated_at->format('d M Y, h:i A') }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($payment->status == 'failed')
                                        <div class="timeline-item pb-3">
                                            <div class="timeline-badge">
                                                <i class="mdi mdi-circle bg-danger"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Payment Failed</h6>
                                                <small
                                                    class="text-muted">{{ $payment->updated_at->format('d M Y, h:i A') }}</small>
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
                                    <button class="btn btn-outline-primary" onclick="printReceipt()">
                                        <i class="mdi mdi-printer me-2"></i> Print Receipt
                                    </button>
                                    <button class="btn btn-outline-success" onclick="sendReceipt()">
                                        <i class="mdi mdi-email me-2"></i> Email Receipt
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="refundPayment()">
                                        <i class="mdi mdi-cash-refund me-2"></i> Process Refund
                                    </button>
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
        function printReceipt() {
            window.print();
        }

        function sendReceipt() {
            // Implement email receipt functionality
            alert('Email receipt will be sent to customer');
        }

        function refundPayment() {
            if (confirm('Are you sure you want to process a refund for this payment?')) {
                // Implement refund functionality
                alert('Refund process initiated');
            }
        }

        // Show warning when changing status to refunded
        $('#status').on('change', function() {
            if ($(this).val() === 'refunded') {
                if (!confirm('Warning: Marking payment as refunded will process a refund. Continue?')) {
                    $(this).val('{{ $payment->status }}');
                }
            }
        });
    </script>
@endsection
