<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// class DoctorController extends Controller
// {
//     public function profile()
//     {
//         $doctor = Auth::user();
//         if (!$doctor || $doctor->role != 'doctor') {
//             return redirect()->route('login'); // Nếu không phải bác sĩ, chuyển hướng đến trang đăng nhập
//         }


//         return view('doctor.profile', compact('doctor'));
//     }
// }


class DoctorController extends Controller
{
    public function profile()
    {
        $doctor = Auth::user();  // Lấy thông tin bác sĩ từ session
        $posts = Post::where('added_by', $doctor->id)->get();

        if (session('role') != 'doctor') {
            return redirect()->route('login');  // Nếu không phải bác sĩ, điều hướng về trang đăng nhập
        }

        return view('doctor.profile', compact('doctor', 'post'));
    }
}
