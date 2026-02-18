<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Show payments of logged-in user
    public function index()
    {
        $payments = Payment::whereHas('booking', function ($q) {
            $q->where('user_id', Auth::id());
        })->with('booking.event')->get();

        return view('backend.user.payments.index', compact('payments'));
    }

    // Show single payment
    public function show(Payment $payment)
    {
        $this->authorize('view', $payment);
        return view('backend.user.payments.show', compact('payment'));
    }
}
