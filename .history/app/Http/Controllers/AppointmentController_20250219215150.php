<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('id', Auth::id())->get();
        return view('doctor.appointment.index', compact('appointments'));
    }


    /**
     * Xử lý đặt lịch hẹn và lưu vào bảng appointments
     */
    public function store(Request $request)
    {
        // Kiểm tra nếu bác sĩ tồn tại
        $doctor = Doctor::where('id', $request->doctorID)->first();
        if (!$doctor) {
            return redirect()->back()->with('error', 'Bác sĩ không tồn tại.');
        }

        try {
            $request->validate([
                'id' => 'required|exists:doctors,id',
                'date' => 'required|date|after_or_equal:today',
                'time' => 'required',
                'consultation_type' => 'required|in:Online,Offline,Home',
                'note' => 'nullable|string|max:255',
            ]);



            $appointment = Appointment::create([
                'userID' => Auth::id(),
                'id' => $request->doctorID,
                'date' => $request->date,
                'time' => $request->time,
                'consultation_type' => $request->consultation_type,
                'note' => $request->note,
                'status' => 'Chờ duyệt',
                'approval_status' => 'Chờ duyệt',
                'workflow_stage' => 'initial_review',
            ]);

            return redirect()->route('home')->with('success', 'Đặt lịch thành công!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Đã xảy ra lỗi trong quá trình đặt lịch.');
        }
    }


    public function create($id)
    {
        $doctor = Doctor::where('id', $id)->firstOrFail();
        return view('frontend.pages.appointment_form', compact('doctor'));
    }


    public function approveAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->status === 'Chờ duyệt' && $appointment->approval_status === 'Chờ duyệt') {
            $appointment->update([
                'status' => 'Sắp tới',
                'approval_status' => 'Chấp nhận',
            ]);
        }

        return redirect()->back()->with('success', 'Lịch hẹn đã được chấp nhận!');
    }

    public function rejectAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->approval_status === 'Chờ duyệt') {
            $appointment->update(['approval_status' => 'Từ chối']);
        }

        return redirect()->back()->with('success', 'Lịch hẹn đã bị từ chối.');
    }

    public function completeAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->status === 'Sắp tới' && $appointment->approval_status === 'Chấp nhận') {
            $appointment->update(['status' => 'Hoàn thành']);
        }

        return redirect()->back()->with('success', 'Lịch hẹn đã hoàn thành.');
    }
}
