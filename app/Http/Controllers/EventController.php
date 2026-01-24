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

        $product_img = '';
        if ($request->image == null) {
            $product_img = 'product_image/noimage.jpg';
        } else {
            $product_img = request()->image->move(
                'product_image',
                $request->image->getClientoriginalName()
            );
        }
        // dd($product_img);

        //.....:::::::::....... Data....::::::::.......
        //dd($request);
        
        $data = [
            'category_id' => $request->category,
            'name' => $request->e_name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $product_img,
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
