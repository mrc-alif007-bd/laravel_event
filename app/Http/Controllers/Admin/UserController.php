<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Display a list of all users (Admin view)
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('backend.admin.users.index', compact('users'));
    }

    // Show the form to create a new user
    public function create()
    {
        return view('backend.admin.users.create');
    }

    // Store a new user in the database
    public function store(Request $request)
    {
        // Validate request input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:50',
            'password' => 'required|string|min:6',
        ]);

        // Hash the password before saving
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully');
    }

    // Show a single user's details
    public function show(User $user)
    {
        return view('backend.admin.users.show', compact('user'));
    }

    // Show the form to edit a user
    public function edit(User $user)
    {
        return view('backend.admin.users.edit', compact('user'));
    }

    // Update the user
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:6',
        ]);

        // Hash password if provided
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Do not overwrite if empty
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    // Delete a user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }
}
