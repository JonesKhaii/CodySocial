<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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

    public function getAppointments()
    {
        $user = Auth::guard('web')->user(); // Lấy user đăng nhập

        if (!$user) {
            return redirect()->route('login');
        }

        // Lấy danh sách lịch khám của người dùng hiện tại
        $appointments = Appointment::where('user_id', $user->id)
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        return view('user.appointments', compact('appointments'));
    }
}
