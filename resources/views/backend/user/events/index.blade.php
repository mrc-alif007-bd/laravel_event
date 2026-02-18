@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Events | {{ config('app.name') }}</title>
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

        <!-- DataTables -->
        <link href="{{ asset('dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css">
        <link href="{{ asset('dist/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
            rel="stylesheet" type="text/css">
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
                            <h4 class="mb-sm-0 font-size-18">Events</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Events</li>
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
                                <h4 class="card-title">Upcoming Events</h4>
                                <p class="card-title-desc">Browse through all upcoming events and find your next experience.
                                </p>
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

                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Event</th>
                                            <th>Category</th>
                                            <th>Venue</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Price</th>
                                            <th>Available Seats</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($events as $event)
                                            <tr>
                                                <td>{{ $event->id }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if ($event->image)
                                                            <div class="flex-shrink-0 me-3">
                                                                <img src="{{ asset('storage/' . $event->image) }}"
                                                                    alt="{{ $event->title }}"
                                                                    class="avatar-sm rounded-circle">
                                                            </div>
                                                        @endif
                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-14 mb-1">{{ $event->title }}</h5>
                                                            <p class="text-muted mb-0">
                                                                {{ Str::limit($event->description, 50) }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($event->category)
                                                        <span class="badge bg-primary">{{ $event->category->name }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">Uncategorized</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($event->venue)
                                                        <h5 class="font-size-14 mb-1">{{ $event->venue->name }}</h5>
                                                        <p class="text-muted mb-0">{{ $event->venue->city }}</p>
                                                    @else
                                                        <span class="text-muted">No venue</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</td>
                                                <td>
                                                    @if ($event->is_free)
                                                        <span class="badge bg-success">Free</span>
                                                    @else
                                                        ${{ number_format($event->price, 2) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($event->available_seats > 0)
                                                        <span class="badge bg-success">{{ $event->available_seats }}</span>
                                                    @else
                                                        <span class="badge bg-danger">Sold Out</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($event->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('user.events.show', $event->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="bx bx-show"></i> View
                                                        </a>
                                                        @if ($event->available_seats > 0)
                                                            <button type="button" class="btn btn-sm btn-success"
                                                                onclick="bookEvent({{ $event->id }}, '{{ $event->title }}', {{ $event->price }}, {{ $event->is_free ? 'true' : 'false' }})">
                                                                <i class="bx bx-ticket"></i> Book
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No events found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
                    <h5 class="modal-title" id="bookingModalLabel">Book Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.bookings.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="event_id" id="modal_event_id">
                        <div class="mb-3">
                            <label class="form-label">Event</label>
                            <input type="text" class="form-control" id="modal_event_title" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="number_of_tickets" class="form-label">Number of Tickets</label>
                            <input type="number" class="form-control" id="number_of_tickets" name="number_of_tickets"
                                min="1" max="10" value="1" required>
                        </div>
                        <div class="mb-3" id="price_section">
                            <label class="form-label">Total Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" id="total_price" readonly>
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

    <!-- DataTables -->
    <script src="{{ asset('dist/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('dist/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                pageLength: 10,
                order: [
                    [4, 'asc']
                ], // Sort by date
                language: {
                    search: "Search:",
                    searchPlaceholder: "Search events..."
                }
            });
        });

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
            let eventId = $('#modal_event_id').val();
            let events = @json($events);
            let event = events.find(e => e.id == eventId);

            if (event && !event.is_free) {
                let tickets = $(this).val();
                let total = tickets * event.price;
                $('#total_price').val(total.toFixed(2));
            }
        });
    </script>
@endsection
