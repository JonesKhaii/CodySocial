<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{


    public function index()
    {

        $categories = PostCategory::all();

        return view('doctor.profile', compact('categories'));
    }

    public function detail($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'active')->firstOrFail();
        // $post = Post::where('slug', $slug)->firstOrFail();

        // Lấy các bình luận liên quan đến bài viết
        $comments = $post->comments()->with('author_info', 'replies')->get();

        // Lấy các bài viết gần đây
        $recent_posts = Post::latest()->take(5)->get();

        // Lấy danh mục bài viết
        $categories = PostCategory::all();

        return view('pages.post-detail', compact('post', 'comments', 'recent_posts', 'categories'));
        return view('pages.post-detail', compact('post'));
    }

    public function create()
    {
        $categories = PostCategory::where('status', 'active')->get();
        return view('doctor.profile', compact('categories'));
    }

    public function store(Request $request)
    {
        $doctor = auth()->guard('doctor')->user();

        if (!$doctor) {
            return redirect()->back()->with('error', 'Bạn không có quyền đăng bài.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'post_cat_id' => 'required|exists:post_categories,id',
            'photo' => 'nullable|image|mimes:wepb,jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->summary = $request->summary;
        $post->description = $request->description;
        $post->post_cat_id = $request->post_cat_id;
        $post->status = 'active';
        $post->added_by = $doctor->id;

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/posts'), $imageName);
            $post->photo = 'uploads/posts/' . $imageName;
        }

        $post->save();

        // 🛠 Load lại danh mục bài viết để tránh lỗi thiếu `$categories`
        $categories = PostCategory::where('status', 'active')->get();

        return redirect()->back()->with('success', 'Bài viết đã được tạo thành công!');
    }

    public function show($id)
    {
        $post = Post::with('cat_info')->findOrFail($id);
        return view('posts.show', compact('post'));
    }
}
