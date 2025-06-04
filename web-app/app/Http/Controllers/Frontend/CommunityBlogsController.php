<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityBlogsController extends Controller
{
    public function index()
    {
        return view('frontend.community-blogs');
    }

    public function create()
    {
        // Ensure only authenticated users can access the form
        if (!Auth::guard('frontend')->check()) {
            return redirect()->route('signin')->with('error', 'Please sign in to submit a blog.');
        }

        $user = Auth::guard('frontend')->user();
        return view('frontend.community-blog-submit', compact('user'));
    }
}