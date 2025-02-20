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

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'comment' => $request->comment,
            'status' => 'active',
            'parent_id' => $request->parent_id,
            'replied_comment' => $request->parent_id ? $request->replied_comment : null
        ]);

        return back()->with('success', 'Bình luận của bạn đã được thêm.');
    }
}
