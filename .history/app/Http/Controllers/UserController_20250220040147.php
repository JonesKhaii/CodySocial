<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Hiển thị trang hồ sơ người dùng
     */
    public function profile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('user.profile', compact('user'));
    }

    /**
     * Hiển thị danh sách lịch khám của người dùng
     */
    public function getAppointments()
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Lấy danh sách lịch khám của user hiện tại, kèm thông tin bác sĩ
        $appointments = Appointment::where('user_id', $user->id)
            ->with('doctor:id,name,specialization,photo')
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();
        $doctors = \App\Models\Doctor::all(['id', 'name', 'specialization']);

        return view('user.appointments', compact('appointments', 'doctors'));
    }

    /**
     * Đặt lịch khám mới
     */
    public function bookAppointment(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'consultation_type' => 'required|in:clinic,online',
            'notes' => 'nullable|string'
        ]);

        $user = Auth::guard('web')->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đặt lịch khám.');
        }

        // Tạo lịch hẹn mới
        Appointment::create([
            'user_id' => $user->id,
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'time' => $request->time,
            'consultation_type' => $request->consultation_type,
            'status' => 'Chờ duyệt',
            'approval_status' => 'Chờ duyệt',
            'notes' => $request->notes
        ]);

        return redirect()->route('user.appointments')->with('success', 'Lịch khám đã được đặt thành công.');
    }

    /**
     * Hủy lịch khám
     */
    public function cancelAppointment($id)
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $appointment = Appointment::where('id', $id)
            ->where('user_id', $user->id)
            ->where('status', 'Chờ duyệt')
            ->first();

        if (!$appointment) {
            return back()->with('error', 'Lịch hẹn không thể hủy.');
        }

        $appointment->update(['status' => 'Đã Huỷ']);

        return back()->with('success', 'Lịch hẹn đã được hủy.');
    }
    // Tìm kiếm bác sĩ 
    public function searchDoctors(Request $request)
    {
        $query = $request->input('term');

        $doctors = \App\Models\Doctor::where('name', 'LIKE', "%{$query}%")
            ->orWhere('specialization', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'specialization']);

        return response()->json($doctors);
    }

    public function updateProfile(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate input
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Upload image if exists
            if ($request->hasFile('photo')) {
                $imageUrl = $this->uploadImage($request);
                if ($imageUrl) {
                    // Delete old image if it exists
                    if ($user->photo) {
                        Storage::disk('s3')->delete($user->photo);
                    }
                    // Update new photo URL
                    $user->photo = $imageUrl;
                }
            }

            // Update user info
            $user->name     = $request->name;
            $user->phone    = $request->phone;
            $user->address  = $request->address;
            $user->province = $request->province;
            $user->save();

            return response()->json(['message' => 'Cập nhật thông tin thành công!', 'user' => $user], 200);
        } catch (\Exception $e) {
            Log::error('Lỗi cập nhật hồ sơ: ' . $e->getMessage());
            return response()->json(['error' => 'Không thể cập nhật hồ sơ'], 500);
        }
    }
}
