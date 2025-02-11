<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Doctor;
use App\Models\PostCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy danh sách bài viết mới nhất, chỉ lấy các cột cần thiết
        $posts = Post::select('id', 'title', 'slug', 'summary', 'photo', 'post_cat_id', 'post_tag_id', 'added_by', 'created_at')
            ->where('status', 'active')
            ->with([
                'cat_info:id,title', // Lấy tiêu đề danh mục bài viết
                'tag_info:id,title', // Lấy tên các tag liên kết với bài viết
                'author_info:id,name', // Lấy thông tin tác giả (name)
            ])
            ->latest()
            ->paginate(6); // Phân trang (6 bài viết mỗi trang)



        $topDoctors = Doctor::select('id', 'name', 'specialization as field', 'photo')
            ->where('status', true) // Chỉ lấy bác sĩ đang hoạt động
            ->orderByDesc('rating') // Lấy bác sĩ có rating cao nhất
            ->limit(4) // Giới hạn số lượng
            ->get();

        $categories = PostCategory::select('id', 'title', 'slug')
            ->where('status', 'active') // Chỉ lấy danh mục đang hoạt động
            ->orderBy('title') // Sắp xếp theo tên danh mục
            ->get();

        return view(' index', compact('posts', 'topDoctors', 'categories'));
    }
}
