<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Show user dashboard
    public function index()
    {
        $user = Auth::user();

        // Count total bookings by this user
        $totalBookings = Booking::where('user_id', $user->id)->count();

        // Count total payments by this user
        $totalPayments = Payment::whereHas('booking', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();

        // Fetch latest 5 bookings for quick view
        $latestBookings = Booking::where('user_id', $user->id)
            ->with('event')
            ->latest()
            ->take(5)
            ->get();

        return view('backend.user.dashboard', compact(
            'user',
            'totalBookings',
            'totalPayments',
            'latestBookings'
        ));
    }
}
