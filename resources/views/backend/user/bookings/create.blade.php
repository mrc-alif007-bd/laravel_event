@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Create Booking | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Create Booking</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user.bookings.index') }}">My Bookings</a>
                                </li>
                                <li class="breadcrumb-item active">Create Booking</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-circle me-2"></i>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Book New Event</h4>

                                <form action="{{ route('user.bookings.store') }}" method="POST">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="event_id" class="form-label">Select Event <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select @error('event_id') is-invalid @enderror"
                                                    id="event_id" name="event_id" required>
                                                    <option value="">Choose event...</option>
                                                    @foreach ($events ?? [] as $event)
                                                        <option value="{{ $event->id }}"
                                                            data-price="{{ $event->price }}"
                                                            {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                                            {{ $event->name }} - ${{ number_format($event->price, 2) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('event_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="number_of_tickets" class="form-label">Number of Tickets <span
                                                        class="text-danger">*</span></label>
                                                <input type="number"
                                                    class="form-control @error('number_of_tickets') is-invalid @enderror"
                                                    id="number_of_tickets" name="number_of_tickets"
                                                    value="{{ old('number_of_tickets', 1) }}" min="1" required>
                                                @error('number_of_tickets')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Price Summary -->
                                    <div class="row mt-3">
                                        <div class="col-md-6 offset-md-6">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-3">Price Summary</h5>
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span>Ticket Price:</span>
                                                        <span class="fw-bold" id="ticket-price">$0.00</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span>Quantity:</span>
                                                        <span class="fw-bold" id="ticket-quantity">0</span>
                                                    </div>
                                                    <hr class="my-2">
                                                    <div class="d-flex justify-content-between">
                                                        <span class="fw-bold">Total Amount:</span>
                                                        <span class="fw-bold text-primary" id="total-amount">$0.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-check-circle me-2"></i> Create Booking
                                            </button>
                                            <a href="{{ route('user.bookings.index') }}" class="btn btn-secondary">
                                                <i class="mdi mdi-arrow-left me-2"></i> Back to Bookings
                                            </a>
                                        </div>
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
    <script src="{{ asset('dist/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            function updatePriceSummary() {
                const selectedEvent = $('#event_id option:selected');
                const ticketPrice = parseFloat(selectedEvent.data('price')) || 0;
                const quantity = parseInt($('#number_of_tickets').val()) || 0;
                const total = ticketPrice * quantity;

                $('#ticket-price').text('$' + ticketPrice.toFixed(2));
                $('#ticket-quantity').text(quantity);
                $('#total-amount').text('$' + total.toFixed(2));
            }

            $('#event_id').on('change', updatePriceSummary);
            $('#number_of_tickets').on('input', updatePriceSummary);

            // Initial update
            updatePriceSummary();
        });
    </script>
@endsection
