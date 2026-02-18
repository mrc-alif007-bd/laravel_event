<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Events - {{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front_assets/img/favicon.ico') }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('front_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/fontawesome-pro/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/dripicons.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/responsive.css') }}">
</head>

<body>
    <!-- header -->
    @include('frontend.layouts.header')
    <!-- header-end -->

    <!-- main-area -->
    <main>
        <!-- breadcrumb-area -->
        <section class="breadcrumb-area d-flex align-items-center"
            style="background-image:url({{ asset('front_assets/img/bg/bdrc-bg.jpg') }})">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12">
                        <div class="breadcrumb-wrap text-center">
                            <div class="breadcrumb-title">
                                <h2>Our Events</h2>
                                <div class="breadcrumb-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Events</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- events-area-->
        <section id="services" class="services-area pt-120 pb-90">
            <div class="container">
                <div class="row">
                    @forelse($events as $event)
                        <div class="col-xl-4 col-md-6">
                            <div class="single-services ser-m mb-30">
                                @php
                                    $imagePath =
                                        $event->image && file_exists(public_path('storage/' . $event->image))
                                            ? asset('storage/' . $event->image)
                                            : asset('dist/assets/images/events/default-event.jpg');
                                @endphp

                                <div class="services-thumb">
                                    <a class="gallery-link popup-image" href="{{ $imagePath }}">
                                        <img src="{{ $imagePath }}" alt="{{ $event->title }}">
                                    </a>
                                    @if ($event->category)
                                        <span class="event-category">{{ $event->category->name }}</span>
                                    @endif
                                </div>

                                <div class="services-content text-center">
                                    <h4><a href="{{ route('events.show', $event->id) }}">{{ $event->title }}</a></h4>
                                    <p>{{ Str::limit($event->description, 100) }}</p>

                                    <div class="event-details mt-15">
                                        <p><i class="fas fa-calendar"></i> {{ $event->event_date->format('M d, Y') }}
                                        </p>
                                        <p><i class="fas fa-clock"></i> {{ $event->start_time->format('H:i') }} -
                                            {{ $event->end_time->format('H:i') }}</p>
                                        @if ($event->venue)
                                            <p><i class="fas fa-map-marker-alt"></i> {{ $event->venue->name }}</p>
                                        @endif
                                    </div>

                                    <div class="day-book">
                                        <ul>
                                            <li>
                                                @if ($event->is_paid)
                                                    ${{ number_format($event->price, 2) }}
                                                @else
                                                    Free
                                                @endif
                                            </li>
                                            <li>
                                                <a href="#" class="book-now-btn"
                                                    onclick="event.preventDefault(); openBookingModal({{ $event->id }}, '{{ $event->title }}', {{ $event->price }}, {{ $event->available_tickets }})">
                                                    Book Now
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="ticket-info mt-10">
                                        <small>{{ $event->available_tickets }} tickets available</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <h3>No events found</h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        <!-- events-area-end -->

        <!-- booking-area -->
        <section class="booking pb-120 p-relative fix">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="booking-img">
                            <img src="{{ asset('front_assets/img/bg/booking-img.png') }}" alt="img">
                            <div class="text">
                                <h3>Seasonal or <span>Citywide Events</span></h3>
                                <p>What big annual or seasonal events are can't-miss?</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="contact-bg02 pl-40 pr-30">
                            <div class="section-title center-align">
                                <h2>Book Your <span>Seat</span></h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Booking Modal -->
        <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel">Book Tickets</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="bookingForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 id="modalEventTitle"></h6>
                                    <p>Price per ticket: $<span id="modalTicketPrice">0</span></p>
                                    <p>Available tickets: <span id="modalAvailableTickets">0</span></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="number_of_tickets">Number of Tickets</label>
                                        <input type="number" class="form-control" id="number_of_tickets"
                                            name="number_of_tickets" min="1" value="1" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="coupon_code">Coupon Code (Optional)</label>
                                        <input type="text" class="form-control" id="coupon_code"
                                            name="coupon_code">
                                    </div>
                                    <div class="total-price mt-3">
                                        <h5>Total: $<span id="totalPrice">0</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn active">Proceed to Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function openBookingModal(eventId, eventTitle, price, availableTickets) {
                $('#modalEventTitle').text(eventTitle);
                $('#modalTicketPrice').text(price);
                $('#modalAvailableTickets').text(availableTickets);
                $('#totalPrice').text(price);
                $('#number_of_tickets').attr('max', availableTickets);

                // Set form action
                $('#bookingForm').attr('action', '/event/book/' + eventId);

                $('#bookingModal').modal('show');
            }

            // Calculate total price when ticket quantity changes
            $('#number_of_tickets').on('input', function() {
                var tickets = $(this).val();
                var price = $('#modalTicketPrice').text();
                var total = tickets * price;
                $('#totalPrice').text(total);
            });

            // Apply coupon via AJAX (optional)
            $('#coupon_code').on('blur', function() {
                var coupon = $(this).val();
                var tickets = $('#number_of_tickets').val();
                var price = $('#modalTicketPrice').text();

                if (coupon.length > 0) {
                    $.ajax({
                        url: '/validate-coupon',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            code: coupon,
                            total: tickets * price
                        },
                        success: function(response) {
                            if (response.valid) {
                                $('#totalPrice').text(response.discounted_total);
                            }
                        }
                    });
                }
            });
        </script>
        <!-- booking-area-end -->
    </main>
    <!-- main-area-end -->

    <!-- footer -->
    @include('frontend.layouts.footer')
    <!-- footer-end -->

    <!-- JS here -->
    <script src="{{ asset('front_assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('front_assets/js/paroller.js') }}"></script>
    <script src="{{ asset('front_assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/js_isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/parallax.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/parallax-scroll.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/element-in-view.js') }}"></script>
    <script src="{{ asset('front_assets/js/main.js') }}"></script>
</body>

</html>
