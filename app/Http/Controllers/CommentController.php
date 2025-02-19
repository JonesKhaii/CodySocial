<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Phương thức để lưu bình luận
    public function store(Request $request, $slug)
    {
        // Validate dữ liệu từ form bình luận
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        // Lấy bài viết theo slug
        $post = Post::where('slug', $slug)->firstOrFail();

        // Lưu bình luận vào cơ sở dữ liệu
        PostComment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),  // Lưu ID người dùng đã đăng nhập
            'body' => $request->comment,
            'parent_id' => $request->parent_id,  // Nếu là trả lời, lưu parent_id
        ]);

        return redirect()->route('post.detail', ['slug' => $slug])->with('success', 'Bình luận đã được đăng.');
    }
}
