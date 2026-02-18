<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    public function edit(): View
    {
        return view('backend.admin.profile', [
            'admin' => Auth::guard('admin')->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins', 'email')->ignore($admin->id)],
        ]);

        $admin->update($validated);

        return redirect()->route('admin.profile.edit')->with('status', 'admin-profile-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password:admin'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $admin = Auth::guard('admin')->user();
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admin.profile.edit')->with('status', 'admin-password-updated');
    }
}
