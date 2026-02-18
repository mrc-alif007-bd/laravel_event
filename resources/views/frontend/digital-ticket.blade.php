<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Digital Ticket - {{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front_assets/img/favicon.ico') }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('front_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/style.css') }}">

    <style>
        .ticket-wrapper {
            max-width: 800px;
            margin: 50px auto;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 5px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .ticket-inner {
            background: white;
            border-radius: 18px;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .ticket-inner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 10px;
            background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);
        }

        .ticket-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px dashed #e0e0e0;
        }

        .ticket-header h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 10px;
        }

        .ticket-header .event-date {
            color: #666;
            font-size: 18px;
        }

        .ticket-body {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .ticket-info {
            flex: 2;
            padding-right: 30px;
        }

        .ticket-qr {
            flex: 1;
            text-align: center;
            border-left: 2px dashed #e0e0e0;
            padding-left: 30px;
        }

        .ticket-qr .qr-code {
            width: 150px;
            height: 150px;
            background: #f8f9fa;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .ticket-qr .qr-code i {
            font-size: 80px;
            color: #667eea;
        }

        .info-row {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-label {
            width: 140px;
            font-weight: 600;
            color: #555;
        }

        .info-value {
            flex: 1;
            color: #333;
        }

        .ticket-footer {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }

        .ticket-footer .terms {
            font-size: 14px;
            color: #888;
            margin-bottom: 10px;
        }

        .ticket-footer .booking-code {
            font-size: 20px;
            font-weight: bold;
            color: #667eea;
            letter-spacing: 2px;
        }

        .payment-slip {
            margin-top: 30px;
            background: #fff9e6;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #ffeeba;
        }

        .payment-slip h4 {
            color: #856404;
            margin-bottom: 15px;
        }

        .action-buttons {
            text-align: center;
            margin-top: 30px;
        }

        .btn-download {
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
            transition: all 0.3s;
        }

        .btn-download:hover {
            background: #5a67d8;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-print {
            background: #48bb78;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
            transition: all 0.3s;
        }

        .btn-print:hover {
            background: #38a169;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(72, 187, 120, 0.4);
        }

        @media print {
            .no-print {
                display: none !important;
            }

            .ticket-wrapper {
                box-shadow: none;
                padding: 0;
            }

            .ticket-inner {
                border: 1px solid #ddd;
            }
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-confirmed {
            background: #c6f6d5;
            color: #22543d;
        }

        .status-pending {
            background: #feebc8;
            color: #7b341e;
        }
    </style>
</head>

<body>
    <!-- header -->
    @include('frontend.layouts.header')
    <!-- header-end -->

    <main>
        <div class="container">
            <div class="ticket-wrapper">
                <div class="ticket-inner">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="ticket-header">
                        <h1><i class="fas fa-ticket-alt"></i> Digital Ticket</h1>
                        <div class="event-date">
                            <i class="far fa-calendar-alt"></i> {{ $booking->event->event_date->format('l, F d, Y') }}
                        </div>
                    </div>

                    <div class="ticket-body">
                        <div class="ticket-info">
                            <div class="info-row">
                                <div class="info-label">Event Name:</div>
                                <div class="info-value">{{ $booking->event->title }}</div>
                            </div>

                            <div class="info-row">
                                <div class="info-label">Venue:</div>
                                <div class="info-value">{{ $booking->event->venue->name ?? 'TBD' }}</div>
                            </div>

                            <div class="info-row">
                                <div class="info-label">Date & Time:</div>
                                <div class="info-value">
                                    {{ $booking->event->event_date->format('M d, Y') }}<br>
                                    {{ $booking->event->start_time->format('h:i A') }} -
                                    {{ $booking->event->end_time->format('h:i A') }}
                                </div>
                            </div>

                            <div class="info-row">
                                <div class="info-label">Attendee:</div>
                                <div class="info-value">{{ auth()->user()->name ?? 'Guest' }}</div>
                            </div>

                            <div class="info-row">
                                <div class="info-label">Number of Tickets:</div>
                                <div class="info-value">{{ $booking->number_of_tickets }}</div>
                            </div>

                            <div class="info-row">
                                <div class="info-label">Status:</div>
                                <div class="info-value">
                                    <span class="status-badge status-{{ $booking->status }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="ticket-qr">
                            <div class="qr-code">
                                <i class="fas fa-qrcode"></i>
                            </div>
                            <div class="booking-code">{{ $booking->booking_code }}</div>
                            <small>Scan at entrance</small>
                        </div>
                    </div>

                    <!-- Payment Slip -->
                    <div class="payment-slip">
                        <h4><i class="fas fa-receipt"></i> Payment Slip</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Transaction ID:</strong>
                                    {{ $booking->payments->first()->transaction_id ?? 'N/A' }}</p>
                                <p><strong>Payment Method:</strong>
                                    {{ ucfirst(str_replace('_', ' ', $booking->payments->first()->method ?? 'N/A')) }}
                                </p>
                                <p><strong>Payment Date:</strong>
                                    {{ $booking->payments->first()->paid_at ? $booking->payments->first()->paid_at->format('M d, Y h:i A') : 'N/A' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Ticket Price:</strong> ${{ number_format($booking->ticket_price, 2) }} x
                                    {{ $booking->number_of_tickets }}</p>
                                <p><strong>Subtotal:</strong> ${{ number_format($booking->total_amount, 2) }}</p>
                                @if ($booking->discount_amount > 0)
                                    <p><strong>Discount:</strong> -${{ number_format($booking->discount_amount, 2) }}
                                    </p>
                                @endif
                                <p><strong>Total Paid:</strong> ${{ number_format($booking->final_amount, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="ticket-footer">
                        <div class="terms">
                            <i class="fas fa-info-circle"></i> This ticket is valid for one-time entry. Please present
                            this digital ticket at the entrance.
                        </div>
                        <div class="booking-code">
                            {{ $booking->booking_code }}
                        </div>
                    </div>

                    <div class="action-buttons no-print">
                        <a href="#" onclick="window.print()" class="btn-print">
                            <i class="fas fa-print"></i> Print Ticket
                        </a>
                        <a href="{{ route('ticket.download', $booking->id) }}" class="btn-download">
                            <i class="fas fa-download"></i> Download PDF
                        </a>
                        <a href="{{ route('events.index') }}" class="btn-download" style="background: #4a5568;">
                            <i class="fas fa-calendar-alt"></i> Browse More Events
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- footer -->
    @include('frontend.layouts.footer')
    <!-- footer-end -->

    <!-- JS here -->
    <script src="{{ asset('front_assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/bootstrap.min.js') }}"></script>

    <script>
        // Auto-hide alert after 5 seconds
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
</body>

</html>
