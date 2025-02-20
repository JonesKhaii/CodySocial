@extends('layouts.master')

@section('title', 'Hồ Sơ Của Tôi')

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list d-flex align-items-center m-0 p-0" style="list-style: none;">
                            <li><a href="{{ route('home') }}" class="text-decoration-none">Trang chủ <i
                                        class="ti-arrow-right mx-2"></i></a></li>
                            <li class="active"><a href="javascript:void(0);" class="text-decoration-none text-muted">Hồ sơ
                                    cá nhân</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- User Profile Section -->
    <section class="user-profile section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Sidebar -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body text-center">
                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://via.placeholder.com/150' }}"
                                alt="User Avatar" class="profile-photo rounded-circle">
                            <h3 class="profile-name mt-3">{{ $user->name }}</h3>
                            <p class="profile-role">{{ ucfirst($user->role) }}</p>
                            <span class="status-badge {{ $user->status ? 'status-active' : 'status-inactive' }}">
                                {{ $user->status ? 'Đang hoạt động' : 'Tài khoản bị khóa' }}
                            </span>
                        </div>
                    </div>

                    <!-- Menu -->
                    <div class="card shadow-sm">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action active">
                                <i class="fas fa-user-circle me-2"></i> Thông tin cá nhân
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-key me-2"></i> Đổi mật khẩu
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="card-title">Thông tin cá nhân</h2>
                            <button class="btn btn-primary btn-sm" id="edit-info-btn">
                                <i class="fas fa-edit me-1"></i> Chỉnh sửa
                            </button>
                        </div>

                        <div class="card-body">
                            <!-- Hiển thị thông tin -->
                            <div id="user-info">
                                <div class="user-info-grid">
                                    <div class="info-item">
                                        <i class="fas fa-envelope info-icon"></i>
                                        <div class="info-content">
                                            <span class="info-label">Email</span>
                                            <p class="info-value">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-phone info-icon"></i>
                                        <div class="info-content">
                                            <span class="info-label">Số điện thoại</span>
                                            <p class="info-value">{{ $user->phone ?: 'Chưa cập nhật' }}</p>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-map-marker-alt info-icon"></i>
                                        <div class="info-content">
                                            <span class="info-label">Địa chỉ</span>
                                            <p class="info-value">{{ $user->address ?: 'Chưa cập nhật' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form chỉnh sửa (Ẩn mặc định) -->
                            <form id="edit-info-form" style="display: none;">
                                @csrf
                                <div class="user-info-grid">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $user->email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ $user->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $user->address }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">Lưu thay đổi</button>
                                <button type="button" class="btn btn-secondary mt-3" id="cancel-edit">Hủy</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    .profile-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #f8f9fc;
    }

    .profile-name {
        font-size: 22px;
        font-weight: 700;
        color: #344767;
    }

    .profile-role {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 5px;
    }

    .user-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 15px;
        padding: 20px;
    }

    .info-item {
        display: flex;
        align-items: center;
        padding: 12px;
        background: #f9fafb;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .info-item:hover {
        background: #eef1f5;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e3e6f0;
        color: #4e73df;
        font-size: 18px;
        margin-right: 12px;
    }
</style>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#edit-info-btn').on('click', function() {
                $('#user-info').hide();
                $('#edit-info-form').show();
            });

            $('#cancel-edit').on('click', function() {
                $('#edit-info-form').hide();
                $('#user-info').show();
            });

            $('#edit-info-form').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: '',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Thông tin đã được cập nhật!');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra! Vui lòng thử lại.');
                    }
                });
            });
        });
    </script>
@endpush
