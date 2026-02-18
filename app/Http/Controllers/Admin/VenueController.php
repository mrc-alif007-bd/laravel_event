<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;

class VenueController extends Controller
{
    // List all venues
    public function index()
    {
        $venues = Venue::all();
        return view('backend.admin.venues.index', compact('venues'));
    }

    // Show form to create a new venue
    public function create()
    {
        return view('backend.admin.venues.create');
    }

    // Store a new venue
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'city' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:200',
            'status' => 'required|string|max:50',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('venue_images'), $fileName);
            $validated['image'] = 'venue_images/' . $fileName;
        }

        Venue::create($validated);

        return redirect()->route('admin.venues.index')
            ->with('success', 'Venue created successfully');
    }

    // Show a venue
    public function show(Venue $venue)
    {
        return view('backend.admin.venues.show', compact('venue'));
    }

    // Show edit form
    public function edit(Venue $venue)
    {
        return view('backend.admin.venues.edit', compact('venue'));
    }

    // Update venue
    public function update(Request $request, Venue $venue)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'city' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:200',
            'status' => 'required|string|max:50',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('venue_images'), $fileName);
            $validated['image'] = 'venue_images/' . $fileName;
        }

        $venue->update($validated);

        return redirect()->route('admin.venues.index')
            ->with('success', 'Venue updated successfully');
    }

    // Delete venue
    public function destroy(Venue $venue)
    {
        $venue->delete();
        return redirect()->route('admin.venues.index')
            ->with('success', 'Venue deleted successfully');
    }
}
