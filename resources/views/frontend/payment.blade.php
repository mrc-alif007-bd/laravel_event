<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Payment - {{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front_assets/img/favicon.ico') }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('front_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/style.css') }}">
</head>

<body>
    <!-- header -->
    @include('frontend.layouts.header')
    <!-- header-end -->

    <main>
        <!-- breadcrumb-area -->
        <section class="breadcrumb-area d-flex align-items-center"
            style="background-image:url({{ asset('front_assets/img/bg/bdrc-bg.jpg') }})">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12">
                        <div class="breadcrumb-wrap text-center">
                            <div class="breadcrumb-title">
                                <h2>Payment</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Payment</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- payment-area -->
        <section class="payment-area pt-120 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="payment-form-wrapper">
                            <h3>Payment Details</h3>

                            <!-- Dummy Payment Notice -->
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                This is a dummy payment gateway. No real money will be charged.
                            </div>

                            <form action="{{ route('payment.process', $booking->id) }}" method="POST"
                                class="payment-form">
                                @csrf

                                <!-- Payment Method Selection -->
                                <div class="payment-methods mb-30">
                                    <h4>Select Payment Method</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="credit_card" value="credit_card" checked>
                                        <label class="form-check-label" for="credit_card">
                                            <i class="fab fa-cc-visa"></i>
                                            <i class="fab fa-cc-mastercard"></i>
                                            Credit / Debit Card
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="paypal" value="paypal">
                                        <label class="form-check-label" for="paypal">
                                            <i class="fab fa-paypal"></i>
                                            PayPal
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="cash" value="cash">
                                        <label class="form-check-label" for="cash">
                                            <i class="fas fa-money-bill"></i>
                                            Cash on Arrival
                                        </label>
                                    </div>
                                </div>

                                <!-- Credit Card Details (shown by default) -->
                                <div id="card-details" class="card-details">
                                    <div class="row">
                                        <div class="col-md-12 mb-20">
                                            <label>Card Number</label>
                                            <input type="text" name="card_number" class="form-control"
                                                placeholder="4242 4242 4242 4242" value="4242424242424242">
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <label>Cardholder Name</label>
                                            <input type="text" name="card_name" class="form-control"
                                                placeholder="John Doe" value="John Doe">
                                        </div>
                                        <div class="col-md-3 mb-20">
                                            <label>Expiry Date</label>
                                            <input type="text" name="card_expiry" class="form-control"
                                                placeholder="MM/YY" value="12/25">
                                        </div>
                                        <div class="col-md-3 mb-20">
                                            <label>CVV</label>
                                            <input type="text" name="card_cvv" class="form-control"
                                                placeholder="123" value="123">
                                        </div>
                                    </div>
                                </div>

                                <!-- PayPal Info -->
                                <div id="paypal-info" class="paypal-info" style="display: none;">
                                    <p>You will be redirected to PayPal to complete your payment.</p>
                                </div>

                                <!-- Cash Info -->
                                <div id="cash-info" class="cash-info" style="display: none;">
                                    <p>Please pay the amount at the venue on the day of the event.</p>
                                </div>

                                <button type="submit" class="btn active mt-30">
                                    <span>Pay ${{ number_format($booking->final_amount, 2) }}</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="booking-summary">
                            <h4>Booking Summary</h4>
                            <div class="summary-details">
                                <p><strong>Event:</strong> {{ $booking->event->title }}</p>
                                <p><strong>Date:</strong> {{ $booking->event->event_date->format('M d, Y') }}</p>
                                <p><strong>Tickets:</strong> {{ $booking->number_of_tickets }}</p>
                                <p><strong>Ticket Price:</strong> ${{ number_format($booking->ticket_price, 2) }}</p>
                                <hr>
                                <p><strong>Total:</strong> ${{ number_format($booking->total_amount, 2) }}</p>
                                @if ($booking->discount_amount > 0)
                                    <p><strong>Discount:</strong> -${{ number_format($booking->discount_amount, 2) }}
                                    </p>
                                    <p class="total-amount"><strong>Final Amount:</strong>
                                        ${{ number_format($booking->final_amount, 2) }}</p>
                                @endif
                                <p><strong>Booking Code:</strong> {{ $booking->booking_code }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- payment-area-end -->
    </main>

    <!-- footer -->
    @include('frontend.layouts.footer')
    <!-- footer-end -->

    <!-- JS here -->
    <script src="{{ asset('front_assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Toggle payment method details
            $('input[name="payment_method"]').change(function() {
                var method = $(this).val();

                $('#card-details, #paypal-info, #cash-info').hide();

                if (method === 'credit_card') {
                    $('#card-details').show();
                } else if (method === 'paypal') {
                    $('#paypal-info').show();
                } else if (method === 'cash') {
                    $('#cash-info').show();
                }
            });
        });
    </script>
</body>

</html>
