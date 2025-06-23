<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RescuePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RescuePostsController extends Controller
{
    public function index()
    {
        $rescuePosts = RescuePost::orderBy('created_at', 'desc')->get();
        return view('frontend.rescue_posts.index', compact('rescuePosts'));
    }

    public function store(Request $request)
    {
        \Log::info('Rescue Post Submission Data:', $request->all());

        $request->validate([
            'author_name' => 'required|string|max:255',
            'animal_type' => 'required|in:Dog,Cat,Bird,Snake,Other',
            'image' => 'nullable|image|max:2048',
            'healthy_status' => 'required|in:Healthy but Abandoned,Injured,Sick or Weak,In Critical Condition,Unknown / Not Sure',
            'district' => 'required|in:Colombo,Gampaha,Kalutara,Kandy,Matale,Nuwara Eliya,Galle,Matara,Hambantota,Jaffna,Kilinochchi,Mannar,Vavuniya,Mullaitivu,Batticaloa,Ampara,Trincomalee,Kurunegala,Puttalam,Anuradhapura,Polonnaruwa,Badulla,Moneragala,Ratnapura,Kegalle',
            'place' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'description' => 'required|string',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('rescue_posts', 'public') : null;

        RescuePost::create([
            'author_name' => $request->author_name,
            'animal_type' => $request->animal_type,
            'image' => $imagePath,
            'healthy_status' => $request->healthy_status,
            'district' => $request->district,
            'place' => $request->place,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'user_id' => Auth::guard('frontend')->check() ? Auth::guard('frontend')->user()->id : null,
        ]);

        return redirect()->route('rescue-posts.index')->with('success', 'Rescue post uploaded successfully.');
    }

    public function show($id)
    {
        $rescuePost = RescuePost::findOrFail($id);
        $comments = $rescuePost->comments ?? [];
        // Convert string timestamps to Carbon instances if needed
        $comments = array_map(function ($comment) {
            $comment['created_at'] = $comment['created_at'] instanceof Carbon ? $comment['created_at'] : Carbon::parse($comment['created_at']);
            return $comment;
        }, $comments);
        return view('frontend.rescue_posts.show', compact('rescuePost', 'comments'));
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $rescuePost = RescuePost::findOrFail($id);

        // Initialize comments as an array if null
        $comments = $rescuePost->comments ?? [];
        $newComment = [
            'user_name' => Auth::guard('frontend')->check() ? Auth::guard('frontend')->user()->name : 'Anonymous',
            'comment' => $request->comment,
            'created_at' => now(), // Carbon instance
        ];

        // Append the new comment
        $comments[] = $newComment;

        // Update the comments attribute
        $rescuePost->comments = $comments;
        $rescuePost->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}