<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
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
            'image' => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
        ]);

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $imageUrl = app(ImageController::class)->uploadImage($request);
        } else {
            $imageUrl = null;
        }

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->summary = $request->summary;
        $post->description = $request->description;
        $post->post_cat_id = $request->post_cat_id;
        $post->photo = $imageUrl;
        $post->status = 'active';
        $post->added_by = $doctor->id;
        $post->save();

        // Load lại danh mục bài viết
        $categories = PostCategory::where('status', 'active')->get();

        return redirect()->back()->with('success', 'Bài viết đã được tạo thành công!');
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'post_cat_id' => 'required|exists:post_categories,id',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->summary = $request->summary;
        $post->description = $request->description;
        $post->post_cat_id = $request->post_cat_id;

        $post->save();

        return redirect()->back()->with('success', 'Bài viết đã được cập nhật!');
    }
}
