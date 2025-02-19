@extends('layouts.master')

@section('main-content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thông Tin Cá Nhân</h1>
            <a href="#" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50 mr-1"></i> Chỉnh Sửa Thông Tin
            </a>
        </div>

        <div class="row">
            <!-- Thông tin và ảnh người dùng -->
            <div class="col-xl-4 col-lg-5">
                <div class="card mb-4 shadow">
                    <div class="card-body pb-4 pt-5 text-center">
                        @if ($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Ảnh Người Dùng"
                                class="img-profile rounded-circle mb-3 shadow"
                                style="width: 180px; height: 180px; object-fit: cover; border: 5px solid #f8f9fc;">
                        @else
                            <img src="https://via.placeholder.com/180" alt="Ảnh Mặc Định"
                                class="img-profile rounded-circle mb-3 shadow"
                                style="width: 180px; height: 180px; object-fit: cover; border: 5px solid #f8f9fc;">
                        @endif
                        <h4 class="font-weight-bold mb-0">{{ $user->name }}</h4>
                        <p class="text-muted">{{ ucfirst($user->role) }}</p>

                        <div class="mt-3">
                            <span class="badge badge-{{ $user->status ? 'success' : 'danger' }} px-3 py-2">
                                {{ $user->status ? 'Đang Hoạt Động' : 'Tài Khoản Bị Khóa' }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button class="btn btn-sm btn-light mr-2"><i class="fas fa-camera"></i> Thay Ảnh</button>
                            <button class="btn btn-sm btn-light"><i class="fas fa-key"></i> Đổi Mật Khẩu</button>
                        </div>
                    </div>
                </div>

                <!-- Thông tin về trạng thái đăng nhập -->
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient-secondary py-3 text-white">
                        <h6 class="font-weight-bold m-0"><i class="fas fa-shield-alt mr-2"></i>Bảo Mật Tài Khoản</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="d-block text-muted mb-1">Tình Trạng Email</span>
                            @if ($user->email_verified_at)
                                <span class="text-success"><i class="fas fa-check-circle mr-1"></i> Đã xác thực</span>
                            @else
                                <span class="text-danger"><i class="fas fa-times-circle mr-1"></i> Chưa xác thực</span>
                                <a href="#" class="d-block small text-primary mt-1">Gửi lại email xác thực</a>
                            @endif
                        </div>

                        <div class="mb-3">
                            <span class="d-block text-muted mb-1">Đăng Nhập Lần Cuối</span>
                            <span><i class="far fa-clock mr-1"></i> 2 giờ trước</span>
                        </div>

                        <div>
                            <span class="d-block text-muted mb-1">Xác Thực Hai Yếu Tố</span>
                            <span class="text-danger"><i class="fas fa-toggle-off mr-1"></i> Chưa kích hoạt</span>
                            <a href="#" class="d-block small text-primary mt-1">Kích hoạt ngay</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin chi tiết -->
            <div class="col-xl-8 col-lg-7">
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient-primary d-flex align-items-center py-3">
                        <h6 class="font-weight-bold m-0 text-white"><i class="fas fa-user mr-2"></i>Thông Tin Liên Hệ</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">Email</div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-envelope text-primary mr-2"></i>
                                    {{ $user->email }}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">Số Điện Thoại</div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone text-primary mr-2"></i>
                                    {{ $user->phone ?: 'Chưa cập nhật' }}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">Địa Chỉ</div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                    {{ $user->address ?: 'Chưa cập nhật' }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-muted">Tỉnh/Thành Phố</div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-city text-primary mr-2"></i>
                                    {{ $user->province ?: 'Chưa cập nhật' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient-info d-flex align-items-center py-3">
                        <h6 class="font-weight-bold m-0 text-white"><i class="fas fa-history mr-2"></i>Thông Tin Tài Khoản
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">ID Người Dùng</div>
                            <div class="col-md-8 d-flex align-items-center">
                                <span class="badge badge-light mr-2">#{{ $user->id }}</span>
                                <span class="small text-muted">Mã định danh duy nhất của bạn</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">Đăng Nhập Qua</div>
                            <div class="col-md-8">
                                @if ($user->provider)
                                    <div class="d-flex align-items-center">
                                        <i class="fab fa-{{ strtolower($user->provider) }} text-primary mr-2"></i>
                                        {{ ucfirst($user->provider) }} (ID: {{ $user->provider_id }})
                                    </div>
                                @else
                                    <span>Đăng ký trực tiếp qua website</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">Ngày Đăng Ký</div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <i class="far fa-calendar-alt text-primary mr-2"></i>
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-muted">Cập Nhật Gần Nhất</div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-sync text-primary mr-2"></i>
                                    {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hoạt động gần đây -->
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient-success d-flex align-items-center py-3">
                        <h6 class="font-weight-bold m-0 text-white"><i class="fas fa-chart-line mr-2"></i>Hoạt Động Gần
                            Đây</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item py-3">
                                <div class="d-flex align-items-center">
                                    <div class="activity-icon bg-light-primary rounded-circle mr-3 p-3">
                                        <i class="fas fa-sign-in-alt text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Đăng nhập thành công</h6>
                                        <p class="text-muted small mb-0">2 giờ trước từ trình duyệt Chrome</p>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item py-3">
                                <div class="d-flex align-items-center">
                                    <div class="activity-icon bg-light-success rounded-circle mr-3 p-3">
                                        <i class="fas fa-user-edit text-success"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Cập nhật thông tin cá nhân</h6>
                                        <p class="text-muted small mb-0">2 ngày trước</p>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item py-3">
                                <div class="d-flex align-items-center">
                                    <div class="activity-icon bg-light-warning rounded-circle mr-3 p-3">
                                        <i class="fas fa-calendar-check text-warning"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Đặt lịch khám thành công</h6>
                                        <p class="text-muted small mb-0">1 tuần trước</p>
                                    </div>
                                </div>
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
        /* Custom styles */
        .img-profile {
            transition: all 0.3s;
        }

        .img-profile:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .bg-gradient-primary {
            background: #4e73df;
            background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
        }

        .bg-gradient-info {
            background: #36b9cc;
            background: linear-gradient(90deg, #36b9cc 0%, #1a8a98 100%);
        }

        .bg-gradient-success {
            background: #1cc88a;
            background: linear-gradient(90deg, #1cc88a 0%, #13855c 100%);
        }

        .bg-gradient-secondary {
            background: #858796;
            background: linear-gradient(90deg, #858796 0%, #60616f 100%);
        }

        .bg-light-primary {
            background-color: rgba(78, 115, 223, 0.1);
        }

        .bg-light-success {
            background-color: rgba(28, 200, 138, 0.1);
        }

        .bg-light-warning {
            background-color: rgba(246, 194, 62, 0.1);
        }

        .activity-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar {
            background-color: #0924ec !important;
            background-image: linear-gradient(113deg, #314aff 10%, #60616f 100%) !important;
            background-size: cover !important;
        }

        .card {
            border-radius: 0.5rem;
            border: none;
            transition: all 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .card-header {
            border-radius: calc(0.5rem - 1px) calc(0.5rem - 1px) 0 0;
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
