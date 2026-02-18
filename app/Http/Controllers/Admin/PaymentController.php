<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    // List all payments
    public function index()
    {
        $payments = Payment::with('booking.user', 'booking.event')->get();
        return view('backend.admin.payments.index', compact('payments'));
    }

    // Show single payment
    public function show(Payment $payment)
    {
        $payment->load('booking.user', 'booking.event');
        return view('backend.admin.payments.show', compact('payment'));
    }

    // Update payment status
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|string|max:50',
        ]);

        $payment->update($validated);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment updated successfully');
    }

    // Delete payment
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment deleted successfully');
    }
}
