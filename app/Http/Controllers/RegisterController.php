<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store()
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Ensure email is unique
            'password' => 'required|min:5|confirmed', // `confirmed` validates password and confirmation
        ]);

        // Hash the password
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Create the user
        $user = User::create($validatedData);

        // Log in the user
        Auth::login($user);

        // Redirect to user dashboard with a success message
        return redirect('/user/dashboard')->with('success', 'You are now registered and logged in.');
    }
}
