@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>{{ $venue->name }} | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Venue Details</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.venues.index') }}">Venues</a></li>
                                <li class="breadcrumb-item active">Venue Details</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.venues.edit', $venue->id) }}" class="btn btn-warning">
                                    <i class="mdi mdi-pencil me-2"></i> Edit Venue
                                </a>
                                <a href="{{ route('admin.venues.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ $venue->image ? asset($venue->image) : url('') }}/dist/assets/images/venues/default-venue.jpg"
                                            alt="{{ $venue->name }}" class="img-fluid rounded"
                                            style="width: 100%; height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="card-title mb-3">{{ $venue->name }}</h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-2">
                                                    <i class="mdi mdi-map-marker text-primary me-2"></i>
                                                    <strong>City:</strong> {{ $venue->city }}
                                                </p>
                                                <p class="mb-2">
                                                    <i class="mdi mdi-address text-primary me-2"></i>
                                                    <strong>Address:</strong> {{ $venue->address }}
                                                </p>
                                                <p class="mb-2">
                                                    <i class="mdi mdi-account-group text-primary me-2"></i>
                                                    <strong>Capacity:</strong> {{ number_format($venue->capacity) }} people
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-2">
                                                    <i class="mdi mdi-calendar text-primary me-2"></i>
                                                    <strong>Total Events:</strong> {{ $venue->events->count() }}
                                                </p>
                                                <p class="mb-2">
                                                    <i class="mdi mdi-clock text-primary me-2"></i>
                                                    <strong>Created:</strong> {{ $venue->created_at->format('d M Y') }}
                                                </p>
                                                <p class="mb-2">
                                                    <i class="mdi mdi-update text-primary me-2"></i>
                                                    <strong>Last Updated:</strong>
                                                    {{ $venue->updated_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        </div>

                                        <hr>

                                        <p class="mb-0">
                                            <strong>Status:</strong>
                                            @if ($venue->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($venue->status == 'inactive')
                                                <span class="badge bg-warning">Inactive</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $venue->status }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        @if ($venue->description)
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Description</h5>
                                    <p class="mb-0">{{ $venue->description }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Upcoming Events -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Upcoming Events at this Venue</h5>
                                @if ($venue->events->where('event_date', '>=', now())->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Event</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Tickets</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($venue->events->where('event_date', '>=', now())->sortBy('event_date')->take(5) as $event)
                                                    <tr>
                                                        <td>{{ $event->title }}</td>
                                                        <td>{{ date('d M Y', strtotime($event->event_date)) }}</td>
                                                        <td>{{ $event->start_time }} - {{ $event->end_time }}</td>
                                                        <td>
                                                            <span class="badge bg-info">{{ $event->total_tickets }}</span>
                                                        </td>
                                                        <td>
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
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.events.show', $event->id) }}"
                                                                class="btn btn-sm btn-primary">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($venue->events->where('event_date', '>=', now())->count() > 5)
                                        <div class="text-center mt-3">
                                            <a href="#" class="text-primary">View all events</a>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-muted text-center mb-0">No upcoming events at this venue</p>
                                @endif
                            </div>
                        </div>

                        <!-- Past Events -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Past Events</h5>
                                @if ($venue->events->where('event_date', '<', now())->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Event</th>
                                                    <th>Date</th>
                                                    <th>Total Bookings</th>
                                                    <th>Revenue</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($venue->events->where('event_date', '<', now())->sortByDesc('event_date')->take(5) as $event)
                                                    <tr>
                                                        <td>{{ $event->title }}</td>
                                                        <td>{{ date('d M Y', strtotime($event->event_date)) }}</td>
                                                        <td>{{ $event->bookings->count() }}</td>
                                                        <td>${{ number_format($event->bookings->sum('total_amount') ?? 0, 2) }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.events.show', $event->id) }}"
                                                                class="btn btn-sm btn-info">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted text-center mb-0">No past events at this venue</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Statistics Cards -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Statistics</h5>
                                <div class="mb-4">
                                    <p class="mb-2">Total Events <span
                                            class="float-end">{{ $venue->events->count() }}</span></p>
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-2">Active Events <span
                                            class="float-end">{{ $venue->events->where('status', 1)->count() }}</span></p>
                                    <div class="progress" style="height: 5px;">
                                        @php
                                            $activePercentage =
                                                $venue->events->count() > 0
                                                    ? ($venue->events->where('status', 1)->count() /
                                                            $venue->events->count()) *
                                                        100
                                                    : 0;
                                        @endphp
                                        <div class="progress-bar bg-success" role="progressbar"
                                            style="width: {{ $activePercentage }}%;"></div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-2">Upcoming Events <span
                                            class="float-end">{{ $venue->events->where('event_date', '>=', now())->count() }}</span>
                                    </p>
                                    <div class="progress" style="height: 5px;">
                                        @php
                                            $upcomingPercentage =
                                                $venue->events->count() > 0
                                                    ? ($venue->events->where('event_date', '>=', now())->count() /
                                                            $venue->events->count()) *
                                                        100
                                                    : 0;
                                        @endphp
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $upcomingPercentage }}%;"></div>
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <p class="mb-2">Total Bookings <span
                                            class="float-end">{{ $venue->events->sum(function ($event) {return $event->bookings->count();}) }}</span>
                                    </p>
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Venue Information -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Venue Information</h5>
                                <dl class="row mb-0">
                                    <dt class="col-sm-5">Venue ID:</dt>
                                    <dd class="col-sm-7">#{{ $venue->id }}</dd>

                                    <dt class="col-sm-5">Created By:</dt>
                                    <dd class="col-sm-7">Admin</dd>

                                    <dt class="col-sm-5">Created At:</dt>
                                    <dd class="col-sm-7">{{ $venue->created_at->format('d M Y, h:i A') }}</dd>

                                    <dt class="col-sm-5">Last Updated:</dt>
                                    <dd class="col-sm-7">{{ $venue->updated_at->format('d M Y, h:i A') }}</dd>

                                    @if ($venue->deleted_at)
                                        <dt class="col-sm-5">Deleted At:</dt>
                                        <dd class="col-sm-7">{{ $venue->deleted_at->format('d M Y, h:i A') }}</dd>
                                    @endif
                                </dl>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Quick Actions</h5>
                                <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="mdi mdi-plus me-2"></i> Add Event at this Venue
                                    </a>
                                    <a href="#" class="btn btn-outline-info">
                                        <i class="mdi mdi-calendar me-2"></i> View Schedule
                                    </a>
                                    <a href="#" class="btn btn-outline-secondary">
                                        <i class="mdi mdi-chart-bar me-2"></i> View Analytics
                                    </a>
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
    <script src="{{ url('') }}/dist/assets/js/app.js"></script>
@endsection
