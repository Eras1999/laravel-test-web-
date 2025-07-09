<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdoptionPost;
use Illuminate\Http\Request;

class AdoptionPostsController extends Controller
{
    public function index()
    {
        $posts = AdoptionPost::withTrashed()->get();
        return view('admin.adoption_posts.adoption_posts', compact('posts'));
    }

    public function update(Request $request, $id)
    {
        $post = AdoptionPost::findOrFail($id);
        $status = $request->input('status');

        if (in_array($status, ['pending', 'approved', 'rejected', 'expired', 'adopted'])) {
            $post->update(['status' => $status, 'approved_at' => $status === 'approved' ? now() : null]);
            return redirect()->route('admin.adoption-posts.index')->with('success', "Post status updated to $status.");
        }
        return redirect()->route('admin.adoption-posts.index')->with('error', 'Invalid status update.');
    }

    public function delete($id)
    {
        $post = AdoptionPost::withTrashed()->findOrFail($id);
        if ($post->trashed()) {
            $post->forceDelete();
        } else {
            $post->delete();
        }
        return redirect()->route('admin.adoption-posts.index')->with('success', 'Post deleted successfully.');
    }
}