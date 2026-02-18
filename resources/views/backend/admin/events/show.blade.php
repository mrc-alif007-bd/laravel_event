@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>{{ $event->title }} | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Event Details</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
                                <li class="breadcrumb-item active">Event Details</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning">
                                    <i class="mdi mdi-pencil me-2"></i> Edit Event
                                </a>
                                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ $event->image ? asset($event->image) : asset('dist/assets/images/events/default-event.jpg') }}"
                                            alt="{{ $event->title }}" class="img-fluid rounded"
                                            style="width: 100%; height: 200px; object-fit: cover;"
                                            onerror="this.onerror=null;this.src='{{ asset('dist/assets/images/events/default-event.jpg') }}';">
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="card-title mb-3">{{ $event->title }}</h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-2">
                                                    <i class="mdi mdi-map-marker text-primary me-2"></i>
                                                    <strong>Venue:</strong> {{ $event->venue->name ?? 'N/A' }}
                                                </p>
                                                <p class="mb-2">
                                                    <i class="mdi mdi-tag text-primary me-2"></i>
                                                    <strong>Category:</strong>
                                                    <span
                                                        class="badge bg-info">{{ $event->category->name ?? 'N/A' }}</span>
                                                </p>
                                                <p class="mb-2">
                                                    <i class="mdi mdi-calendar text-primary me-2"></i>
                                                    <strong>Date:</strong>
                                                    {{ date('d M Y', strtotime($event->event_date)) }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-2">
                                                    <i class="mdi mdi-clock text-primary me-2"></i>
                                                    <strong>Time:</strong> {{ $event->start_time }} -
                                                    {{ $event->end_time }}
                                                </p>
                                                <p class="mb-2">
                                                    <i class="mdi mdi-ticket text-primary me-2"></i>
                                                    <strong>Tickets:</strong> {{ $event->total_tickets }}
                                                </p>
                                                <p class="mb-2">
                                                    <i class="mdi mdi-currency-usd text-primary me-2"></i>
                                                    <strong>Price:</strong>
                                                    @if ($event->is_paid)
                                                        ${{ number_format($event->price, 2) }}
                                                    @else
                                                        <span class="badge bg-success">Free</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <hr>

                                        <p class="mb-0">
                                            <strong>Status:</strong>
                                            @switch($event->status)
                                                @case(1)
                                                    <span class="badge bg-success">Active</span>
                                                @break

                                                @case(2)
                                                    <span class="badge bg-warning">Upcoming</span>
                                                @break

                                                @case(3)
                                                    <span class="badge bg-danger">Cancelled</span>
                                                @break

                                                @default
                                                    <span class="badge bg-secondary">Draft</span>
                                            @endswitch
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistics Cards -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium mb-2">Total Bookings</p>
                                                <h4 class="mb-0">{{ $event->bookings->count() }}</h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="mdi mdi-ticket font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium mb-2">Available</p>
                                                <h4 class="mb-0">{{ $event->total_tickets - $event->bookings->count() }}
                                                </h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                                    <span class="avatar-title">
                                                        <i class="mdi mdi-ticket-confirmation font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium mb-2">Revenue</p>
                                                <h4 class="mb-0">
                                                    ${{ number_format($event->bookings->sum('total_amount') ?? 0, 2) }}
                                                </h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                                                    <span class="avatar-title">
                                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium mb-2">Reviews</p>
                                                <h4 class="mb-0">{{ $event->reviews->count() }}</h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-info">
                                                    <span class="avatar-title">
                                                        <i class="mdi mdi-star font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Venue Information -->
                        @if ($event->venue)
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Venue Information</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Venue Name:</strong> {{ $event->venue->name }}</p>
                                            <p><strong>Address:</strong> {{ $event->venue->address ?? 'N/A' }}</p>
                                            <p><strong>City:</strong> {{ $event->venue->city ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Capacity:</strong> {{ $event->venue->capacity ?? 'N/A' }}</p>
                                            <p><strong>Contact:</strong> {{ $event->venue->phone ?? 'N/A' }}</p>
                                            <p><strong>Email:</strong> {{ $event->venue->email ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <!-- Recent Bookings -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Recent Bookings</h5>
                                @if ($event->bookings->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Tickets</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($event->bookings->take(5) as $booking)
                                                    <tr>
                                                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                                        <td>{{ $booking->tickets_count ?? 1 }}</td>
                                                        <td>${{ number_format($booking->total_amount ?? 0, 2) }}</td>
                                                        <td>
                                                            @if ($booking->payment_status == 'paid')
                                                                <span class="badge bg-success">Paid</span>
                                                            @else
                                                                <span class="badge bg-warning">Pending</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($event->bookings->count() > 5)
                                        <div class="text-center mt-3">
                                            <a href="#" class="text-primary">View all bookings</a>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-muted text-center mb-0">No bookings yet</p>
                                @endif
                            </div>
                        </div>

                        <!-- Recent Reviews -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Recent Reviews</h5>
                                @if ($event->reviews->count() > 0)
                                    @foreach ($event->reviews->take(3) as $review)
                                        <div class="d-flex mb-3">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                        {{ substr($review->user->name ?? 'U', 0, 1) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mt-0 mb-1">{{ $review->user->name ?? 'Anonymous' }}</h6>
                                                <div class="text-warning mb-1">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $review->rating)
                                                            <i class="mdi mdi-star"></i>
                                                        @else
                                                            <i class="mdi mdi-star-outline"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <p class="text-muted mb-0">{{ Str::limit($review->comment, 50) }}</p>
                                                <small
                                                    class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($event->reviews->count() > 3)
                                        <div class="text-center mt-2">
                                            <a href="#" class="text-primary">View all reviews</a>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-muted text-center mb-0">No reviews yet</p>
                                @endif
                            </div>
                        </div>

                        <!-- Event Meta Information -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Event Information</h5>
                                <dl class="row mb-0">
                                    <dt class="col-sm-5">Created By:</dt>
                                    <dd class="col-sm-7">{{ $event->creator->name ?? 'System' }}</dd>

                                    <dt class="col-sm-5">Created At:</dt>
                                    <dd class="col-sm-7">{{ $event->created_at->format('d M Y, h:i A') }}</dd>

                                    <dt class="col-sm-5">Last Updated:</dt>
                                    <dd class="col-sm-7">{{ $event->updated_at->format('d M Y, h:i A') }}</dd>

                                    <dt class="col-sm-5">Event ID:</dt>
                                    <dd class="col-sm-7">#{{ $event->id }}</dd>
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
@endsection

@section('scripts')
    <script src="{{ url('') }}/dist/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ url('') }}/dist/assets/js/app.js"></script>
@endsection
