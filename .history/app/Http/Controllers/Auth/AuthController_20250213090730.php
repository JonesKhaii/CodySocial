<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

// class AuthController extends Controller
// {
//     // Hiển thị form đăng nhập
//     public function showLogin()
//     {
//         return view('auth.login');
//     }

//     // Xử lý đăng nhập với tư cách là người dùng
//     public function processLogin(Request $request)
//     {
//         $credentials = $request->validate([
//             'phone' => 'required|string',
//             'password' => 'required|min:6',
//         ]);

//         if (Auth::attempt(['phone' => $credentials['phone'], 'password' => $credentials['password']], $request->filled('remember'))) {
//             return redirect()->intended(route('home'));
//         }

//         return back()->withErrors(['phone' => 'Số điện thoại hoặc mật khẩu không đúng']);
//     }
//     // Xử lý đăng nhập với tư cách là người dùng
//     public function loginAsDoctor(Request $request)
//     {
//         $credentials = $request->only('phone', 'password');

//         // Kiểm tra trong bảng doctors
//         $doctor = Doctor::where('phone', $credentials['phone'])->first();

//         if ($doctor && Hash::check($credentials['password'], $doctor->password)) {
//             Auth::loginUsingId($doctor->id);  // Đăng nhập bác sĩ
//             return redirect()->intended('/doctor/dashboard');  // Điều hướng đến dashboard bác sĩ
//         }

//         return back()->withErrors(['phone' => 'Thông tin đăng nhập không đúng']);
//     }


//     // Hiển thị form đăng ký
//     public function showRegister()
//     {
//         return view('auth.register');
//     }

//     // Xử lý đăng ký
//     public function processRegister(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'phone' => 'required|string|unique:users|min:10|max:15',
//             'email' => 'required|email|unique:users|max:255',
//             'password' => 'required|min:6|confirmed',
//         ]);

//         User::create([
//             'name' => $request->name,
//             'phone' => $request->phone,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//         ]);

//         return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
//     }


//     // Xử lý đăng xuất
//     public function logout()
//     {
//         Auth::logout();
//         return redirect()->route('login');
//     }
// }
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
                return redirect()->intended(route('home'));  // Điều hướng đến trang chủ người dùng
            }
        } elseif ($credentials['role'] == 'doctor') {
            // Đăng nhập bác sĩ từ bảng doctors
            $doctor = Doctor::where('phone', $credentials['phone'])->first();

            if ($doctor && Hash::check($credentials['password'], $doctor->password)) {
                Auth::loginUsingId($doctor->id);  // Đăng nhập bác sĩ
                return redirect()->intended('/doctor/dashboard');  // Điều hướng đến dashboard bác sĩ
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
    public function processRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users|min:10|max:15',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    // Xử lý đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
