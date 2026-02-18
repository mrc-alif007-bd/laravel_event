<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Venue;
use App\Models\Category;

class EventController extends Controller
{
    // List all events
    public function index()
    {
        $events = Event::with(['venue', 'category'])->get();
        return view('backend.admin.events.index', compact('events'));
    }

    // Show form to create a new event
    public function create()
    {
        $venues = Venue::all();
        $categories = Category::all();
        return view('backend.admin.events.create', compact('venues', 'categories'));
    }

    // Store a new event
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'venue_id' => 'required|exists:venues,id',
            'category_id' => 'required|exists:categories,id',
            'event_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_paid' => 'required|boolean',
            'price' => 'nullable|numeric|min:0',
            'total_tickets' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|integer|in:1,2,3'
        ]);

        // Set available tickets
        $validated['available_tickets'] = $validated['total_tickets'];

        // Handle image
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('event_images'), $fileName);
            $validated['image'] = 'event_images/' . $fileName;
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully');
    }

    // Show a single event
    public function show(Event $event)
    {
        $event->load(['venue', 'category', 'bookings', 'reviews']);
        return view('backend.admin.events.show', compact('event'));
    }

    // Show form to edit an event
    public function edit(Event $event)
    {
        $venues = Venue::all();
        $categories = Category::all();
        return view('backend.admin.events.edit', compact('event', 'venues', 'categories'));
    }

    // Update event
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'venue_id' => 'required|exists:venues,id',
            'category_id' => 'required|exists:categories,id',
            'event_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_paid' => 'required|boolean',
            'price' => 'nullable|numeric|min:0',
            'total_tickets' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|integer|in:1,2,3'
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('event_images'), $fileName);
            $validated['image'] = 'event_images/' . $fileName;
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully');
    }

    // Delete event
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully');
    }
}
