<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Constructor to ensure user is authenticated
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Display the user profile.
     */
    public function index()
    {
        $user = Auth::guard('web')->user();

        // Load user bookings
        $recentBookings = $user->bookings()->with('event')->latest()->take(5)->get();
        $totalBookings = $user->bookings()->count();

        return view('backend.user.profile.index', compact('user', 'recentBookings', 'totalBookings'));
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $user = Auth::guard('web')->user();
        return view('backend.user.profile.edit', compact('user'));
    }

    /**
     * Update the user profile.
     */
    public function update(Request $request)
    {
        $user = Auth::guard('web')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }

            $fileName = time() . '_user_' . $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(public_path('user_avatars'), $fileName);
            $validated['avatar'] = 'user_avatars/' . $fileName;
        }

        $user->update($validated);

        return redirect()->route('user.profile.index')
            ->with('success', 'Profile updated successfully');
    }

    /**
     * Show the form to change password.
     */
    public function changePasswordForm()
    {
        return view('backend.user.profile.change-password');
    }

    /**
     * Update the user password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::guard('web')->user();

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Check current password
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return redirect()->route('user.profile.index')
            ->with('success', 'Password changed successfully');
    }
}
