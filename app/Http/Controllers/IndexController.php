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
        return view('index', compact('events'));
    }

    // Handle booking form submission
    public function booking(Request $request)
    {
        // dd($request);
        // Validate the request
        $request->validate([
            'event_id'         => 'required|exists:events,id',
            'number_of_ticket' => 'required|integer|min:1',
            'total_amount'     => 'required|numeric|min:0',
        ]);



        // Create booking
        Booking::create([
            'event_id'         => $request->event_id,
            'number_of_ticket' => $request->number_of_ticket,
            'total_amount'     => $request->total_amount,
            'status'           => 'pending', // default status
        ]);

         return redirect()->back()->with('success', 'Booking successful!');
    }
}
