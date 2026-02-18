<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Payment;

class DashboardController extends Controller
{
    // Show the admin dashboard
    public function index()
    {
        // Count total users
        $totalUsers = User::count();

        // Count total events
        $totalEvents = Event::count();

        // Count total bookings
        $totalBookings = Booking::count();

        // Count total payments
        $totalPayments = Payment::count();

        // Pass data to admin dashboard view
        return view('backend.admin.dashboard', compact(
            'totalUsers',
            'totalEvents',
            'totalBookings',
            'totalPayments'
        ));
    }
}
