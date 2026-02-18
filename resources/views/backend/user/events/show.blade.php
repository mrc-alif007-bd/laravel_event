@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>{{ $event->title }} | {{ config('app.name') }}</title>
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
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Event Details</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('user.events.index') }}">Events</a></li>
                                    <li class="breadcrumb-item active">Event Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $event->title }}</h4>
                                <p class="card-title-desc">Detailed information about this event.</p>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-check-all me-2"></i>
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-block-helper me-2"></i>
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="mb-4">
                                            <div class="text-center mb-4">
                                                @if ($event->image)
                                                    <img src="{{ asset('storage/' . $event->image) }}"
                                                        alt="{{ $event->title }}" class="img-fluid rounded"
                                                        style="max-height: 400px; width: 100%; object-fit: cover;">
                                                @else
                                                    <div class="bg-light p-5 rounded">
                                                        <i class="bx bx-image font-size-48 text-muted"></i>
                                                        <p class="text-muted mt-2">No image available</p>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <h5 class="font-size-15 mb-2">Category</h5>
                                                        @if ($event->category)
                                                            <span
                                                                class="badge bg-primary">{{ $event->category->name }}</span>
                                                        @else
                                                            <span class="badge bg-secondary">Uncategorized</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <h5 class="font-size-15 mb-2">Status</h5>
                                                        @if ($event->status == 1)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-secondary">Inactive</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <h5 class="font-size-15 mb-2">Date</h5>
                                                        <p class="text-muted">
                                                            <i class="bx bx-calendar me-1"></i>
                                                            {{ \Carbon\Carbon::parse($event->start_date)->format('l, F j, Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <h5 class="font-size-15 mb-2">Time</h5>
                                                        <p class="text-muted">
                                                            <i class="bx bx-time me-1"></i>
                                                            {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <h5 class="font-size-15 mb-2">Price</h5>
                                                        @if ($event->is_free)
                                                            <span class="badge bg-success">Free Entry</span>
                                                        @else
                                                            <p class="text-primary fw-bold">
                                                                ${{ number_format($event->price, 2) }} per ticket</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <h5 class="font-size-15 mb-2">Available Seats</h5>
                                                        @if ($event->available_seats > 0)
                                                            <span class="badge bg-success">{{ $event->available_seats }}
                                                                seats available</span>
                                                        @else
                                                            <span class="badge bg-danger">Sold Out</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($event->venue)
                                                <div class="mb-4">
                                                    <h5 class="font-size-15 mb-2">Venue</h5>
                                                    <div class="p-3 border rounded">
                                                        <h6 class="font-size-14 mb-2">{{ $event->venue->name }}</h6>
                                                        <p class="text-muted mb-1">
                                                            <i class="bx bx-map me-1"></i>
                                                            {{ $event->venue->address }}, {{ $event->venue->city }},
                                                            {{ $event->venue->country }} {{ $event->venue->postal_code }}
                                                        </p>
                                                        @if ($event->venue->phone)
                                                            <p class="text-muted mb-1">
                                                                <i class="bx bx-phone me-1"></i>
                                                                {{ $event->venue->phone }}
                                                            </p>
                                                        @endif
                                                        @if ($event->venue->email)
                                                            <p class="text-muted mb-1">
                                                                <i class="bx bx-envelope me-1"></i>
                                                                {{ $event->venue->email }}
                                                            </p>
                                                        @endif
                                                        @if ($event->venue->website)
                                                            <p class="text-muted mb-0">
                                                                <i class="bx bx-globe me-1"></i>
                                                                <a href="{{ $event->venue->website }}"
                                                                    target="_blank">{{ $event->venue->website }}</a>
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="mb-4">
                                                <h5 class="font-size-15 mb-2">Description</h5>
                                                <div class="p-3 border rounded">
                                                    <p class="text-muted mb-0">{{ $event->description }}</p>
                                                </div>
                                            </div>

                                            @if ($event->additional_info)
                                                <div class="mb-4">
                                                    <h5 class="font-size-15 mb-2">Additional Information</h5>
                                                    <div class="p-3 border rounded">
                                                        <p class="text-muted mb-0">{{ $event->additional_info }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Reviews Section -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">Reviews ({{ $event->reviews->count() }})</h4>
                                            </div>
                                            <div class="card-body">
                                                @if ($event->reviews && $event->reviews->count() > 0)
                                                    @foreach ($event->reviews as $review)
                                                        <div class="d-flex border-bottom pb-3 mb-3">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title bg-primary rounded-circle font-size-16">
                                                                        {{ substr($review->user->name ?? 'U', 0, 1) }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="font-size-14 mb-1">
                                                                    {{ $review->user->name ?? 'Anonymous' }}</h5>
                                                                <div class="mb-2">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $review->rating)
                                                                            <i class="bx bxs-star text-warning"></i>
                                                                        @else
                                                                            <i class="bx bx-star text-warning"></i>
                                                                        @endif
                                                                    @endfor
                                                                    <span
                                                                        class="text-muted ms-2">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                                                </div>
                                                                <p class="text-muted">{{ $review->comment }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="text-center py-4">
                                                        <i class="bx bx-message-square-dots font-size-40 text-muted"></i>
                                                        <p class="text-muted mt-2">No reviews yet.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <!-- Booking Card -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">Book This Event</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span>Ticket Price:</span>
                                                        <span class="fw-bold">
                                                            @if ($event->is_free)
                                                                Free
                                                            @else
                                                                ${{ number_format($event->price, 2) }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span>Available Seats:</span>
                                                        <span
                                                            class="fw-bold {{ $event->available_seats > 0 ? 'text-success' : 'text-danger' }}">
                                                            {{ $event->available_seats }}
                                                        </span>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span>Booking Fee:</span>
                                                        <span class="fw-bold">Free</span>
                                                    </div>
                                                    <hr>
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span class="fw-bold">Total:</span>
                                                        <span class="fw-bold text-primary">
                                                            @if ($event->is_free)
                                                                Free
                                                            @else
                                                                ${{ number_format($event->price, 2) }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>

                                                @if ($event->available_seats > 0)
                                                    <button type="button" class="btn btn-primary btn-lg w-100"
                                                        onclick="bookEvent({{ $event->id }}, '{{ $event->title }}', {{ $event->price }}, {{ $event->is_free ? 'true' : 'false' }})">
                                                        <i class="bx bx-ticket me-2"></i> Book Now
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-secondary btn-lg w-100"
                                                        disabled>
                                                        <i class="bx bx-x-circle me-2"></i> Sold Out
                                                    </button>
                                                @endif

                                                <div class="mt-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="save_info">
                                                        <label class="form-check-label" for="save_info">
                                                            Save this information for next time
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Share Event -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">Share Event</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex gap-2">
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                                        target="_blank" class="btn btn-outline-primary btn-sm">
                                                        <i class="bx bxl-facebook"></i>
                                                    </a>
                                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($event->title) }}"
                                                        target="_blank" class="btn btn-outline-info btn-sm">
                                                        <i class="bx bxl-twitter"></i>
                                                    </a>
                                                    <a href="https://wa.me/?text={{ urlencode($event->title . ' - ' . request()->url()) }}"
                                                        target="_blank" class="btn btn-outline-success btn-sm">
                                                        <i class="bx bxl-whatsapp"></i>
                                                    </a>
                                                    <a href="mailto:?subject={{ urlencode($event->title) }}&body={{ urlencode('Check out this event: ' . request()->url()) }}"
                                                        class="btn btn-outline-danger btn-sm">
                                                        <i class="bx bx-envelope"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Back Button -->
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="{{ route('user.events.index') }}"
                                                    class="btn btn-secondary w-100">
                                                    <i class="bx bx-arrow-back me-2"></i> Back to Events
                                                </a>
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
    </div>

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Book Event: {{ $event->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.bookings.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="event_id" id="modal_event_id" value="{{ $event->id }}">
                        <div class="mb-3">
                            <label class="form-label">Event</label>
                            <input type="text" class="form-control" id="modal_event_title"
                                value="{{ $event->title }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="number_of_tickets" class="form-label">Number of Tickets</label>
                            <input type="number" class="form-control" id="number_of_tickets" name="number_of_tickets"
                                min="1" max="{{ min(10, $event->available_seats) }}" value="1" required>
                            <small class="text-muted">Maximum {{ min(10, $event->available_seats) }} tickets per
                                booking</small>
                        </div>
                        <div class="mb-3" id="price_section"
                            @if ($event->is_free) style="display: none;" @endif>
                            <label class="form-label">Total Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" id="total_price"
                                    value="{{ number_format($event->price, 2) }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#">terms and conditions</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm Booking</button>
                    </div>
                </form>
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

    <script>
        function bookEvent(eventId, eventTitle, price, isFree) {
            $('#modal_event_id').val(eventId);
            $('#modal_event_title').val(eventTitle);

            if (isFree) {
                $('#price_section').hide();
                $('#total_price').val('0.00');
            } else {
                $('#price_section').show();
                let tickets = $('#number_of_tickets').val();
                let total = tickets * price;
                $('#total_price').val(total.toFixed(2));
            }

            $('#bookingModal').modal('show');
        }

        $('#number_of_tickets').on('input', function() {
            let price = {{ $event->price ?? 0 }};
            let isFree = {{ $event->is_free ? 'true' : 'false' }};

            if (!isFree) {
                let tickets = $(this).val();
                let total = tickets * price;
                $('#total_price').val(total.toFixed(2));
            }
        });
    </script>
@endsection
