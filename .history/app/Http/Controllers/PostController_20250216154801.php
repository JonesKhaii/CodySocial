<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function detail($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $post = Post::where('slug', $slug)->firstOrFail();

        // Lấy các bình luận liên quan đến bài viết
        $comments = $post->comments()->with('author_info', 'replies')->get();

        // Lấy các bài viết gần đây
        $recent_posts = Post::latest()->take(5)->get();

        // Lấy danh mục bài viết
        $categories = Category::all();

        return view('pages.post-detail', compact('post', 'comments', 'recent_posts', 'categories'));
        return view('pages.post-detail', compact('post'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->summary = $request->summary;
        $post->description = $request->description;
        $post->status = 'active';
        $post->added_by = auth()->id();

        // Xử lý ảnh nếu có upload
        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/posts'), $imageName);
            $post->photo = 'uploads/posts/' . $imageName;
        }

        $post->save();

        return redirect()->back()->with('success', 'Bài viết đã được tạo thành công!');
    }
}
