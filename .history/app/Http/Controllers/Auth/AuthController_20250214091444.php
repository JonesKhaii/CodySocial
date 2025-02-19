<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLogin()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|min:6',
            'role' => 'required|string|in:user,doctor',  // Thêm kiểm tra role
        ]);

        // Kiểm tra vai trò người dùng
        if ($credentials['role'] == 'user') {
            // Đăng nhập người dùng từ bảng users
            $user = User::where('phone', $credentials['phone'])->first();

            if ($user && Hash::check($credentials['password'], $user->password)) {
                Auth::login($user);

                // Lưu vai trò vào session
                session(['role' => 'user']);  // Lưu vai trò vào session

                return redirect()->intended(route('home'));  // Điều hướng đến trang chủ người dùng
            }
        } elseif ($credentials['role'] == 'doctor') {
            // Đăng nhập bác sĩ từ bảng doctors
            $doctor = Doctor::where('phone', $credentials['phone'])->first();

            if ($doctor && Hash::check($credentials['password'], $doctor->password)) {
                Auth::loginUsingId($doctor->id);  // Đăng nhập bác sĩ

                // Lưu vai trò vào session
                session(['role' => 'doctor']);  // Lưu vai trò vào session

                return redirect()->intended(route('home'));  // Điều hướng đến trang chủ bác sĩ
            }
        }

        return back()->withErrors(['phone' => 'Thông tin đăng nhập không đúng']);
    }




    // Hiển thị form đăng ký
    public function showRegister()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    // Xử lý đăng nhập
    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|min:6',
            'role' => 'required|string|in:user,doctor',  // Kiểm tra role
        ]);

        // Kiểm tra vai trò người dùng
        if ($credentials['role'] == 'user') {
            // Đăng nhập người dùng
            $user = User::where('phone', $credentials['phone'])->first();

            if ($user && Hash::check($credentials['password'], $user->password)) {
                Auth::login($user);
                session(['role' => 'user']); // Lưu role vào session
                return redirect()->intended(route('home')); // Điều hướng đến trang home
            }
        } elseif ($credentials['role'] == 'doctor') {
            // Đăng nhập bác sĩ
            $doctor = Doctor::where('phone', $credentials['phone'])->first();

            if ($doctor && Hash::check($credentials['password'], $doctor->password)) {
                Auth::guard('doctor')->login($doctor); // Đăng nhập bác sĩ với guard 'doctor'
                session(['role' => 'doctor']); // Lưu role bác sĩ vào session
                return redirect()->intended(route('home')); // Điều hướng đến trang bác sĩ
            }
        }

        return back()->withErrors(['phone' => 'Thông tin đăng nhập không đúng']);
    }


    // Xử lý đăng xuất
    public function logout()
    {
        Auth::logout();
        session()->forget('role'); // Xóa role khỏi session khi đăng xuất
        return redirect()->route('login');
    }
}
