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

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $user->last_login_at = Carbon::now();
            /** @var User $user */
            $user->save();

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


    // Social login functioality
    public function redirectToGoogleForLogin()
    {
        session(['is_login_flow' => true]);
        return Socialite::driver('google')->redirect();
    }

    public function redirectToGoogleForSignup()
    {
        session(['is_login_flow' => false]);
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->getEmail())->first();
        $isLoginFlow = $request->session()->get('is_login_flow', false);
        $request->session()->forget('is_login_flow');

        if ($user) {
            if (!$user->google_id) {
                $user->update(['google_id' => $googleUser->getId()]);
            }
            Auth::login($user);
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome back ' . $user->name . ' to BMA Library');
            } else {
                return redirect()->route('dashboard')->with('success', 'Welcome back ' . $user->name . ' to BMA Library');
            }
        } else {
            if ($isLoginFlow) {
                return redirect()->route('register')->with('googleUser', [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                ]);
            } else {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => now(),
                    'password' => bcrypt(Str::random(24)),
                ]);
                Auth::login($user);
                return redirect()->route('dashboard')->with('success', 'Welcome ' . $user->name . ' to BMA Library');
            }
        }
    }
}
