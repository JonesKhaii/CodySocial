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


    public function approveAppointment($appointmentID)
    {
        try {
            $appointment = Appointment::where('id', $appointmentID)->firstOrFail();

            if ($appointment->status !== 'Chờ duyệt' || $appointment->approval_status !== 'Chờ duyệt') {
                return response()->json(['message' => 'Lịch hẹn đã được xử lý trước đó.'], 400);
            }

            $appointment->update([
                'status' => 'Sắp tới',
                'approval_status' => 'Chấp nhận',
            ]);

            return response()->json([
                'message' => 'Lịch hẹn đã được xác nhận thành công.',
                'appointment' => $appointment
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi khi xác nhận lịch hẹn.', 'error' => $e->getMessage()], 500);
        }
    }

    public function rejectAppointment($appointmentID)
    {
        try {
            $appointment = Appointment::where('id', $appointmentID)->firstOrFail();

            if ($appointment->status !== 'Chờ duyệt' || $appointment->approval_status !== 'Chờ duyệt') {
                return response()->json(['message' => 'Lịch hẹn đã được xử lý trước đó.'], 400);
            }

            $appointment->update([
                'status' => 'Đã Huỷ',
                'approval_status' => 'Từ chối',
            ]);

            return response()->json([
                'message' => 'Lịch hẹn đã bị từ chối.',
                'appointment' => $appointment
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi khi từ chối lịch hẹn.', 'error' => $e->getMessage()], 500);
        }
    }

    public function completeAppointment($appointmentID)
    {
        try {
            $appointment = Appointment::where('id', $appointmentID)->firstOrFail();

            if ($appointment->status !== 'Sắp tới' || $appointment->approval_status !== 'Chấp nhận') {
                return response()->json(['message' => 'Lịch hẹn không thể hoàn thành.'], 400);
            }

            $appointment->update([
                'status' => 'Hoàn thành',
            ]);

            return response()->json([
                'message' => 'Lịch hẹn đã hoàn thành thành công.',
                'appointment' => $appointment
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi khi hoàn thành lịch hẹn.', 'error' => $e->getMessage()], 500);
        }
    }

    public function cancelAppointment($appointmentID)
    {
        try {
            $appointment = Appointment::where('id', $appointmentID)->firstOrFail();

            if ($appointment->status === 'Hoàn thành') {
                return response()->json(['message' => 'Không thể hủy lịch hẹn đã hoàn thành.'], 400);
            }

            $appointment->update([
                'status' => 'Đã Huỷ',
            ]);

            return response()->json([
                'message' => 'Lịch hẹn đã bị hủy.',
                'appointment' => $appointment
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi khi hủy lịch hẹn.', 'error' => $e->getMessage()], 500);
        }
    }
}
