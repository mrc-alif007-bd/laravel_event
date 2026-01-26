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
        //.........Validetion........
        $request->validate(
            [
                'e_name' => 'required|min:3|max:10',
                'category' => 'required',
                'description' => 'required',
                'price' => 'required',
                'image' => 'required|mimes:jpg,png,pdf,jpeg|max:2048',
            ]
        );

        $event_img = '';
        if ($request->image == null) {
            $event_img = 'event_image/noimage.jpg';
        } else {
            $event_img = request()->image->move(
                'event_image',
                $request->image->getClientoriginalName()
            );
        }
        // dd(event_img//$product_img);

        //.....:::::::::....... Data....::::::::.......
        //dd($request);
        
        $data = [
            'category_id' => $request->category,
            'name' => $request->e_name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $event_img,
        ];
        //dd($data);

        Event::create($data);
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

         return view('backend.events.event_edit');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
         //.........Validetion........
        $request->validate(
            [
                'e_name' => 'required|min:3|max:10',
                'category' => 'required',
                'description' => 'required',
                'price' => 'required',
                'image' => 'required|mimes:jpg,png,pdf,jpeg|max:2048',
            ]
        );

        $event_img = '';
        if ($request->image == null) {
            $event_img = 'event_image/noimage.jpg';
        } else {
            $event_img = request()->image->move(
                'event_image',
                $request->image->getClientoriginalName()
            );
        }
        // dd(event_img//$product_img);

        //.....:::::::::....... Data....::::::::.......
        //dd($request);
        
        $u_data = [
            'category_id' => $request->category,
            'name' => $request->e_name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $event_img,
        ];
        //dd($data);

        $event->update($u_data);
        return redirect()->route('event.index')->with('success', 'Event Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {

        //  dd($event->image);
         $imagePath=public_path($event->image);
         unlink($imagePath);
        $event->delete();
        return redirect()->route('event.index')->with('success','Successfully Deleted');

        $event->delete();
        return redirect()->route('event.index')->with('success','Successfully Deleted');
        //return view('backend.events.event_edit');

    }
}
