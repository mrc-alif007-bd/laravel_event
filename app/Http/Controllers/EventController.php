<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Venue;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('venue')->latest()->get();
        return view('backend.events.event_list', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $venues = Venue::all();

        return view('backend.events.add_events', compact('venues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|in:0,1',
            'title'       => 'required|min:3|max:50',
            'venue_id'    => 'required|exists:venues,id',
            'price'       => 'required|numeric',
            'description' => 'nullable|max:200',
            'status'      => 'required|in:1,2,3',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $event_img = 'event_image/noimage.jpg';

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('event_image'), $imageName);
            $event_img = 'event_image/' . $imageName;
        }

        Event::create([
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'venue_id'    => $request->venue_id,
            'price'       => $request->price,
            'description' => $request->description,
            'status'      => $request->status,
            'image'       => $event_img,
        ]);

        return redirect()->route('admin.event.index')
            ->with('success', 'Event added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $venues = Venue::all();

        return view('backend.events.event_edit', compact('event', 'venues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'category_id' => 'required|in:0,1',
            'title'       => 'required|min:3|max:50',
            'venue_id'    => 'required|exists:venues,id',
            'price'       => 'required|numeric',
            'description' => 'nullable|max:200',
            'status'      => 'required|in:1,2,3',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $event_img = $event->image;

        if ($request->hasFile('image')) {

            if ($event->image && file_exists(public_path($event->image))) {
                unlink(public_path($event->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('event_image'), $imageName);
            $event_img = 'event_image/' . $imageName;
        }

        $event->update([
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'venue_id'    => $request->venue_id,
            'price'       => $request->price,
            'description' => $request->description,
            'status'      => $request->status,
            'image'       => $event_img,
        ]);

        return redirect()->route('admin.event.index')
            ->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->image && file_exists(public_path($event->image))) {
            unlink(public_path($event->image));
        }

        $event->delete();

        return redirect()->route('admin.event.index')
            ->with('success', 'Event deleted successfully');
    }
}
