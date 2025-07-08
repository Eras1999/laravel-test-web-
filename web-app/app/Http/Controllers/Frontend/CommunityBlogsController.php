<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CommunityBlog;

class CommunityBlogsController extends Controller
{
    public function index()
    {
        $blogs = CommunityBlog::where('status', 'approved')->paginate(6); // Adjust the number (6) to how many blogs per page you want
        return view('frontend.community-blogs', compact('blogs'));
    }

    public function create()
    {
        if (!Auth::guard('frontend')->check()) {
            return redirect()->route('signin')->with('error', 'Please sign in to submit a blog.');
        }
        $user = Auth::guard('frontend')->user();
        return view('frontend.community-blog-submit', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $user = Auth::guard('frontend')->user();

        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['author_name'] = $user->name; // Auto-fill author name
        $data['date'] = now()->toDateString();
        $data['status'] = 'pending';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('community_blogs', 'public');
        }

        CommunityBlog::create($data);

        return redirect()->route('community-blogs.index')->with('success', 'Blog submitted successfully and awaiting approval.');
    }

    public function show($id)
    {
        $user = Auth::guard('frontend')->user();
        $query = CommunityBlog::where('id', $id);

        // Allow users to view their own blogs regardless of status, but restrict others to approved blogs only
        if ($user) {
            $query->where(function ($q) use ($user) {
                $q->where('status', 'approved')->orWhere('user_id', $user->id);
            });
        } else {
            $query->where('status', 'approved');
        }

        $blog = $query->firstOrFail();
        return view('frontend.community-blog-detail', compact('blog'));
    }
}