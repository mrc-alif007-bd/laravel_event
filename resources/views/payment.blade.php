<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Complete Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="frontend/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="frontend/css/base.css" rel="stylesheet" type="text/css" />
    <link href="frontend/css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="payment-container"
        style="max-width:500px;margin:50px auto;padding:30px;border-radius:10px;background-color:#1e1e1e;color:#fff;box-shadow:0 0 20px rgba(0,0,0,0.5);font-family:Arial,sans-serif;">
        <h2 style="text-align:center;margin-bottom:25px;color:#f0f0f0;">Complete Your Payment</h2>

        <form method="POST" action="{{ route('payment.complete', ['bookingId' => $booking->id]) }}">
            @csrf

            <div style="margin-bottom:15px;">
                <label for="card-name" style="color:#ccc;">Name on Card</label>
                <input type="text" id="card-name" name="card_name" placeholder="John Doe"
                    style="width:100%;padding:10px;margin-top:5px;border-radius:5px;border:none;background:#2c2c2c;color:#fff;"
                    required>
            </div>

            <div style="margin-bottom:15px;">
                <label for="card-number" style="color:#ccc;">Card Number</label>
                <input type="text" id="card-number" name="card_number" placeholder="4242 4242 4242 4242"
                    style="width:100%;padding:10px;margin-top:5px;border-radius:5px;border:none;background:#2c2c2c;color:#fff;"
                    required>
            </div>

            <div style="display:flex;gap:10px;margin-bottom:15px;">
                <div style="flex:1;">
                    <label for="expiry" style="color:#ccc;">Expiry</label>
                    <input type="text" id="expiry" name="expiry" placeholder="MM/YY"
                        style="width:100%;padding:10px;margin-top:5px;border-radius:5px;border:none;background:#2c2c2c;color:#fff;"
                        required>
                </div>
                <div style="flex:1;">
                    <label for="cvv" style="color:#ccc;">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="123"
                        style="width:100%;padding:10px;margin-top:5px;border-radius:5px;border:none;background:#2c2c2c;color:#fff;"
                        required>
                </div>
            </div>

            <div style="margin-bottom:20px;">
                <label for="amount" style="color:#ccc;">Amount</label>
                <input type="text" id="amount" name="amount" value="{{ $booking->total_amount }}" readonly
                    style="width:100%;padding:10px;margin-top:5px;border-radius:5px;border:none;background:#333;color:#fff;">

                <p>Name: {{ $booking->name }}</p>
                <p>Tickets: {{ $booking->number_of_ticket }}</p>
                <p>Event: {{ $booking->event->title ?? 'N/A' }}</p>
            </div>

            <button type="submit"
                style="width:100%;padding:12px;background:#4cafef;color:#fff;border:none;border-radius:5px;font-size:16px;cursor:pointer;">
                Pay Now
            </button>
        </form>

        <p style="text-align:center;margin-top:15px;font-size:13px;color:#aaa;">
            This is a demo payment form. No actual payment will be processed.
        </p>
    </div>

    <script src="frontend/js/jquery-1.12.4.min.js"></script>
    <script src="frontend/js/script.js"></script>
</body>

</html>
