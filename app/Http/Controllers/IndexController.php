<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('frontend.index', compact('events'));
    }
     public function about()
    {
        $events = Event::all();
        return view('frontend.about', compact('events'));
    }
     public function venue()
    {
        $events = Event::all();
        return view('frontend.venue', compact('events'));
    }
     public function contact()
    {
        $events = Event::all();
        return view('frontend.contact', compact('events'));
    }
     public function services()
    {
        $events = Event::all();
        return view('frontend.services', compact('events'));
    }
     public function blog()
    {
        $events = Event::all();
        return view('frontend.blog', compact('events'));
    }

    // Handle booking form submission
    public function booking(Request $request)
    {
        // Validate request
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:20',
            'ticket'     => 'required|integer|min:1',
            'event_name' => 'required|exists:events,id',
        ]);

        // Get event info
        $event = Event::findOrFail($request->event_name);

        // Calculate total amount (price × tickets)
        $totalAmount = $event->price * $request->ticket;

        // Create booking and get the object
        $booking = Booking::create([
            'event_id'         => $event->id,
            'number_of_ticket' => $request->ticket,
            'total_amount'     => $totalAmount,
            'status'           => 'pending',
            'name'             => $request->name,
            'email'            => $request->email,
            'phone'            => $request->phone,
        ]);

        // Redirect to payment page with booking ID
        return redirect()->route('payment.show', ['bookingId' => $booking->id]);
    }
}
