<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    // List all bookings
    public function index()
    {
        $bookings = Booking::with(['user', 'event'])->get();
        return view('backend.admin.bookings.index', compact('bookings'));
    }

    // Show single booking
    public function show(Booking $booking)
    {
        $booking->load(['user', 'event']);
        return view('backend.admin.bookings.show', compact('booking'));
    }

    // Edit booking form
    public function edit(Booking $booking)
    {
        return view('backend.admin.bookings.edit', compact('booking'));
    }

    // Update booking
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|string|max:50',
            'payment_status' => 'required|string|max:50',
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully');
    }

    // Delete booking
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully');
    }
}
