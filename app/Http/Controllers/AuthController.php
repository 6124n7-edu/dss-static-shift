<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Show the Login Form
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Handle the Login Submission
    public function login(Request $request)
    {
        // Validate Input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to Log In
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // Go to Dashboard
        }

        // If failed
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // 3. Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}