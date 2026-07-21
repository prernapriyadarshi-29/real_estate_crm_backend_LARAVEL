<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('Admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.users.show', compact('user'));
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => 0
        ]);

        return back()->with('success', 'User blocked successfully.');
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => 1
        ]);

        return back()->with('success', 'User activated successfully.');
    }
}