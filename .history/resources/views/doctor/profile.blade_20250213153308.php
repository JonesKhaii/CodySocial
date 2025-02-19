@extends('layouts.master')

@section('main-content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trang Cá Nhân Của Bác Sĩ</h1>
        </div>

        <!-- Thông tin cá nhân -->
        <div class="card mb-4 shadow-lg">
            <div class="card-header bg-primary py-3 text-white">
                <h6 class="font-weight-bold m-0">Thông Tin Cá Nhân</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ $doctor->photo }}" alt="Ảnh Bác Sĩ" class="img-fluid rounded-circle"
                            style="max-width: 150px;">
                    </div>
                    <div class="col-md-8">
                        <p><strong>Họ và Tên:</strong> {{ $doctor->name }}</p>
                        <p><strong>Chuyên Khoa:</strong> {{ $doctor->specialization }}</p>
                        <p><strong>Số Điện Thoại:</strong> {{ $doctor->phone }}</p>
                        <p><strong>Email:</strong> {{ $doctor->email }}</p>
                        <p><strong>Kinh Nghiệm:</strong> {{ $doctor->experience }} năm</p>
                        <p><strong>Địa Chỉ Làm Việc:</strong> {{ $doctor->workplace }}</p>
                        <p><strong>Đánh Giá:</strong> {{ $doctor->rating }} ⭐</p>
                        <p><strong>Điểm Tiếp Thị:</strong> {{ $doctor->points }}</p>
                        <p><strong>Số Người Theo Dõi:</strong> {{ $doctor->followers_count }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh sách bài viết đã tạo -->
        <div class="card mb-4 shadow-lg">
            <div class="card-header bg-success py-3 text-white">
                <h6 class="font-weight-bold m-0">Danh Sách Bài Viết Đã Tạo</h6>
            </div>
            <div class="card-body">
                @if ($posts->isEmpty())
                    <p>Chưa có bài viết nào. Hãy tạo bài viết đầu tiên!</p>
                @else
                    <ul class="list-group">
                        @foreach ($posts as $post)
                            <li class="list-group-item">
                                <strong>{{ $post->title }}</strong>
                                <div class="float-right">
                                    <a href="{{ route('doctor.posts.edit', $post->id) }}"
                                        class="btn btn-sm btn-warning">Chỉnh sửa</a>
                                    <a href="{{ route('doctor.posts.show', $post->id) }}"
                                        class="btn btn-sm btn-info">Xem</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <!-- Nút tạo bài viết mới -->
                <a href="{{ route('doctor.posts.create') }}" class="btn btn-primary mt-3">+ Tạo Bài Viết Mới</a>
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

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .card-header {
            background-color: #f8f9fc;
            color: #333;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
        }

        .list-group-item {
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .list-group-item:hover {
            background-color: #f1f1f1;
        }

        .btn {
            margin-right: 5px;
        }
    </style>
@endpush
