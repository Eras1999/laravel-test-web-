<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdoptionPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdoptionPostsController extends Controller
{
    public function create()
    {
        return view('frontend.adoption_posts.create');
    }

    public function form()
    {
        return view('frontend.adoption_posts.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'category' => 'required|in:dog,cat',
            'description' => 'required|string',
            'district' => 'required|string',
            'city' => 'required|string',
            'nearby_city' => 'required|string',
            'mobile_number' => 'required|string|max:15',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = $request->file('image')->store('adoption_posts', 'public');

        AdoptionPost::create([
            'author_name' => $request->author_name,
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'district' => $request->district,
            'city' => $request->city,
            'nearby_city' => $request->nearby_city,
            'mobile_number' => $request->mobile_number,
            'image' => $imagePath,
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Adoption post submitted successfully and is awaiting approval.']);
    }

    public function index(Request $request)
    {
        $query = AdoptionPost::where('status', 'approved')
            ->where('approved_at', '>=', now()->subDays(7));

        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $posts = $query->get();

        return view('frontend.adoption_posts.index', compact('posts'));
    }

    public function adopted(Request $request, $id)
    {
        $post = AdoptionPost::findOrFail($id);
        if ($post->status === 'approved' && now()->diffInDays($post->approved_at) < 7) {
            $post->update(['status' => 'rejected']);
            return redirect()->route('profile')->with('success', 'Post marked as adopted and moved to rejected status in admin panel. Adopted count updated.');
        }
        return redirect()->route('profile')->with('error', 'Cannot mark this post as adopted.');
    }

    public function repost(Request $request, $id)
    {
        $post = AdoptionPost::findOrFail($id);
        if ($post->status === 'expired' || ($post->status === 'approved' && now()->diffInDays($post->approved_at) >= 7)) {
            $post->update(['status' => 'pending', 'approved_at' => null]);
            return redirect()->route('profile')->with('success', 'Post marked for reposting and awaiting approval. Pending count updated.');
        }
        return redirect()->route('profile')->with('error', 'Cannot repost this post.');
    }
}