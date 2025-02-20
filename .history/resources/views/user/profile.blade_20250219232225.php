@extends('layouts.master')

@section('main-content')
    <div class="container-fluid py-4">
        <!-- Page Heading -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thông Tin Cá Nhân</h1>
            <a href="#" class="btn btn-primary btn-sm">
                <i class="fas fa-edit fa-sm mr-1"></i> Chỉnh Sửa
            </a>
        </div>

        <div class="row">
            <!-- Thông tin cơ bản và ảnh -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow">
                    <div class="card-body py-4 text-center">
                        @if ($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Ảnh Người Dùng"
                                class="img-profile rounded-circle mb-3"
                                style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #f8f9fc;">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Ảnh Mặc Định"
                                class="img-profile rounded-circle mb-3"
                                style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #f8f9fc;">
                        @endif
                        <h4 class="font-weight-bold mb-1">{{ $user->name }}</h4>
                        <p class="text-muted mb-2">{{ ucfirst($user->role) }}</p>
                        <span class="badge badge-{{ $user->status ? 'success' : 'danger' }} px-3 py-2">
                            {{ $user->status ? 'Đang Hoạt Động' : 'Tài Khoản Bị Khóa' }}
                        </span>

                        <div class="mt-3">
                            <button class="btn btn-sm btn-light mr-2"><i class="fas fa-camera"></i> Thay Ảnh</button>
                            <button class="btn btn-sm btn-light"><i class="fas fa-key"></i> Đổi Mật Khẩu</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin liên hệ -->
            <div class="col-lg-8">
                <div class="card mb-4 shadow">
                    <div class="card-header bg-primary py-3">
                        <h6 class="font-weight-bold m-0 text-white"><i class="fas fa-user mr-2"></i>Thông Tin Liên Hệ</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3 text-muted">Email</div>
                            <div class="col-md-9">
                                <i class="fas fa-envelope text-primary mr-2"></i>
                                {{ $user->email }}
                                @if ($user->email_verified_at)
                                    <span class="badge badge-success ml-2">Đã xác thực</span>
                                @else
                                    <span class="badge badge-warning ml-2">Chưa xác thực</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 text-muted">Số Điện Thoại</div>
                            <div class="col-md-9">
                                <i class="fas fa-phone text-primary mr-2"></i>
                                {{ $user->phone ?: 'Chưa cập nhật' }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 text-muted">Địa Chỉ</div>
                            <div class="col-md-9">
                                <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                {{ $user->address ?: 'Chưa cập nhật' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 text-muted">Tỉnh/Thành Phố</div>
                            <div class="col-md-9">
                                <i class="fas fa-city text-primary mr-2"></i>
                                {{ $user->province ?: 'Chưa cập nhật' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thông tin tài khoản -->
                <div class="card shadow">
                    <div class="card-header bg-info py-3">
                        <h6 class="font-weight-bold m-0 text-white"><i class="fas fa-info-circle mr-2"></i>Thông Tin Tài
                            Khoản</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3 text-muted">ID Người Dùng</div>
                            <div class="col-md-9">
                                <span class="badge badge-light">#{{ $user->id }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 text-muted">Ngày Đăng Ký</div>
                            <div class="col-md-9">
                                <i class="far fa-calendar-alt text-primary mr-2"></i>
                                {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 text-muted">Đăng Nhập Lần Cuối</div>
                            <div class="col-md-9">
                                <i class="far fa-clock text-primary mr-2"></i>
                                2 giờ trước
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border: none;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .bg-primary {
            background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
        }

        .bg-info {
            background: linear-gradient(90deg, #36b9cc 0%, #1a8a98 100%);
        }

        .img-profile {
            transition: all 0.3s;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .img-profile:hover {
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: #4e73df;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
        }
    </style>
@endpush
