<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RescuePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RescuePostsController extends Controller
{
    public function index()
    {
        $rescuePosts = RescuePost::orderBy('created_at', 'desc')->get();
        return view('admin.rescue_posts.index', compact('rescuePosts'));
    }

    public function delete($id)
    {
        $rescuePost = RescuePost::findOrFail($id);
        if ($rescuePost->image) {
            Storage::disk('public')->delete($rescuePost->image);
        }
        $rescuePost->delete();
        return redirect()->route('admin.rescue-posts.index')->with('success', 'Rescue post deleted successfully.');
    }

    public function rescued($id)
    {
        $rescuePost = RescuePost::findOrFail($id);
        $rescuePost->update(['rescued' => true]);
        return redirect()->route('admin.rescue-posts.index')->with('success', 'Rescue post marked as rescued.');
    }
}