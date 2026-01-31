<div class="booking-details"
    style="max-width:600px;margin:40px auto;padding:20px;background:#f9f9f9;border-radius:8px;font-family:Arial,sans-serif;color:#333;">
    <h2 style="text-align:center;margin-bottom:20px;">Booking Receipt</h2>

    <p><strong>Name:</strong> {{ $booking->name ?? 'N/A' }}</p>
    <p><strong>Email:</strong> {{ $booking->email ?? 'N/A' }}</p>
    <p><strong>Event:</strong> {{ $booking->event->title ?? 'N/A' }}</p>
    <p><strong>Tickets:</strong> {{ $booking->number_of_ticket ?? 0 }}</p>
    <p><strong>Total Paid:</strong> ${{ number_format($booking->total_amount ?? 0, 2) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($booking->payment_status ?? 'pending') }}</p>
    <p><strong>Transaction ID:</strong> {{ $booking->transaction_id ?? 'N/A' }}</p>
</div>
