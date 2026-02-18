<?php

namespace App\Http\Controllers\Auth\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function __construct()
    {
        // Only guests can access login; authenticated admins will be redirected
        $this->middleware('guest:admin')->except('destroy');
    }

    /**
     * Show the admin login form
     */
    public function create()
    {
        return view('auth.admin_login'); // Blade: resources/views/auth/admin_login.blade.php
    }

    /**
     * Handle admin login attempt
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate login form input
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        // Attempt login with 'admin' guard
        $remember = $request->boolean('remember');

        if (!Auth::guard('admin')->attempt($credentials, $remember)) {
            // Login failed
            return back()
                ->withErrors(['email' => trans('auth.failed')])
                ->withInput($request->except('password'));
        }

        // Regenerate session to prevent fixation
        $request->session()->regenerate();

        // Redirect to admin dashboard
        return redirect()->route('admin.dashboard')
            ->with('success', 'Logged in successfully.');
    }

    /**
     * Logout the admin
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        // Invalidate session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to admin login page (adjusted route)
        return redirect()->route('admin.login')
            ->with('success', 'You have been logged out.');
    }
}
