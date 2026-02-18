<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Show bookings of logged-in user
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('event')->get();
        return view('backend.user.bookings.index', compact('bookings'));
    }

    // Show single booking
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking); // Ensure user owns booking
        return view('backend.user.bookings.show', compact('booking'));
    }

    // Create booking form
    public function create()
    {
        // Users will select event in frontend
        return view('backend.user.bookings.create');
    }

    // Store new booking
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'number_of_tickets' => 'required|integer|min:1',
        ]);

        $validated['user_id'] = Auth::id();
        $booking = Booking::create($validated);

        return redirect()->route('user.bookings.index')
            ->with('success', 'Booking created successfully');
    }
}
