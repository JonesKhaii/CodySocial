<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        // Lấy thông tin người dùng từ session hoặc Auth
        $user = Auth::user();

        // Nếu không có người dùng đã đăng nhập, chuyển hướng đến trang đăng nhập
        if (!$user) {
            return redirect()->route('login');
        }

        // Trả về view và truyền dữ liệu người dùng
        return view('user.profile', compact('user'));
    }
}
