<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function profile($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('pages.doctor-profile', compact('doctor'));
    }
}
