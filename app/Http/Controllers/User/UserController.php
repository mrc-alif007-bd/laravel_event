<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Show logged-in user's profile
    public function index()
    {
        $user = Auth::user();
        return view('backend.user.profile.index', compact('user'));
    }

    // Show form to edit profile
    public function edit()
    {
        $user = Auth::user();
        return view('backend.user.profile.edit', compact('user'));
    }

    // Update logged-in user's profile
    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:6',
        ]);

        // Update fields safely
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('user.profile.index')
            ->with('success', 'Profile updated successfully');
    }
}
