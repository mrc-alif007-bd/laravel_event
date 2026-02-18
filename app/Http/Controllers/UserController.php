<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of registered users for admin.
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('backend.users.user_list', compact('users'));
    }
}
