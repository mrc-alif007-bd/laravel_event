@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>User Details | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">User Details</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                                <li class="breadcrumb-item active">User Details</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                                    <i class="mdi mdi-pencil me-2"></i> Edit User
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-4">
                        <!-- User Profile Card -->
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <div class="avatar-xl mx-auto">
                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle"
                                            style="font-size: 3rem;">
                                            {{ substr($user->name, 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <h4 class="mb-1">{{ $user->name }}</h4>
                                <p class="text-muted">{{ $user->email }}</p>

                                <div class="mt-3">
                                    @if ($user->role == 'admin')
                                        <span class="badge bg-success">Administrator</span>
                                    @else
                                        <span class="badge bg-info">Regular User</span>
                                    @endif
                                </div>

                                <hr>

                                <div class="text-start">
                                    <p class="mb-2"><i class="mdi mdi-phone me-2 text-primary"></i>
                                        {{ $user->phone ?? 'No phone number' }}</p>
                                    <p class="mb-2"><i class="mdi mdi-calendar me-2 text-primary"></i> Joined
                                        {{ $user->created_at->format('d M Y') }}</p>
                                    <p class="mb-2"><i class="mdi mdi-clock me-2 text-primary"></i> Last updated
                                        {{ $user->updated_at->format('d M Y') }}</p>
                                </div>

                                @if ($user->deleted_at)
                                    <div class="alert alert-warning mt-3 mb-0">
                                        <i class="mdi mdi-alert me-2"></i>
                                        User deleted on {{ $user->deleted_at->format('d M Y') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Activity Overview</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="text-center">
                                            <h3>{{ $user->bookings->count() }}</h3>
                                            <p class="text-muted mb-0">Total Bookings</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center">
                                            <h3>{{ $user->reviews->count() }}</h3>
                                            <p class="text-muted mb-0">Total Reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <!-- Recent Bookings -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Recent Bookings</h5>
                                @if ($user->bookings->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Booking Code</th>
                                                    <th>Event</th>
                                                    <th>Date</th>
                                                    <th>Tickets</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user->bookings->sortByDesc('created_at')->take(5) as $booking)
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-dark">{{ $booking->booking_code }}</span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.events.show', $booking->event_id) }}"
                                                                class="text-primary">
                                                                {{ Str::limit($booking->event->title ?? 'N/A', 20) }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                                                        <td>{{ $booking->number_of_tickets }}</td>
                                                        <td>${{ number_format($booking->total_amount, 2) }}</td>
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
                                                        <td>
                                                            <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                                                class="btn btn-sm btn-primary">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($user->bookings->count() > 5)
                                        <div class="text-center mt-3">
                                            <a href="#" class="text-primary">View all {{ $user->bookings->count() }}
                                                bookings</a>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-muted text-center mb-0">No bookings found for this user.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Recent Reviews -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Recent Reviews</h5>
                                @if ($user->reviews->count() > 0)
                                    @foreach ($user->reviews->sortByDesc('created_at')->take(3) as $review)
                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                        {{ substr($review->event->title ?? 'E', 0, 1) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="mt-0 mb-1">
                                                            <a href="{{ route('admin.events.show', $review->event_id) }}"
                                                                class="text-primary">
                                                                {{ $review->event->title ?? 'Deleted Event' }}
                                                            </a>
                                                        </h6>
                                                        <div class="text-warning mb-2">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $review->rating)
                                                                    <i class="mdi mdi-star"></i>
                                                                @else
                                                                    <i class="mdi mdi-star-outline"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <small
                                                        class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                                                </div>
                                                <p class="text-muted mb-0">{{ Str::limit($review->comment, 100) }}</p>
                                                <a href="{{ route('admin.reviews.show', $review->id) }}"
                                                    class="text-primary small">View Full Review</a>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($user->reviews->count() > 3)
                                        <div class="text-center mt-2">
                                            <a href="#" class="text-primary">View all {{ $user->reviews->count() }}
                                                reviews</a>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-muted text-center mb-0">No reviews found for this user.</p>
                                @endif
                            </div>
                        </div>

                        <!-- User Activity Timeline -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Recent Activity</h5>
                                <div class="timeline">
                                    @php
                                        $activities = collect();

                                        foreach ($user->bookings as $booking) {
                                            $activities->push([
                                                'type' => 'booking',
                                                'title' => 'Made a booking',
                                                'subtitle' => 'Event: ' . ($booking->event->title ?? 'N/A'),
                                                'time' => $booking->created_at,
                                                'icon' => 'mdi-ticket',
                                                'color' => 'primary',
                                            ]);
                                        }

                                        foreach ($user->reviews as $review) {
                                            $activities->push([
                                                'type' => 'review',
                                                'title' => 'Left a review',
                                                'subtitle' => 'Rating: ' . $review->rating . ' stars',
                                                'time' => $review->created_at,
                                                'icon' => 'mdi-star',
                                                'color' => 'warning',
                                            ]);
                                        }

                                        $activities = $activities->sortByDesc('time')->take(5);
                                    @endphp

                                    @forelse($activities as $activity)
                                        <div class="timeline-item pb-3">
                                            <div class="timeline-badge">
                                                <i class="mdi {{ $activity['icon'] }} bg-{{ $activity['color'] }}"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 class="mb-1">{{ $activity['title'] }}</h6>
                                                <p class="text-muted mb-1">{{ $activity['subtitle'] }}</p>
                                                <small class="text-muted">{{ $activity['time']->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted text-center mb-0">No recent activity</p>
                                    @endforelse
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
            padding: 4px;
            border-radius: 50%;
            color: white;
        }

        .timeline-badge .bg-primary {
            background-color: #556ee6 !important;
        }

        .timeline-badge .bg-warning {
            background-color: #f1b44c !important;
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
@endsection
