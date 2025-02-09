<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        $googleUser = $request->session()->get('googleUser');
        return view('auth.register', compact('googleUser'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
            'google_id' => 'nullable|string'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        if ($request->google_id) {
            $validatedData['google_id'] = $request->google_id;
        }
        $user = User::create($validatedData);
        Auth::login($user);
        return redirect('/dashboard')->with('success', 'Welcome to BMA Library' . $user->name);
    }
}
