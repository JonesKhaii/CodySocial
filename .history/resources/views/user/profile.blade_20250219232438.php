<div class="tab-pane active" id="info-personal">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Thông tin cá nhân</h2>
            <div class="card-header-actions">
                <button class="btn-icon" id="edit-info-btn" title="Chỉnh sửa thông tin">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-icon" title="Làm mới">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="user-info-card">
                <div class="profile-photo-container">
                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://via.placeholder.com/150' }}"
                        alt="User" class="profile-photo">
                    <div class="profile-details">
                        <h3 class="profile-name-large">{{ $user->name }}</h3>
                        <p class="profile-role">{{ ucfirst($user->role) }}</p>
                        <span class="status-badge {{ $user->status ? 'status-active' : 'status-inactive' }}">
                            {{ $user->status ? 'Đang hoạt động' : 'Tài khoản bị khóa' }}
                        </span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Email</div>
                        <p class="info-value">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Số điện thoại</div>
                        <p class="info-value">{{ $user->phone ?: 'Chưa cập nhật' }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Địa chỉ</div>
                        <p class="info-value">{{ $user->address ?: 'Chưa cập nhật' }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-city"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Tỉnh/Thành phố</div>
                        <p class="info-value">{{ $user->province ?: 'Chưa cập nhật' }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Ngày đăng ký</div>
                        <p class="info-value">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        border: none;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: #fff;
        border-bottom: 1px solid #edf2f9;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        color: #344767;
    }

    .card-header-actions {
        display: flex;
        gap: 8px;
    }

    .btn-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background-color: #f8f9fa;
        color: #4e73df;
        transition: all 0.2s ease;
    }

    .btn-icon:hover {
        background-color: #4e73df;
        color: #fff;
    }

    .card-body {
        padding: 20px;
    }

    .user-info-card {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .profile-photo-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .profile-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #f8f9fc;
        margin-right: 20px;
    }

    .profile-details {
        flex: 1;
    }

    .profile-name-large {
        font-size: 22px;
        font-weight: 700;
        margin: 0 0 5px 0;
        color: #344767;
    }

    .profile-role {
        font-size: 14px;
        color: #64748b;
        margin: 0 0 10px 0;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-active {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }

    .status-inactive {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        padding: 12px 0;
        border-bottom: 1px solid #edf2f9;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background-color: rgba(78, 115, 223, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4e73df;
        margin-right: 15px;
    }

    .info-content {
        flex: 1;
    }

    .info-label {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 3px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 500;
        color: #344767;
        margin: 0;
    }
</style>
