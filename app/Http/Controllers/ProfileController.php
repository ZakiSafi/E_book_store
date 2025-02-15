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
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->name = $request->name;

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete('profile_pictures/' . $user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures');
            // Extracts the filename from the full path  (e.g., profile_pictures/abc123.jpg becomes abc123.jpg).
            $user->profile_picture = basename($path);
        }

        $user->save();

        $route = $user->role === 'admin' ? 'admin.dashboard' : 'user.dashboard';
        return redirect()->route($route)->with('success', 'Profile updated successfully.');
    }
}
