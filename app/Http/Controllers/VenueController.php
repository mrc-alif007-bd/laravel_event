<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::all();
        return view('backend.venue.venue_list', compact('venues'));
    }

    public function create()
    {
        return view('backend.venue.add_venues');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|min:3|max:50',
            'address'     => 'required',
            'city'        => 'required',
            'capacity'    => 'required|integer',
            'description' => 'required',
            'status'      => 'required',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = 'venue_image/noimage.jpg';

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('venue_image'), $imageName);
            $imagePath = 'venue_image/' . $imageName;
        }

        Venue::create([
            'name'        => $request->name,
            'address'     => $request->address,
            'city'        => $request->city,
            'capacity'    => $request->capacity,
            'description' => $request->description,
            'status'      => $request->status,
            'image'       => $imagePath,
        ]);

        return redirect()->route('venue.index')->with('success', 'Venue added successfully');
    }

    public function edit(Venue $venue)
    {
        return view('backend.venue.venue_edit', compact('venue'));
    }

    public function update(Request $request, Venue $venue)
    {
        $request->validate([
            'name'        => 'required|min:3|max:50',
            'address'     => 'required',
            'city'        => 'required',
            'capacity'    => 'required|integer',
            'description' => 'required',
            'status'      => 'required',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $venue->image;

        if ($request->hasFile('image')) {

            if ($venue->image != 'venue_image/noimage.jpg' &&
                File::exists(public_path($venue->image))) {
                File::delete(public_path($venue->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('venue_image'), $imageName);
            $imagePath = 'venue_image/' . $imageName;
        }

        $venue->update([
            'name'        => $request->name,
            'address'     => $request->address,
            'city'        => $request->city,
            'capacity'    => $request->capacity,
            'description' => $request->description,
            'status'      => $request->status,
            'image'       => $imagePath,
        ]);

        return redirect()->route('venue.index')->with('success', 'Venue updated successfully');
    }

    public function destroy(Venue $venue)
    {
        if ($venue->image != 'venue_image/noimage.jpg' &&
            File::exists(public_path($venue->image))) {
            File::delete(public_path($venue->image));
        }

        $venue->delete();

        return redirect()->route('venue.index')->with('success', 'Venue deleted successfully');
    }
}
