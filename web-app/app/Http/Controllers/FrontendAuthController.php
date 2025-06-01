<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCredential;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontendAuthController extends Controller
{
    // Show Sign In Page
    public function showSignIn()
    {
        return view('frontend.signin');
    }

    // Handle Sign In
    public function signIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('frontend')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('home.authenticated');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Show Sign Up Page
    public function showSignUp()
    {
        return view('frontend.signup');
    }

    // Handle Sign Up
    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_credentials,email',
            'password' => 'required|min:8|confirmed',
            'terms' => 'accepted',
        ]);

        $user = UserCredential::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'terms_accepted' => true,
        ]);

        // Log out immediately after signup to require sign-in
        Auth::guard('frontend')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('signin')->with('success', 'Account created successfully! Please sign in.');
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::guard('frontend')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('signin');
    }

    // Show User Profile
    public function showProfile()
    {
        $user = Auth::guard('frontend')->user();
        return view('frontend.profile', compact('user'));
    }
}