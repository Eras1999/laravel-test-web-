<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.Home.news', compact('news'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'title' => 'required|string|max:255',
            'content' => 'required',
            'date' => 'required|date',
        ]);

        $imagePath = $request->file('image')->store('news', 'public');

        News::create([
            'image' => $imagePath,
            'title' => $request->title,
            'content' => $request->content,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'News added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'title' => 'required|string|max:255',
            'content' => 'required',
            'date' => 'required|date',
        ]);

        $news = News::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $imagePath = $request->file('image')->store('news', 'public');
            $news->image = $imagePath;
        }

        $news->title = $request->title;
        $news->content = $request->content;
        $news->date = $request->date;
        $news->save();

        return redirect()->back()->with('success', 'News updated successfully!');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();

        return redirect()->back()->with('success', 'News deleted successfully!');
    }
}