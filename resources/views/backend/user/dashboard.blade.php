@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Dashboard | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('') }}/dist/assets/images/favicon.ico">

        <link href="{{ url('') }}/dist/assets/libs/chartist/chartist.min.css" rel="stylesheet">

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
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Welcome Card -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Welcome back, {{ $user->name }}!</h4>
                                <p class="card-text">Here's what's happening with your account today.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">Total Bookings</p>
                                        <h4 class="mb-0">{{ $totalBookings }}</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                        <i class="ri-calendar-check-line font-size-24"></i>
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
                                        <p class="text-truncate font-size-14 mb-2">Total Payments</p>
                                        <h4 class="mb-0">{{ $totalPayments }}</h4>
                                    </div>
                                    <div class="text-success ms-auto">
                                        <i class="ri-money-dollar-circle-line font-size-24"></i>
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
                                        <p class="text-truncate font-size-14 mb-2">Pending Bookings</p>
                                        <h4 class="mb-0">{{ $pendingBookings ?? 0 }}</h4>
                                    </div>
                                    <div class="text-warning ms-auto">
                                        <i class="ri-time-line font-size-24"></i>
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
                                        <p class="text-truncate font-size-14 mb-2">Completed Bookings</p>
                                        <h4 class="mb-0">{{ $completedBookings ?? 0 }}</h4>
                                    </div>
                                    <div class="text-info ms-auto">
                                        <i class="ri-checkbox-circle-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <!-- Latest Bookings -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Latest Bookings</h4>
                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Booking ID</th>
                                                <th>Event</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($latestBookings as $booking)
                                                <tr>
                                                    <td><a href="javascript: void(0);"
                                                            class="text-body fw-bold">#{{ $booking->id }}</a></td>
                                                    <td>{{ $booking->event->name ?? 'N/A' }}</td>
                                                    <td>{{ $booking->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        @php
                                                            $statusClass =
                                                                [
                                                                    'pending' => 'badge-soft-warning',
                                                                    'confirmed' => 'badge-soft-success',
                                                                    'cancelled' => 'badge-soft-danger',
                                                                    'completed' => 'badge-soft-info',
                                                                ][$booking->status] ?? 'badge-soft-secondary';
                                                        @endphp
                                                        <span
                                                            class="badge {{ $statusClass }}">{{ ucfirst($booking->status) }}</span>
                                                    </td>
                                                    <td>${{ number_format($booking->total_amount ?? 0, 2) }}</td>
                                                    <td>
                                                        <a href="{{ route('user.bookings.show', $booking->id) }}"
                                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                            View Details
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No bookings found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                                <div class="row mt-3">
                                    <div class="col-sm-12 col-md-7">
                                        <a href="{{ route('user.bookings.index') }}"
                                            class="btn btn-link waves-effect waves-light">
                                            View All Bookings <i class="ri-arrow-right-line align-middle"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <!-- Recent Activity -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Recent Payments</h4>
                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Payment ID</th>
                                                <th>Booking</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($recentPayments ?? [] as $payment)
                                                <tr>
                                                    <td>#{{ $payment->id }}</td>
                                                    <td>#{{ $payment->booking_id }}</td>
                                                    <td>${{ number_format($payment->amount, 2) }}</td>
                                                    <td>
                                                        <span class="badge badge-soft-success">Completed</span>
                                                    </td>
                                                    <td>{{ $payment->created_at->format('d M Y') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No payments found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Quick Actions</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <i class="ri-calendar-event-line display-4 text-primary"></i>
                                                <h5 class="mt-3">Book New Event</h5>
                                                <p class="text-muted">Browse and book upcoming events</p>
                                                <a href="{{ route('user.events.index') }}"
                                                    class="btn btn-primary btn-sm">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <i class="ri-history-line display-4 text-success"></i>
                                                <h5 class="mt-3">View History</h5>
                                                <p class="text-muted">Check your booking history</p>
                                                <a href="{{ route('user.bookings.index') }}"
                                                    class="btn btn-success btn-sm">View History</a>
                                            </div>
                                        </div>
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
@endsection

@section('scripts')
    <script src="{{ url('') }}/dist/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/node-waves/waves.min.js"></script>

    <!-- Peity chart-->
    <script src="{{ url('') }}/dist/assets/libs/peity/jquery.peity.min.js"></script>

    <!-- Plugin Js-->
    <script src="{{ url('') }}/dist/assets/libs/chartist/chartist.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js"></script>

    <script src="{{ url('') }}/dist/assets/js/pages/dashboard.init.js"></script>
    <script src="{{ url('') }}/dist/assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize any custom dashboard functionality here
            $(".peity-line").peity("line");
            $(".peity-bar").peity("bar");
        });
    </script>
@endsection
