<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Show the payment page for a specific booking.
     */
    public function show($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        return view('payment', compact('booking'));
    }

    /**
     * Complete the payment and update booking.
     */
    public function complete(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Validate demo payment info
        $request->validate([
            'card_name'   => 'required|string|max:255',
            'card_number' => 'required|string|max:20',
            'expiry'      => 'required|string|max:5',
            'cvv'         => 'required|string|max:4',
        ]);

        // Simulate a successful payment
        $booking->payment_method  = 'demo_card';
        $booking->payment_status  = 'paid';
        $booking->transaction_id  = strtoupper(Str::random(10));
        $booking->status          = 'confirmed';
        $booking->save();

        // Redirect to invoice page
        return redirect()->route('invoice', ['bookingId' => $booking->id]);
    }
}
