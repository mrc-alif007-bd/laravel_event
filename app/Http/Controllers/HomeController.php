<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    // Show the homepage
    public function index()
    {
        return view('frontend.index');
    }

    // About page
    public function about()
    {
        return view('frontend.about');
    }

    // Blog page
    public function blog()
    {
        return view('frontend.blog');
    }

    // Booking page
    public function booking()
    {
        return view('frontend.booking');
    }

    // Contact page
    public function contact()
    {
        return view('frontend.contact');
    }

    // Services page
    public function services()
    {
        return view('frontend.services');
    }

    // Venues page - Show all events
    public function venues()
    {
        $events = Event::all();

        return view('frontend.venue', compact('events'));
    }

    // Single event page
    public function showEvent($id)
    {
        $event = Event::with(['venue', 'category', 'reviews'])
            ->findOrFail($id);

        return view('frontend.single-event', compact('event'));
    }
}
