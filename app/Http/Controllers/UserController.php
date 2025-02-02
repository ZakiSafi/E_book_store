<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function books(){
        $user = Auth::user();

        /** @var User $user */
        $books = $user->books()->get();
        return view('users.book',compact('books','user'));

    }
    public function index()
    {
        // $categories = Category::take(10)->get();
        $user = Auth::user();
        $lastUploadedBook = Book::where('user_id', $user->id)
        ->latest('created_at')
        ->first();
        $lastLoginDate = $user->last_login_at;
        return view('users.dashboard', compact('user', 'lastLoginDate', 'lastUploadedBook'));
    }

    public function show(User $user)
    {
        $user = Auth::user();
        return view('users.show',compact('user'));
    }

    public function update(Request $request)
    {

    }
    public function profile(User $user){
        $user = Auth::user(); // Get the authenticated user
        return view('users.profile', compact('user'));
    }
    public function profile_update(Request $request){

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
        return redirect('/dashboard')->with('success', 'Profile picture updated successfully.');
    }
}
