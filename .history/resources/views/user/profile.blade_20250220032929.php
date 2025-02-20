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
                            <div class="card-header-actions">
                                <button class="btn-icon edit-btn" id="edit-info-btn" title="Chỉnh sửa thông tin">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon refresh-btn" title="Làm mới">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Thông tin cá nhân -->
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

                                <div class="info-item">
                                    <i class="fas fa-city info-icon"></i>
                                    <div class="info-content">
                                        <span class="info-label">Tỉnh/Thành phố</span>
                                        <p class="info-value">{{ $user->province ?: 'Chưa cập nhật' }}</p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <i class="fas fa-calendar-alt info-icon"></i>
                                    <div class="info-content">
                                        <span class="info-label">Ngày đăng ký</span>
                                        <p class="info-value">
                                            {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End User Profile Section -->
    <div class="modal fade" id="editProfileModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa thông tin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Ảnh đại diện</label>
                            <input type="file" class="form-control" name="photo">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" name="phone" value="{{ $user->phone }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{ $user->address }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tỉnh/Thành phố</label>
                            <input type="text" class="form-control" name="province" value="{{ $user->province }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    /* ======= Cải thiện giao diện User Profile ======= */

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

    .status-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-active {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }

    .status-inactive {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
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

    .info-label {
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 3px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 600;
        color: #344767;
        margin: 0;
    }

    .btn-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
    }

    .edit-btn {
        background-color: #4e73df;
        color: white;
    }

    .refresh-btn {
        background-color: #f8f9fa;
        color: #4e73df;
    }

    .edit-btn:hover,
    .refresh-btn:hover {
        opacity: 0.8;
    }
</style>
