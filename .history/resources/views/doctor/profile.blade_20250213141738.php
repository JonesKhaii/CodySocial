@extends('layouts.master')

@section('main-content')
    <div class="container-fluid">
        {{-- @include('doctor.layouts.notification') --}}

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trang Cá Nhân Của Bác Sĩ</h1>
        </div>

        <!-- Thông tin cá nhân -->
        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <h6 class="font-weight-bold text-primary m-0">Thông Tin Cá Nhân</h6>
            </div>
            <div class="card-body">
                <p><strong>Họ và Tên:</strong> {{ $doctor->name }}</p>
                <p><strong>Chuyên Khoa:</strong> {{ $doctor->specialization }}</p>
                <p><strong>Số Điện Thoại:</strong> {{ $doctor->phone }}</p>
                <p><strong>Email:</strong> {{ $doctor->email }}</p>
                <p><strong>Kinh Nghiệm:</strong> {{ $doctor->experience }} năm</p>
                <p><strong>Địa Chỉ Làm Việc:</strong> {{ $doctor->workplace }}</p>
                <p><strong>Đánh Giá:</strong> {{ $doctor->rating }} ⭐</p>
                <p><strong>Điểm Tiếp Thị:</strong> {{ $doctor->points }}</p>
                <p><strong>Số Người Theo Dõi:</strong> {{ $doctor->followers_count }}</p>
                <img src="{{ asset('storage/' . $doctor->photo) }}" alt="Ảnh Bác Sĩ" class="img-thumbnail"
                    style="width: 150px;">
            </div>
        </div>

        <!-- Danh sách bài viết đã tạo -->
        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <h6 class="font-weight-bold text-success m-0">Danh Sách Bài Viết Đã Tạo</h6>
            </div>
            <div class="card-body">
                @if ($posts->isEmpty())
                    <p>Chưa có bài viết nào.</p>
                @else
                    <ul>
                        @foreach ($posts as $post)
                            <li>
                                <strong>{{ $post->title }}</strong> -
                                <a href="{{ route('doctor.posts.edit', $post->id) }}">Chỉnh sửa</a> |
                                <a href="{{ route('doctor.posts.show', $post->id) }}">Xem</a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <!-- Nút tạo bài viết mới -->
                <a href="" class="btn btn-primary mt-3">+ Tạo Bài Viết Mới</a>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <style>
        .sidebar {
            background-color: #0924ec !important;
            background-image: linear-gradient(113deg, #314aff 10%, #60616f 100%) !important;
            background-size: cover !important;
        }

        .img-thumbnail {
            max-width: 150px;
            border-radius: 50%;
        }

        .card-header {
            background-color: #f8f9fc;
        }
    </style>
@endpush
