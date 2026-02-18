@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Edit Booking | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Edit Booking</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.bookings.index') }}">Bookings</a></li>
                                <li class="breadcrumb-item active">Edit Booking</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Edit Booking: {{ $booking->booking_code }}</h4>

                                <!-- Booking Summary -->
                                <div class="alert alert-info">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Customer:</strong> {{ $booking->user->name ?? 'N/A' }}
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Event:</strong> {{ $booking->event->title ?? 'N/A' }}
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Tickets:</strong> {{ $booking->number_of_tickets }}
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Total:</strong> ${{ number_format($booking->total_amount ?? 0, 2) }}
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Status -->
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Booking Status <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control @error('status') is-invalid @enderror"
                                                    id="status" name="status" required>
                                                    <option value="">Select Status</option>
                                                    <option value="pending"
                                                        {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="confirmed"
                                                        {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>
                                                        Confirmed</option>
                                                    <option value="cancelled"
                                                        {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>
                                                        Cancelled</option>
                                                    <option value="completed"
                                                        {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>
                                                        Completed</option>
                                                    <option value="refunded"
                                                        {{ old('status', $booking->status) == 'refunded' ? 'selected' : '' }}>
                                                        Refunded</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Payment Status -->
                                            <div class="mb-3">
                                                <label for="payment_status" class="form-label">Payment Status <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control @error('payment_status') is-invalid @enderror"
                                                    id="payment_status" name="payment_status" required>
                                                    <option value="">Select Payment Status</option>
                                                    <option value="pending"
                                                        {{ old('payment_status', $booking->payment_status) == 'pending' ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="paid"
                                                        {{ old('payment_status', $booking->payment_status) == 'paid' ? 'selected' : '' }}>
                                                        Paid</option>
                                                    <option value="failed"
                                                        {{ old('payment_status', $booking->payment_status) == 'failed' ? 'selected' : '' }}>
                                                        Failed</option>
                                                    <option value="refunded"
                                                        {{ old('payment_status', $booking->payment_status) == 'refunded' ? 'selected' : '' }}>
                                                        Refunded</option>
                                                </select>
                                                @error('payment_status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status Change Warning -->
                                    <div class="alert alert-warning" id="status-warning" style="display: none;">
                                        <i class="mdi mdi-alert me-2"></i>
                                        <span id="warning-message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save me-2"></i> Update Booking
                                        </button>
                                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                                            <i class="mdi mdi-arrow-left me-2"></i> Back to Bookings
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
@endsection

@section('scripts')
    <script src="{{ url('') }}/dist/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ url('') }}/dist/assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            $('#status, #payment_status').on('change', function() {
                const status = $('#status').val();
                const paymentStatus = $('#payment_status').val();
                const warningDiv = $('#status-warning');
                const warningMessage = $('#warning-message');

                if (status === 'cancelled' && paymentStatus === 'paid') {
                    warningMessage.text(
                        'Warning: This booking has been paid. Cancelling may require refund processing.'
                        );
                    warningDiv.show();
                } else if (status === 'refunded' && paymentStatus !== 'refunded') {
                    warningMessage.text(
                        'Warning: Booking status is refunded but payment status is not marked as refunded.'
                        );
                    warningDiv.show();
                } else if (paymentStatus === 'paid' && status === 'pending') {
                    warningMessage.text('Warning: Payment is paid but booking status is still pending.');
                    warningDiv.show();
                } else {
                    warningDiv.hide();
                }
            });
        });
    </script>
@endsection
