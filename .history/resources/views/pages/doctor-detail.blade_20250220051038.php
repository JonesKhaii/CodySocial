@extends('layouts.master')

@section('title', 'Hồ Sơ Bác Sĩ | ' . $doctor->name)

@section('main-content')
    <div class="container mt-4">
        <div class="row">
            <!-- Hồ sơ bác sĩ -->
            <div class="col-md-4">
                <div class="profile-card text-center">
                    <img src="{{ $doctor->photo ? Storage::disk('s3')->url($doctor->photo) : asset('images/default-doctor.png') }}"
                        class="profile-photo">
                    <h4>{{ $doctor->name }}</h4>
                    <p>{{ $doctor->specialization }}</p>
                    <div class="d-flex justify-content-between mt-2">
                        <button class="btn btn-primary w-50 me-1">Đặt Lịch Khám</button>
                        <button class="btn btn-outline-success w-50">Theo Dõi</button>
                    </div>
                </div>
                <div class="profile-card">
                    <h5>Thông Tin Liên Hệ</h5>
                    <p><i class="fas fa-envelope"></i> {{ $doctor->email }}</p>
                    <p><i class="fas fa-phone"></i> {{ $doctor->phone }}</p>
                </div>
            </div>

            <!-- Thông tin bác sĩ & bài viết -->
            <div class="col-md-8">
                <div class="profile-card">
                    <h5>Giới Thiệu Bác Sĩ</h5>
                    <p>{{ $doctor->bio }}</p>
                </div>

                <!-- Danh sách bài viết -->
                @if ($doctor->posts->count() > 0)
                    <div class="profile-card">
                        <h5>Bài Viết Của Bác Sĩ</h5>
                        <div class="row">
                            @foreach ($doctor->posts as $post)
                                <div class="col-md-4">
                                    <div class="article-card">
                                        <img src="{{ $post->image }}" alt="Bài viết">
                                        <h6 class="mt-2">{{ $post->title }}</h6>
                                        <p class="text-muted">{{ Str::limit($post->summary, 50) }}</p>
                                        <a href="#" class="btn btn-sm btn-primary">Xem chi tiết</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="profile-card">
                        <h5>Bác sĩ chưa có bài viết nào.</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
