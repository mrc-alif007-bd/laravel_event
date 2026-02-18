<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Constructor to ensure admin is authenticated
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display the admin profile.
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        // Get additional stats if needed
        $totalActions = 0; // You can add logic for admin activity

        return view('backend.admin.profile.index', compact('admin', 'totalActions'));
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('backend.admin.profile.edit', compact('admin'));
    }

    /**
     * Update the admin profile.
     */
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($admin->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($admin->avatar) {
                $oldAvatarPath = public_path($admin->avatar);
                if (file_exists($oldAvatarPath) && is_file($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }

            // Generate unique filename
            $fileName = time() . '_' . uniqid() . '.' . $request->file('avatar')->getClientOriginalExtension();

            // Move to public directory
            $request->file('avatar')->move(public_path('admin_avatars'), $fileName);

            // Save path in database
            $validated['avatar'] = 'admin_avatars/' . $fileName;
        }

        // Remove empty phone number
        if (empty($validated['phone'])) {
            $validated['phone'] = null;
        }

        $admin->update($validated);

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profile updated successfully');
    }

    /**
     * Show the form to change password.
     */
    public function changePasswordForm()
    {
        $admin = Auth::guard('admin')->user();
        return view('backend.admin.profile.change-password', compact('admin'));
    }

    /**
     * Update the admin password.
     */
    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Please enter your current password',
            'new_password.required' => 'Please enter a new password',
            'new_password.min' => 'New password must be at least 8 characters',
            'new_password.confirmed' => 'Password confirmation does not match',
        ]);

        // Check current password
        if (!Hash::check($validated['current_password'], $admin->password)) {
            return back()
                ->withErrors(['current_password' => 'The current password is incorrect.'])
                ->withInput($request->except('current_password', 'new_password', 'new_password_confirmation'));
        }

        // Prevent using the same password
        if (Hash::check($validated['new_password'], $admin->password)) {
            return back()
                ->withErrors(['new_password' => 'New password cannot be the same as your current password.'])
                ->withInput($request->except('current_password', 'new_password', 'new_password_confirmation'));
        }

        // Update password
        $admin->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        // Optional: Log the password change
        // activity()->log('Admin changed password');

        return redirect()->route('admin.profile.index')
            ->with('success', 'Password changed successfully. Please use your new password on next login.');
    }

    /**
     * Remove avatar
     */
    public function removeAvatar()
    {
        $admin = Auth::guard('admin')->user();

        if ($admin->avatar) {
            $avatarPath = public_path($admin->avatar);
            if (file_exists($avatarPath) && is_file($avatarPath)) {
                unlink($avatarPath);
            }

            $admin->update(['avatar' => null]);

            return response()->json([
                'success' => true,
                'message' => 'Avatar removed successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No avatar to remove'
        ]);
    }

    /**
     * Update notification settings
     */
    public function updateNotifications(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'email_notifications' => 'sometimes|boolean',
            'booking_alerts' => 'sometimes|boolean',
            'payment_alerts' => 'sometimes|boolean',
            'system_updates' => 'sometimes|boolean',
        ]);

        // If you have a settings JSON column
        $settings = $admin->settings ?? [];
        $settings['notifications'] = array_merge($settings['notifications'] ?? [], $validated);

        $admin->settings = $settings;
        $admin->save();

        return redirect()->back()->with('success', 'Notification settings updated successfully');
    }

    /**
     * Get profile activity log
     */
    public function activityLog()
    {
        $admin = Auth::guard('admin')->user();

        // If you have an activity log table
        // $activities = ActivityLog::where('causer_id', $admin->id)
        //     ->where('causer_type', get_class($admin))
        //     ->latest()
        //     ->paginate(20);

        return view('backend.admin.profile.activity', compact('admin'));
    }
}
