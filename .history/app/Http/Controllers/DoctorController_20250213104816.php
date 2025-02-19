<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function profile()
    {
        $doctor = Auth::user();
        return view('doctor.profile', compact('doctor'));
    }
}
