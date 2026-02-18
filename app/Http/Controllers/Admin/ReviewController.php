<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    // List all reviews
    public function index()
    {
        $reviews = Review::with(['user', 'event'])->get();
        return view('backend.admin.reviews.index', compact('reviews'));
    }

    // Show review
    public function show(Review $review)
    {
        return view('backend.admin.reviews.show', compact('review'));
    }

    // Delete review
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully');
    }
}
