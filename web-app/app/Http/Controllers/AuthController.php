<?php

namespace App\Http\Controllers;

use App\Models\UserCredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Show Sign Up Page
    public function showSignUp()
    {
        return view('frontend.signup');
    }

    // Handle Sign Up
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_credentials,email',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'accepted',
        ]);

        UserCredential::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('signin')->with('success', 'Successfully signed up! Please sign in.');
    }

    // Show Sign In Page
    public function showSignIn()
    {
        return view('frontend.signin');
    }

    // Handle Sign In
    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = UserCredential::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user', $user);
            return redirect()->route('home.authenticated');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    // Show Forgot Password Page
    public function showForgotPassword()
    {
        return view('frontend.forgot-password');
    }

    // Handle Forgot Password
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = UserCredential::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found'])->withInput();
        }

        // In a real application, you would send an email with a reset link here.
        // For simplicity, we'll just redirect with a message.
        return redirect()->route('signin')->with('success', 'A password reset link has been sent to your email.');
    }

    // Handle Logout
    public function logout()
    {
        Session::forget('user');
        return redirect()->route('signin');
    }
}