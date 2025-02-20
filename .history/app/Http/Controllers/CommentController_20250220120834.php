<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
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
}
