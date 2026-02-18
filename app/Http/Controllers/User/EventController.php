<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // List upcoming events
    public function index()
    {
        $events = Event::where('status', 1)->with('venue')->get();
        return view('backend.user.events.index', compact('events'));
    }

    // Show event details
    public function show(Event $event)
    {
        $event->load('venue', 'category', 'reviews');
        return view('backend.user.events.show', compact('event'));
    }
}
