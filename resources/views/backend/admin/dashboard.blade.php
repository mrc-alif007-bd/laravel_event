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
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">Admin Dashboard</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Welcome to Admin Dashboard</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-cog me-2"></i> Settings
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- Fixed: Added admin ID parameter -->
                                        <a class="dropdown-item"
                                            href="{{ route('admin.profile.edit', Auth::guard('admin')->id()) }}">
                                            <i class="mdi mdi-account-circle"></i> Profile Settings
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                            <i class="mdi mdi-account-multiple"></i> User Management
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="mdi mdi-logout"></i> Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <!-- Total Users Card -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-start mini-stat-img me-4">
                                        <img src="{{ url('') }}/dist/assets/images/services-icon/01.png"
                                            alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase text-white-50">Total Users</h5>
                                    <h4 class="fw-medium font-size-24">{{ number_format($totalUsers) }}</h4>
                                </div>
                                <div class="pt-2">
                                    <div class="float-end">
                                        <a href="{{ route('admin.users.index') }}" class="text-white-50">
                                            <i class="mdi mdi-arrow-right h5 text-white-50"></i>
                                        </a>
                                    </div>
                                    <p class="text-white-50 mb-0 mt-1">Registered users</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Events Card -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-start mini-stat-img me-4">
                                        <img src="{{ url('') }}/dist/assets/images/services-icon/02.png"
                                            alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase text-white-50">Total Events</h5>
                                    <h4 class="fw-medium font-size-24">{{ number_format($totalEvents) }}</h4>
                                </div>
                                <div class="pt-2">
                                    <div class="float-end">
                                        <a href="{{ route('admin.events.index') }}" class="text-white-50">
                                            <i class="mdi mdi-arrow-right h5 text-white-50"></i>
                                        </a>
                                    </div>
                                    <p class="text-white-50 mb-0 mt-1">Active & upcoming events</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Bookings Card -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-start mini-stat-img me-4">
                                        <img src="{{ url('') }}/dist/assets/images/services-icon/03.png"
                                            alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase text-white-50">Total Bookings</h5>
                                    <h4 class="fw-medium font-size-24">{{ number_format($totalBookings) }}</h4>
                                </div>
                                <div class="pt-2">
                                    <div class="float-end">
                                        <a href="{{ route('admin.bookings.index') }}" class="text-white-50">
                                            <i class="mdi mdi-arrow-right h5 text-white-50"></i>
                                        </a>
                                    </div>
                                    <p class="text-white-50 mb-0 mt-1">All time bookings</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Payments Card -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat bg-primary text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-start mini-stat-img me-4">
                                        <img src="{{ url('') }}/dist/assets/images/services-icon/04.png"
                                            alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase text-white-50">Total Payments</h5>
                                    <h4 class="fw-medium font-size-24">{{ number_format($totalPayments) }}</h4>
                                </div>
                                <div class="pt-2">
                                    <div class="float-end">
                                        <a href="{{ route('admin.payments.index') }}" class="text-white-50">
                                            <i class="mdi mdi-arrow-right h5 text-white-50"></i>
                                        </a>
                                    </div>
                                    <p class="text-white-50 mb-0 mt-1">Completed transactions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <!-- Latest Bookings Table -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Latest Bookings</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Booking ID</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Event</th>
                                                <th scope="col">Booking Date</th>
                                                <th scope="col">Tickets</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $latestBookings = App\Models\Booking::with(['user', 'event'])
                                                    ->latest()
                                                    ->take(5)
                                                    ->get();
                                            @endphp

                                            @forelse($latestBookings as $booking)
                                                <tr>
                                                    <th scope="row">#{{ $booking->id }}</th>
                                                    <td>
                                                        <div>
                                                            <img src="{{ $booking->user->avatar ?? url('') }}/dist/assets/images/users/user-2.jpg"
                                                                alt="" class="avatar-xs rounded-circle me-2">
                                                            {{ $booking->user->name }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $booking->event->title ?? 'N/A' }}</td>
                                                    <td>{{ $booking->created_at->format('d/m/Y') }}</td>
                                                    <td>{{ $booking->number_of_tickets ?? '1' }}</td>
                                                    <td>
                                                        @php
                                                            $statusClass = match ($booking->status ?? 'pending') {
                                                                'confirmed' => 'success',
                                                                'pending' => 'warning',
                                                                'cancelled' => 'danger',
                                                                default => 'secondary',
                                                            };
                                                        @endphp
                                                        <span class="badge bg-{{ $statusClass }}">
                                                            {{ ucfirst($booking->status ?? 'pending') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="mdi mdi-eye"></i> View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No bookings found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-link">View All Bookings
                                        <i class="mdi mdi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <!-- Recent Payments Table -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Recent Payments</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Payment ID</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $recentPayments = App\Models\Payment::with('booking.user')
                                                    ->latest()
                                                    ->take(5)
                                                    ->get();
                                            @endphp

                                            @forelse($recentPayments as $payment)
                                                <tr>
                                                    <th scope="row">#{{ $payment->id }}</th>
                                                    <td>
                                                        <div>
                                                            <img src="{{ $payment->booking->user->avatar ?? url('') }}/dist/assets/images/users/user-2.jpg"
                                                                alt="" class="avatar-xs rounded-circle me-2">
                                                            {{ $payment->booking->user->name ?? 'N/A' }}
                                                        </div>
                                                    </td>
                                                    <td>${{ number_format($payment->amount ?? 0, 2) }}</td>
                                                    <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        @php
                                                            $paymentStatus = $payment->status ?? 'pending';
                                                            $statusClass = match ($paymentStatus) {
                                                                'completed' => 'success',
                                                                'pending' => 'warning',
                                                                'failed' => 'danger',
                                                                default => 'secondary',
                                                            };
                                                        @endphp
                                                        <span class="badge bg-{{ $statusClass }}">
                                                            {{ ucfirst($paymentStatus) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.payments.show', $payment->id) }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="mdi mdi-eye"></i> View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No payments found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="{{ route('admin.payments.index') }}" class="btn btn-link">View All Payments
                                        <i class="mdi mdi-arrow-right"></i></a>
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
@endsection
