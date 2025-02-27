<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CreateAdminController extends Controller
{
    public function createAdmin()
    {
        return view('admin.create');
    }

    // Store the new admin user
    public function createAdminSubmit(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $validated['role'] = 'admin';

        // Create the new admin user
        User::create($validated);

        // Redirect or show a success message
        return redirect()->route('admin.dashboard')->with('success', 'New admin user created successfully!');
    }
}
