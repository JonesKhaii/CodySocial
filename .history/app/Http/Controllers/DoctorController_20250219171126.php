<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;



class DoctorController extends Controller
{
    public function profile()
    {
        $doctor = Auth::guard('doctor')->user(); // Sử dụng guard doctor để lấy thông tin bác sĩ
        if (!$doctor) {
            return redirect()->route('login'); // Nếu không phải bác sĩ, chuyển hướng về trang đăng nhập
        }
        // dd($doctor);
        $posts = Post::where('added_by', $doctor->id)->get();

        if (!Auth::guard('doctor')->check()) {
            return redirect()->route('login');  // Nếu không phải bác sĩ, điều hướng về trang đăng nhập
        }

        $categories = PostCategory::where('status', 'active')->get();
        $doctor_id = Auth::guard('doctor')->id();
        $products = DB::table('affiliate_links')
            ->join('products', 'affiliate_links.product_id', '=', 'products.id')
            ->where('affiliate_links.doctor_id', $doctor_id)
            ->select('products.id', 'products.title', 'products.photo', 'products.price', 'products.discount')
            ->get();
        // dd($products);
        $appointments = Appointment::where('doctor_id', $doctor_id)
            ->with(['user:id,name,email,phone']) // Lấy thông tin bệnh nhân
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get(['user_id', 'date', 'time', 'status', 'approval_status', 'notes', 'consultation_type']);


        return view('doctor.profile', compact('doctor', 'posts', 'categories', 'products'));
    }
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->only(['name', 'phone', 'email', 'workplace']));

        return redirect()->back()->with('success', 'Thông tin đã được cập nhật.');
    }

    public function getAffilateProduct($doctor_id)
    {
        $products = DB::table('doctor_products')
            ->join('products', 'doctor_products.product_id', '=', 'products.id')
            ->where('doctor_products.doctor_id', $doctor_id)
            ->select('products.id', 'products.title', 'products.photo', 'products.price', 'products.discount')
            ->get();

        return view('doctor.profile', compact('products'));
    }

    public function getAppointments()
    {
        $doctor = Auth::guard('doctor')->user();

        if (!$doctor) {
            return redirect()->route('login');
        }

        // Lấy danh sách lịch khám của bác sĩ hiện tại (bạn có thể uncomment phần code gốc)
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        return view('doctor.appointments', compact('appointments'));
    }
}
