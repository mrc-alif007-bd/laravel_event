<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Exception;

class VenueController extends Controller
{
    public function index()
    {
        try {
            $venues = Venue::latest()->get();
            return view('backend.venue.venue_list', compact('venues'));
        } catch (Exception $e) {
            Log::error('Error fetching venues: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load venues. Please try again.');
        }
    }

    public function create()
    {
        try {
            return view('backend.venue.add_venues');
        } catch (Exception $e) {
            Log::error('Error loading venue creation form: ' . $e->getMessage());
            return redirect()->route('admin.venue.index')->with('error', 'Failed to load creation form.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'        => 'required|min:3|max:50',
                'address'     => 'required|max:50',
                'city'        => 'required|max:50',
                'capacity'    => 'required|integer|min:1|max:32767',
                'description' => 'required|max:200',
                'status'      => 'required|in:active,inactive',
                'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $imagePath = 'venue_image/noimage.jpg';

            if ($request->hasFile('image')) {
                // Validate image upload
                if (!$request->file('image')->isValid()) {
                    return redirect()->back()->withInput()->with('error', 'Uploaded image is invalid.');
                }

                $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();

                // Create directory if it doesn't exist
                $uploadPath = public_path('venue_image');
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true);
                }

                $request->image->move($uploadPath, $imageName);
                $imagePath = 'venue_image/' . $imageName;
            }

            $venue = Venue::create([
                'name'        => trim($request->name),
                'address'     => trim($request->address),
                'city'        => trim($request->city),
                'capacity'    => $request->capacity,
                'description' => trim($request->description),
                'status'      => $request->status,
                'image'       => $imagePath,
            ]);

            if (!$venue) {
                throw new Exception('Failed to create venue record in database.');
            }

            Log::info('Venue created successfully: ' . $venue->id);

            return redirect()->route('admin.venue.index')
                ->with('success', 'Venue "' . $venue->name . '" added successfully!');
        } catch (Exception $e) {
            Log::error('Error creating venue: ' . $e->getMessage());

            // If image was uploaded but record failed, clean up
            if (isset($imagePath) && $imagePath != 'venue_image/noimage.jpg' && File::exists(public_path($imagePath))) {
                try {
                    File::delete(public_path($imagePath));
                } catch (Exception $cleanupError) {
                    Log::error('Failed to clean up image after venue creation failure: ' . $cleanupError->getMessage());
                }
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create venue. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function edit(Venue $venue)
    {
        try {
            if (!$venue) {
                throw new Exception('Venue not found.');
            }

            return view('backend.venue.venue_edit', compact('venue'));
        } catch (Exception $e) {
            Log::error('Error loading venue edit form: ' . $e->getMessage());
            return redirect()->route('admin.venue.index')
                ->with('error', 'Failed to load venue edit form. Venue may not exist.');
        }
    }

    public function update(Request $request, Venue $venue)
    {
        try {
            if (!$venue) {
                throw new Exception('Venue not found.');
            }

            $request->validate([
                'name'        => 'required|min:3|max:50',
                'address'     => 'required|max:50',
                'city'        => 'required|max:50',
                'capacity'    => 'required|integer|min:1|max:32767',
                'description' => 'required|max:200',
                'status'      => 'required|in:active,inactive',
                'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $imagePath = $venue->image;

            if ($request->hasFile('image')) {
                // Validate new image upload
                if (!$request->file('image')->isValid()) {
                    return redirect()->back()->withInput()->with('error', 'Uploaded image is invalid.');
                }

                // Create directory if it doesn't exist
                $uploadPath = public_path('venue_image');
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true);
                }

                // Delete old image if it exists and is not the default
                if ($venue->image != 'venue_image/noimage.jpg' && File::exists(public_path($venue->image))) {
                    try {
                        File::delete(public_path($venue->image));
                    } catch (Exception $deleteError) {
                        Log::warning('Failed to delete old venue image: ' . $deleteError->getMessage());
                        // Continue with update even if old image deletion fails
                    }
                }

                $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
                $request->image->move($uploadPath, $imageName);
                $imagePath = 'venue_image/' . $imageName;
            }

            $updated = $venue->update([
                'name'        => trim($request->name),
                'address'     => trim($request->address),
                'city'        => trim($request->city),
                'capacity'    => $request->capacity,
                'description' => trim($request->description),
                'status'      => $request->status,
                'image'       => $imagePath,
            ]);

            if (!$updated) {
                throw new Exception('Failed to update venue record in database.');
            }

            Log::info('Venue updated successfully: ' . $venue->id);

            return redirect()->route('admin.venue.index')
                ->with('success', 'Venue "' . $venue->name . '" updated successfully!');
        } catch (Exception $e) {
            Log::error('Error updating venue: ' . $e->getMessage());

            // If new image was uploaded but update failed, clean up
            if (
                isset($imagePath) && isset($request->image) &&
                $imagePath != $venue->image &&
                $imagePath != 'venue_image/noimage.jpg' &&
                File::exists(public_path($imagePath))
            ) {
                try {
                    File::delete(public_path($imagePath));
                } catch (Exception $cleanupError) {
                    Log::error('Failed to clean up image after venue update failure: ' . $cleanupError->getMessage());
                }
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update venue. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function destroy(Venue $venue)
    {
        try {
            if (!$venue) {
                throw new Exception('Venue not found.');
            }

            $venueName = $venue->name; // Store for success message

            // Check if venue has any associated events (if you have events table)
            // Uncomment this if you have events relationship
            /*
            if ($venue->events()->count() > 0) {
                return redirect()->route('admin.venue.index')
                    ->with('error', 'Cannot delete venue because it has associated events.');
            }
            */

            // Delete venue image if it exists and is not the default
            if ($venue->image != 'venue_image/noimage.jpg' && File::exists(public_path($venue->image))) {
                try {
                    File::delete(public_path($venue->image));
                } catch (Exception $deleteError) {
                    Log::warning('Failed to delete venue image during deletion: ' . $deleteError->getMessage());
                    // Continue with venue deletion even if image deletion fails
                }
            }

            $deleted = $venue->delete();

            if (!$deleted) {
                throw new Exception('Failed to delete venue record from database.');
            }

            Log::info('Venue deleted successfully: ' . $venue->id);

            return redirect()->route('admin.venue.index')
                ->with('success', 'Venue "' . $venueName . '" deleted successfully!');
        } catch (Exception $e) {
            Log::error('Error deleting venue: ' . $e->getMessage());

            return redirect()->route('admin.venue.index')
                ->with('error', 'Failed to delete venue. Please try again. Error: ' . $e->getMessage());
        }
    }

    /**
     * Additional helper method to check venue status
     */
    public function checkStatus(Venue $venue)
    {
        try {
            if (!$venue) {
                return response()->json(['error' => 'Venue not found'], 404);
            }

            return response()->json([
                'id' => $venue->id,
                'name' => $venue->name,
                'status' => $venue->status,
                'capacity' => $venue->capacity,
                'current_bookings' => 0 // You can add actual booking count if you have events
            ]);
        } catch (Exception $e) {
            Log::error('Error checking venue status: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to check venue status'], 500);
        }
    }
}
