<?php

namespace App\Http\Controllers;

use App\Models\UserCredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // Existing Normal Sign In
    public function showSignInForm()
    {
        return view('frontend.signin');
    }

    public function signIn(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home.authenticated'));
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Existing Normal Sign Up
    public function showSignUpForm()
    {
        return view('frontend.signup');
    }

    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_credentials,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        UserCredential::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('signin')->with('success', 'Registration successful! Please sign in.');
    }

    // Google Authentication
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user already exists
            $user = UserCredential::where('email', $googleUser->email)->first();

            if ($user) {
                // If user exists, log them in
                Auth::login($user, true);
            } else {
                // If user doesn't exist, create a new user
                $newUser = UserCredential::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(uniqid()), // Generate a random password
                ]);

                Auth::login($newUser, true);
            }

            // Ensure the user is authenticated before redirecting
            if (Auth::check()) {
                return redirect()->route('home.authenticated');
            } else {
                return redirect()->route('signin')->withErrors(['error' => 'Authentication failed after Google login.']);
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Google login error: ' . $e->getMessage());
            return redirect()->route('signin')->withErrors(['error' => 'Unable to login with Google. Please try again.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('signin');
    }
}