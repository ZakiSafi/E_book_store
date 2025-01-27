<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        // dd('hi');
        return view('auth.login');
    }
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Update last_active timestamp
            $user = Auth::user(); // Assuming your User model is App\Models\User
            $user = User::find($user->id);
            $user->last_login_at = Carbon::now();
            $user->save();

            // Check if the user is an admin
            if ($user->role === 'admin') {
            return redirect('admin/dashboard');
            }

            return redirect()->intended('/users');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function destroy()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('success', 'you have logout successfully');
    }
}
