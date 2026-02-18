<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // List reviews by logged-in user
    public function index()
    {
        $reviews = Review::where('user_id', Auth::id())->with('event')->get();
        return view('backend.user.reviews.index', compact('reviews'));
    }

    // Create review form
    public function create()
    {
        return view('backend.user.reviews.create');
    }

    // Store review
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = Auth::id();

        Review::create($validated);

        return redirect()->route('user.reviews.index')
            ->with('success', 'Review submitted successfully');
    }

    // Delete review
    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        $review->delete();
        return redirect()->route('user.reviews.index')
            ->with('success', 'Review deleted successfully');
    }
}
