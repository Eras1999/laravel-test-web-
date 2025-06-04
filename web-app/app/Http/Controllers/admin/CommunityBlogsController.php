<?php

   namespace App\Http\Controllers\Admin;

   use App\Http\Controllers\Controller;
   use App\Models\CommunityBlog;
   use Illuminate\Http\Request;

   class CommunityBlogsController extends Controller
   {
       public function index()
       {
           $blogs = CommunityBlog::all(); // Fetch all blogs
           return view('admin.blogs.community_blogs', compact('blogs'));
       }

       public function update(Request $request, $id)
       {
           $blog = CommunityBlog::findOrFail($id);
           $request->validate(['status' => 'required|in:pending,approved,rejected']);
           $blog->update(['status' => $request->status]);

           // If the blog is approved, pass its details to the session
           if ($request->status === 'approved') {
               return redirect()->route('admin.community-blogs.index')->with('success', 'Blog status updated successfully.')
                   ->with('approved_blog', [
                       'title' => $blog->title,
                       'author_name' => $blog->author_name ?? $blog->user->name,
                       'date' => $blog->date,
                       'content' => $blog->content,
                       'image' => $blog->image,
                   ]);
           }

           return redirect()->route('admin.community-blogs.index')->with('success', 'Blog status updated successfully.');
       }

       public function destroy($id)
       {
           $blog = CommunityBlog::findOrFail($id);
           $blog->delete();

           return redirect()->route('admin.community-blogs.index')->with('success', 'Blog deleted successfully.');
       }
   }