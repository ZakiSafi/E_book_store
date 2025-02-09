<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

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

            $user = Auth::user();
            $user->last_login_at = Carbon::now();
            /** @var User $user */
            $user->save();


            // Check if the user is an admin
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect()->intended('/dashboard');
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


    public function redirectToGoogle()
    {
        Auth::logout();
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Check if a user with the same email or Google ID exists
        $user = User::firstOrCreate(
            ['google_id' => $googleUser->getId()], // Check for Google ID first
            [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(Str::random(16)), // Random password for Google users
                'profile_picture' => $googleUser->getAvatar(),
            ]
        );

        Auth::login($user);

        return redirect()->route('home');
    }
}
