@extends('layouts.master')

@section('title', 'Danh Sách Bác Sĩ')

@section('main-content')
    <div class="container mt-4">
        <h3 class="mb-4 text-center">Danh Sách Bác Sĩ</h3>
        <div class="row">
            @foreach ($doctors as $doctor)
                <div class="col-md-4">
                    <div class="doctor-card">
                        <div class="d-flex align-items-center">
                            <img src="{{ $doctor->photo ? Storage::disk('s3')->url($doctor->photo) : asset('images/default-doctor.png') }}"
                                class="profile-photo">
                            <div>
                                <h5><a href="{{ route('doctor.profile', $doctor->id) }}">{{ $doctor->name }}</a></h5>
                                <p>{{ $doctor->specialty }}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <button class="btn btn-primary w-50 me-1">Đặt Lịch</button>
                            <button class="btn btn-outline-success w-50 follow-btn"
                                data-doctor="{{ $doctor->name }}">Follow</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Hiển thị phân trang -->
        <div class="d-flex justify-content-center mt-4">
            {{ $doctors->links() }}
        </div>
    </div>
@endsection
