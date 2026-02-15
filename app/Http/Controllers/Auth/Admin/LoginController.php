<?php

namespace App\Http\Controllers\Auth\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.admin_login');
    }

    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if(! Auth::guard('admin')->attempt($request->only('email', 'password'), $request->boolean('remember')))
        {
            return back()
                ->withErrors(['email' => trans('auth.failed')])
                ->withInput($request->except('password'));
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
