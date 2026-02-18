<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        // Ensure user is logged in
        $this->middleware('auth:web');
    }

    // Show profile
    public function index()
    {
        $user = Auth::guard('web')->user();

        // Safety check: ensure $user is a model
        if (!$user instanceof User) {
            abort(403, 'Unauthorized');
        }

        return view('backend.user.profile.index', compact('user'));
    }

    // Edit form
    public function edit()
    {
        $user = Auth::guard('web')->user();
        if (!$user instanceof User) abort(403);
        return view('backend.user.profile.edit', compact('user'));
    }

    // Update profile
    public function update(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user instanceof User) abort(403);

        // Validate inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:6',
        ]);

        // Manually update fields (DO NOT call save/update on non-model)
        $user->name = $validated['name'];
        $user->phone = $validated['phone'] ?? null;

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        // ✅ Save changes via Eloquent model
        if (method_exists($user, 'save')) {
            $user->save();
        } else {
            abort(500, 'User object is not an Eloquent model');
        }

        return redirect()->route('user.profile.index')
            ->with('success', 'Profile updated successfully');
    }
}
