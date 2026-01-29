<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('backend.events.event_list', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.events.add_events');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'category' => 'required',
            'title' => 'required|min:3|max:50',
            'venue' => 'required',
            'price' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:2048',
        ]);

        $event_img = 'event_image/noimage.jpg';

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('event_image'), $imageName);
            $event_img = 'event_image/' . $imageName;
        }

        Event::create([
            'category_id' => $request->category,
            'title'        => $request->title,
            'venue_id' => $request->venue,
            'price'       => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'image'       => $event_img,
        ]);

        return redirect()->route('event.index')->with('success', 'Event added');
    }


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {

        return view('backend.events.event_edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required|min:3|max:50',
            'venue' => 'required',
            'price' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:2048',
        ]);

        $event_img = $event->image;

        if ($request->hasFile('image')) {

            // delete old image
            if ($event->image && file_exists(public_path($event->image))) {
                unlink(public_path($event->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('event_image'), $imageName);
            $event_img = 'event_image/' . $imageName;
        }

        $event->update([
            'category_id' => $request->category,
            'title'        => $request->title,
            'venue_id' => $request->venue,
            'price'       => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'image'       => $event_img,
        ]);

        return redirect()->route('event.index')->with('success', 'Event Updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //dd($event);
        if ($event->image && file_exists(public_path($event->image))) {
            unlink(public_path($event->image));
        }

        $event->delete();

        return redirect()->route('event.index')
            ->with('success', 'Successfully Deleted');
    }
}
