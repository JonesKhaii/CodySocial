<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user();  // Lấy người dùng đã đăng nhập

        // Kiểm tra nếu người dùng là bác sĩ
        if ($user->doctor) {  // doctor là mối quan hệ với bảng `doctors`
            // Trả về giao diện bác sĩ trong thư mục doctor
            return view('doctor.profile', compact('user'));
        }

        // Nếu là người dùng thông thường
        return view('user.profile', compact('user'));  // Trả về giao diện người dùng trong thư mục user
    }
}
