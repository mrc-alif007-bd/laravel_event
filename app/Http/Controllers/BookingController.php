<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Add middleware to require authentication for all booking methods
     */
    public function __construct()
    {
        // This ensures user must be logged in for all methods except any you specify
        $this->middleware('auth:web')->except([]);
        // Or if you want to allow guests to view tickets but not book:
        // $this->middleware('auth:web')->only(['store', 'paymentPage', 'processDummyPayment']);
    }

    public function store(Request $request, $id)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect()->route('user.login')
                ->with('error', 'Please login to book tickets.');
        }

        $event = Event::findOrFail($id);

        // Validate booking
        $request->validate([
            'number_of_tickets' => 'required|integer|min:1|max:' . $event->available_tickets,
            'coupon_code' => 'nullable|string|exists:coupons,code',
        ]);

        // Calculate pricing
        $ticket_price = $event->price;
        $number_of_tickets = $request->number_of_tickets;
        $total_amount = $ticket_price * $number_of_tickets;
        $discount_amount = 0;
        $final_amount = $total_amount;

        // Apply coupon if provided
        if ($request->coupon_code) {
            $coupon = Coupon::where('code', $request->coupon_code)
                ->where(function ($query) {
                    $query->where('expires_at', '>', now())
                        ->orWhereNull('expires_at');
                })
                ->first();

            if ($coupon) {
                if ($coupon->discount_type === 'percentage') {
                    $discount_amount = ($total_amount * $coupon->value) / 100;
                } else {
                    $discount_amount = $coupon->value;
                }
                $final_amount = max(0, $total_amount - $discount_amount);
            }
        }

        // Generate unique booking code
        $booking_code = 'BOK-' . strtoupper(Str::random(8));

        // Create booking
        $booking = Booking::create([
            'booking_code' => $booking_code,
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'number_of_tickets' => $number_of_tickets,
            'ticket_price' => $ticket_price,
            'discount_amount' => $discount_amount,
            'total_amount' => $total_amount,
            'final_amount' => $final_amount,
            'status' => 'pending',
        ]);

        // Update available tickets
        $event->available_tickets -= $number_of_tickets;
        $event->save();

        // If it's a paid event, redirect to dummy payment page
        if ($event->is_paid && $final_amount > 0) {
            return redirect()->route('payment.page', $booking->id);
        }

        // For free events, confirm booking directly
        $booking->update(['status' => 'confirmed']);

        return redirect()->route('booking.ticket', $booking->id)
            ->with('success', 'Booking confirmed successfully!');
    }

    public function paymentPage($bookingId)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect()->route('user.login')
                ->with('error', 'Please login to continue with payment.');
        }

        $booking = Booking::with('event')->findOrFail($bookingId);

        // Optional: Ensure the booking belongs to the logged-in user
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this booking.');
        }

        return view('frontend.payment', compact('booking'));
    }

    public function processDummyPayment(Request $request, $bookingId)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect()->route('user.login')
                ->with('error', 'Please login to process payment.');
        }

        $booking = Booking::with('event')->findOrFail($bookingId);

        // Optional: Ensure the booking belongs to the logged-in user
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this booking.');
        }

        // Validate payment method
        $request->validate([
            'payment_method' => 'required|in:credit_card,paypal,cash',
            'card_number' => 'required_if:payment_method,credit_card|nullable|string|size:16',
            'card_name' => 'required_if:payment_method,credit_card|nullable|string',
            'card_expiry' => 'required_if:payment_method,credit_card|nullable|string',
            'card_cvv' => 'required_if:payment_method,credit_card|nullable|string|size:3',
        ]);

        // Simulate payment processing
        $transaction_id = 'TXN-' . strtoupper(Str::random(12));

        // Create payment record
        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->final_amount,
            'method' => $request->payment_method,
            'transaction_id' => $transaction_id,
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        // Update booking status
        $booking->update(['status' => 'confirmed']);

        // Redirect to digital ticket page
        return redirect()->route('booking.ticket', $booking->id)
            ->with('success', 'Payment successful! Your booking is confirmed.');
    }

    public function showDigitalTicket($bookingId)
    {
        // Optional: Allow viewing tickets without login (with verification)
        $booking = Booking::with(['event', 'payments'])->findOrFail($bookingId);

        // If you want to protect ticket viewing:
        if (auth()->check() && $booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this ticket.');
        }

        // Or allow anyone with the direct link (more convenient for users)

        return view('frontend.digital-ticket', compact('booking'));
    }

    // Optional: Download PDF ticket
    public function downloadTicket($bookingId)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect()->route('user.login')
                ->with('error', 'Please login to download your ticket.');
        }

        $booking = Booking::with(['event', 'payments'])->findOrFail($bookingId);

        // Ensure the booking belongs to the logged-in user
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this ticket.');
        }

        // $pdf = Pdf::loadView('frontend.ticket-pdf', compact('booking'));
        // return $pdf->download('ticket-' . $booking->booking_code . '.pdf');
    }
}
