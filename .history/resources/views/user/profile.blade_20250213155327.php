@extends('layouts.master')

@section('main-content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trang Cá Nhân Của Người Dùng</h1>
        </div>

        <!-- Thông tin cá nhân -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary py-3 text-white">
                <h6 class="font-weight-bold m-0">Thông Tin Cá Nhân</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if ($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Ảnh Người Dùng"
                                class="img-fluid rounded-circle" style="max-width: 180px; border: 5px solid #f8f9fc;">
                        @else
                            <img src="https://via.placeholder.com/180" alt="Ảnh Mặc Định" class="img-fluid rounded-circle"
                                style="max-width: 180px; border: 5px solid #f8f9fc;">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <p><strong>Họ và Tên:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Số Điện Thoại:</strong> {{ $user->phone }}</p>
                        <p><strong>Email Đã Xác Minh:</strong>
                            {{ $user->email_verified_at ? 'Đã xác minh' : 'Chưa xác minh' }}</p>
                        <p><strong>Địa Chỉ:</strong> {{ $user->address }}</p>
                        <p><strong>Tỉnh/Thành Phố:</strong> {{ $user->province }}</p>
                        <p><strong>Vai Trò:</strong> {{ ucfirst($user->role) }}</p>
                        <p><strong>Trạng Thái:</strong> {{ $user->status ? 'Kích hoạt' : 'Khóa' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thông tin tài khoản -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-info py-3 text-white">
                <h6 class="font-weight-bold m-0">Thông Tin Tài Khoản</h6>
            </div>
            <div class="card-body">
                <p><strong>ID Người Dùng:</strong> {{ $user->id }}</p>
                <p><strong>Nhà Cung Cấp:</strong> {{ $user->provider ? ucfirst($user->provider) : 'Không có' }}</p>
                <p><strong>Mã Nhà Cung Cấp:</strong> {{ $user->provider_id ?? 'Không có' }}</p>
                <p><strong>Ngày Tạo Tài Khoản:</strong> {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') }}
                </p>
                <p><strong>Ngày Cập Nhật Tài Khoản:</strong>
                    {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Thông tin về trạng thái đăng nhập -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-secondary py-3 text-white">
                <h6 class="font-weight-bold m-0">Trạng Thái Đăng Nhập</h6>
            </div>
            <div class="card-body">
                <p><strong>Token Nhớ Phiên:</strong> {{ $user->remember_token }}</p>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .card-header {
            background-color: #f8f9fc;
            color: #333;
        }

        .card-body {
            font-size: 16px;
        }

        .sidebar {
            background-color: #0924ec !important;
            background-image: linear-gradient(113deg, #314aff 10%, #60616f 100%) !important;
            background-size: cover !important;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
@endpush
