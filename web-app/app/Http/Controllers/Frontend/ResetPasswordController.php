<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCredential;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function store(Request $request) {
        $user = UserCredential::where('email', $request->email)->first();

        if(!$user){
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => "Account not found for the given email."]);
        }

        Mail::to($user->email)->send(new \App\Mail\FrontResetPasswordLink($user));

        return back()->with('status', "Password reset link sent to your email.");
    }

    public function edit(Request $request) {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $user = UserCredential::findOrFail($request->user);

        return view('frontend.reset_password', compact('user'));
    }

    public function update(Request $request) {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);

        $user = UserCredential::findOrFail($request->user);

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('signin');
    }
}
