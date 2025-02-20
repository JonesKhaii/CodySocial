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
        $categories = PostCategory::select('post_categories.id', 'post_categories.title', 'post_categories.slug')
            ->withCount('posts') // Tính số bài viết trong từng danh mục
            ->where('status', 'active') // Chỉ lấy danh mục đang hoạt động
            ->orderBy('title') // Sắp xếp theo tên danh mục
            ->get();


        return view('pages.post-detail', compact('post', 'comments', 'recent_posts', 'categories'));
    }

    public function create()
    {
        $categories = PostCategory::where('status', 'active')->get();
        return view('doctor.profile', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        // Kiểm tra xem user đăng nhập từ đâu (user hoặc doctor)
        $user = auth()->guard('web')->user(); // Lấy user từ guard web
        $doctor = auth()->guard('doctor')->user(); // Lấy doctor từ guard doctor

        // Nếu không có user hoặc doctor -> Chặn bình luận
        if (!$user && !$doctor) {
            return back()->with('error', 'Bạn cần đăng nhập để bình luận.');
        }

        // Xác định ID của người bình luận (user hoặc doctor)
        $commenterId = $user ? $user->id : $doctor->id;

        Comment::create([
            'user_id' => $commenterId, // Dùng chung cột user_id
            'post_id' => $request->post_id,
            'comment' => $request->comment,
            'status' => 'active',
            'parent_id' => $request->parent_id,
            'replied_comment' => $request->parent_id ? $request->replied_comment : null
        ]);

        return back()->with('success', 'Bình luận của bạn đã được thêm.');
    }

    // public function show($slug)
    // {
    //     $post = Post::where('slug', $slug)->with([
    //         'comments.author_info', // Lấy thông tin người bình luận
    //         'comments.replies.author_info' // Lấy thông tin của bình luận con
    //     ])->firstOrFail();
    //     return view('posts.show', compact('post'));
    // }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->with([
                'comments' => function ($query) {
                    $query->where('status', 'active')
                        ->select('id', 'user_id', 'post_id', 'comment', 'parent_id', 'created_at');
                },
                'comments.author_info:id,name,photo',
                'comments.replies' => function ($query) {
                    $query->where('status', 'active')
                        ->select('id', 'user_id', 'post_id', 'comment', 'parent_id', 'created_at');
                },
                'comments.replies.author_info:id,name,photo'
            ])
            ->withCount('comments')
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }


    public function update(Request $request, $id)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'post_cat_id' => 'required|exists:post_categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate ảnh nếu có
        ]);

        // Lấy bài viết cần chỉnh sửa
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->summary = $request->summary;
        $post->description = $request->description;
        $post->post_cat_id = $request->post_cat_id;

        // Kiểm tra xem người dùng có upload ảnh mới hay không
        if ($request->hasFile('photo')) {
            // Nếu có ảnh mới, tải ảnh lên S3 và lấy URL của ảnh
            $imageUrl = app(ImageController::class)->uploadImage($request);
            $post->photo = $imageUrl; // Cập nhật ảnh mới vào bài viết
        }

        // Lưu bài viết vào CSDL
        $post->save();

        // Trả về thông báo thành công
        return redirect()->back()->with('success', 'Bài viết đã được cập nhật!');
    }
}
