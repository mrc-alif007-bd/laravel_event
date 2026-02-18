@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Payment Details | Veltrix - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">

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
                            <h6 class="page-title">Payment Details</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user.payments.index') }}">Payments</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Payment #{{ $payment->id }}</li>
                            </ol>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('user.payments.index') }}" class="btn btn-secondary waves-effect">
                                <i class="fas fa-arrow-left me-2"></i>Back to Payments
                            </a>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title mb-0">Payment Information</h4>
                                    <span
                                        class="badge fs-6 py-2 px-3 
                                        @if (in_array($payment->status, ['paid', 'completed'])) bg-success
                                        @elseif($payment->status == 'pending') bg-warning
                                        @elseif($payment->status == 'failed') bg-danger
                                        @elseif($payment->status == 'refunded') bg-dark
                                        @else bg-secondary @endif">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th style="width: 40%;">Payment ID:</th>
                                                <td><strong>#{{ $payment->id }}</strong></td>
                                            </tr>
                                            <tr>
                                                <th>Booking ID:</th>
                                                <td><a
                                                        href="{{ route('user.bookings.show', $payment->booking_id) }}">#{{ $payment->booking_id }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Amount:</th>
                                                <td>
                                                    <h3 class="text-primary mb-0">${{ number_format($payment->amount, 2) }}
                                                    </h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Payment Method:</th>
                                                <td>
                                                    @switch($payment->method)
                                                        @case('cash')
                                                            <i class="fas fa-money-bill-wave text-success me-1"></i> Cash
                                                        @break

                                                        @case('card')
                                                            <i class="fas fa-credit-card text-primary me-1"></i> Card
                                                        @break

                                                        @case('bank_transfer')
                                                            <i class="fas fa-university text-secondary me-1"></i> Bank Transfer
                                                        @break

                                                        @default
                                                            {{ ucfirst($payment->method) }}
                                                    @endswitch
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th style="width: 40%;">Transaction ID:</th>
                                                <td>
                                                    @if ($payment->transaction_id)
                                                        <span
                                                            class="badge bg-light text-dark">{{ $payment->transaction_id }}</span>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Paid At:</th>
                                                <td>
                                                    @if ($payment->paid_at)
                                                        {{ $payment->paid_at->format('F d, Y') }}
                                                        <br>
                                                        <small
                                                            class="text-muted">{{ $payment->paid_at->format('h:i A') }}</small>
                                                    @else
                                                        <span class="text-muted">Not paid yet</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Created At:</th>
                                                <td>{{ $payment->created_at->format('F d, Y h:i A') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Last Updated:</th>
                                                <td>{{ $payment->updated_at->format('F d, Y h:i A') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                @if ($payment->notes)
                                    <div class="mt-4">
                                        <h5 class="font-size-14 mb-3">Additional Notes</h5>
                                        <div class="p-3 bg-light rounded">
                                            {{ $payment->notes }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Booking Details Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Related Booking Details</h4>

                                @if ($payment->booking)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="font-size-14 mb-3">Event Information</h6>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th style="width: 40%;">Event:</th>
                                                    <td>
                                                        <strong>{{ $payment->booking->event->title ?? 'N/A' }}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Date:</th>
                                                    <td>{{ $payment->booking->event->date ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Location:</th>
                                                    <td>{{ $payment->booking->event->location ?? 'N/A' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="font-size-14 mb-3">Booking Information</h6>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th style="width: 40%;">Booking Date:</th>
                                                    <td>{{ $payment->booking->created_at->format('M d, Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status:</th>
                                                    <td>
                                                        @switch($payment->booking->status)
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
                                                                    class="badge bg-secondary">{{ $payment->booking->status }}</span>
                                                        @endswitch
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Action:</th>
                                                    <td>
                                                        <a href="{{ route('user.bookings.show', $payment->booking_id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye me-1"></i>View Full Booking
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-muted">Booking details not available.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Payment Summary Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Payment Summary</h4>

                                <div class="text-center mb-4">
                                    <div class="avatar-lg mx-auto mb-3">
                                        <div class="avatar-title bg-light rounded-circle text-primary font-size-24">
                                            <i class="fas fa-receipt"></i>
                                        </div>
                                    </div>
                                    <h5>Payment #{{ $payment->id }}</h5>
                                    <p class="text-muted">
                                        {{ $payment->paid_at ? $payment->paid_at->format('M d, Y') : 'Pending' }}</p>
                                </div>

                                <div class="border-top pt-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal:</span>
                                        <span class="fw-bold">${{ number_format($payment->amount, 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Tax:</span>
                                        <span class="fw-bold">$0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Discount:</span>
                                        <span class="fw-bold">$0.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between border-top pt-3">
                                        <span class="font-size-16 fw-bold">Total:</span>
                                        <span
                                            class="font-size-16 fw-bold text-primary">${{ number_format($payment->amount, 2) }}</span>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    @if ($payment->status == 'pending')
                                        <button type="button" class="btn btn-warning btn-lg w-100 waves-effect"
                                            onclick="retryPayment()">
                                            <i class="fas fa-redo me-2"></i>Retry Payment
                                        </button>
                                    @elseif($payment->status == 'paid' || $payment->status == 'completed')
                                        <button type="button" class="btn btn-success btn-lg w-100 waves-effect"
                                            onclick="requestRefund()">
                                            <i class="fas fa-undo-alt me-2"></i>Request Refund
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Timeline Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Payment Timeline</h4>

                                <div class="timeline">
                                    <div class="timeline-item pb-3">
                                        <div class="timeline-badge">
                                            <i class="fas fa-plus-circle bg-success text-white"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="font-size-14 mb-1">Payment Created</h6>
                                            <p class="text-muted font-size-12 mb-0">
                                                {{ $payment->created_at->format('M d, Y h:i A') }}</p>
                                        </div>
                                    </div>

                                    @if ($payment->paid_at)
                                        <div class="timeline-item pb-3">
                                            <div class="timeline-badge">
                                                <i class="fas fa-check-circle bg-primary text-white"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 class="font-size-14 mb-1">Payment Completed</h6>
                                                <p class="text-muted font-size-12 mb-0">
                                                    {{ $payment->paid_at->format('M d, Y h:i A') }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="timeline-item">
                                        <div class="timeline-badge">
                                            <i class="fas fa-history bg-info text-white"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="font-size-14 mb-1">Last Updated</h6>
                                            <p class="text-muted font-size-12 mb-0">
                                                {{ $payment->updated_at->format('M d, Y h:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Retry Payment Modal -->
    <div class="modal fade" id="retryPaymentModal" tabindex="-1" aria-labelledby="retryPaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="retryPaymentModalLabel">Retry Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to retry this payment of
                        <strong>${{ number_format($payment->amount, 2) }}</strong>?</p>
                    <p class="text-muted font-size-12">You will be redirected to the payment gateway to complete the
                        transaction.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="#" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                    </form>
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
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>

    <style>
        /* Timeline styling */
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline-item {
            position: relative;
            padding-left: 25px;
            border-left: 2px solid #e9ecef;
        }

        .timeline-item:last-child {
            border-left: 2px solid transparent;
        }

        .timeline-badge {
            position: absolute;
            left: -12px;
            top: 0;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .timeline-badge i {
            font-size: 12px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .timeline-content {
            padding-bottom: 20px;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });

        function retryPayment() {
            var myModal = new bootstrap.Modal(document.getElementById('retryPaymentModal'));
            myModal.show();
        }

        function requestRefund() {
            if (confirm('Are you sure you want to request a refund for this payment?')) {
                // Implement refund request logic here
                alert('Refund request submitted. You will be contacted shortly.');
            }
        }
    </script>
@endsection
