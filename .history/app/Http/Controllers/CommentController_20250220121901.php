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
        $user = auth()->guard('web')->user(); // Lấy user từ guard web
        $doctor = auth()->guard('doctor')->user(); // Lấy doctor từ guard doctor

        // Debug log để kiểm tra Laravel có nhận diện đúng hay không
        \Log::info("Session role: " . session('role'));
        \Log::info("Guard web:", [$user]);
        \Log::info("Guard doctor:", [$doctor]);

        // Nếu cả user và doctor đều null, chặn bình luận
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
