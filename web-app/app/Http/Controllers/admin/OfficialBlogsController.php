<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OfficialBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficialBlogsController extends Controller
{
    public function index()
    {
        $blogs = OfficialBlog::orderBy('date', 'desc')->paginate(10);
        return view('admin.blogs.official_blogs', compact('blogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
        ]);

        $imagePath = $request->file('image')->store('official_blogs', 'public');

        OfficialBlog::create([
            'image' => $imagePath,
            'title' => $request->title,
            'content' => $request->content,
            'date' => $request->date,
        ]);

        return redirect()->route('official_blogs.index')->with('success', 'Official blog added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
        ]);

        $blog = OfficialBlog::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($blog->image);
            $imagePath = $request->file('image')->store('official_blogs', 'public');
            $blog->image = $imagePath;
        }

        $blog->update([
            'image' => $blog->image,
            'title' => $request->title,
            'content' => $request->content,
            'date' => $request->date,
        ]);

        return redirect()->route('official_blogs.index')->with('success', 'Official blog updated successfully!');
    }

    public function destroy($id)
    {
        $blog = OfficialBlog::findOrFail($id);
        Storage::disk('public')->delete($blog->image);
        $blog->delete();

        return redirect()->route('official_blogs.index')->with('success', 'Official blog deleted successfully!');
    }

    public function show()
    {
        $blogs = OfficialBlog::orderBy('date', 'desc')->paginate(6);
        return view('frontend.official-blogs', compact('blogs'));
    }

    public function showDetail($id)
    {
        $blog = OfficialBlog::findOrFail($id);
        return view('frontend.official-blog-detail', compact('blog'));
    }
}