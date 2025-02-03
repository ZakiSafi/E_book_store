<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile(User $user)
    {
        $user = Auth::user(); // Get the authenticated user
        return view('users.profile', compact('user'));
    }



    public function profile_update(Request $request)
    {

        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional validation for image
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user(); // Get the authenticated user
        $user->name = $request->name;

        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($user->profile_picture) {
                Storage::delete('profile_pictures/' . $user->profile_picture);
            }

            // Store the new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures');

            // Save the new profile picture path in the database

            $user->profile_picture = basename($path);
        }
        /** @var User $user */
        $user->save();
        if(Auth::user()->role ==='admin'){
            return redirect('/admin/dashboard')->with('success', 'Profile picture updated successfully.');

        }
        return redirect('/dashboard')->with('success', 'Profile picture updated successfully.');
    }
}
