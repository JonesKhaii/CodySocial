@extends('layouts.master')

@section('title', 'Trang Tổng Quan Bác Sĩ')

@section('main-content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        /* Reset và biến CSS */
        :root {
            --primary-color: #2377b3;
            --primary-light: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary-color: #64748b;
            --bg-light: #f8fafc;
            --text-dark: #1e293b;
            --text-light: #f8fafc;
            --border-radius: 12px;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s ease;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f1f5f9;
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }

        /* Bố cục chung */
        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--primary-color);
            color: var(--text-light);
            margin-top: 5px;
            margin-bottom: 5px;
            border-radius: 0 5px 5px 0;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            z-index: 10;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .sidebar-header {
            padding: 25px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            font-size: 24px;
            color: white;
        }

        .logo-text {
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: white;
        }

        .sidebar .sidebar-wrapper {
            padding: 25px 0;
        }

        .sidebar .nav {
            padding-left: 0;
            list-style-type: none;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .sidebar .nav-item {
            margin: 5px 15px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .sidebar .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-item.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .sidebar .nav-link {
            color: var(--text-light);
            display: flex;
            align-items: center;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .sidebar .nav-link i {
            margin-right: 12px;
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .sidebar .nav-link p {
            margin: 0;
            font-weight: 400;
            font-size: 15px;
        }

        .sidebar .nav-item.active .nav-link {
            font-weight: 500;
        }

        /* Doctor profile section */
        .doctor-profile {
            padding: 25px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }

        .profile-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .profile-info {
            margin-top: 15px;
        }

        .profile-name {
            font-weight: 500;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .profile-role {
            font-size: 13px;
            opacity: 0.8;
            margin: 0;
        }

        /* Main Content */
        .main-panel {
            flex: 1;
            padding: 30px;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .breadcrumb {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 14px;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item:not(:last-child)::after {
            content: '\f105';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin: 0 10px;
            color: var(--secondary-color);
        }

        .breadcrumb-link {
            color: var(--secondary-color);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 500;
        }

        /* Cards */
        .card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 25px;
            overflow: hidden;
            border: none;
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-dark);
            margin: 0;
        }

        .card-header-actions {
            display: flex;
            gap: 10px;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bg-light);
            color: var(--secondary-color);
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-icon:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .card-body {
            padding: 25px;
        }

        /* Doctor Info Card */
        .doctor-info-card {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background-color: var(--bg-light);
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .info-item:hover {
            background-color: rgba(59, 130, 246, 0.1);
        }

        .info-icon {
            width: 45px;
            height: 45px;
            background-color: var(--primary-light);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 13px;
            color: var(--secondary-color);
            margin-bottom: 5px;
        }

        .info-value {
            font-weight: 500;
            font-size: 16px;
            color: var(--text-dark);
            margin: 0;
        }

        .profile-photo-container {
            grid-column: span 2;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--bg-light);
            box-shadow: var(--card-shadow);
        }

        .profile-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .profile-name-large {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        .profile-specialty {
            font-size: 16px;
            color: var(--secondary-color);
            margin: 0;
        }

        .rating-stars {
            color: #fbbf24;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .rating-value {
            margin-left: 5px;
            font-weight: 500;
        }

        /* Posts Tab */
        .post-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .post-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .post-image {
            height: 180px;
            width: 100%;
            object-fit: cover;
        }

        .post-content {
            padding: 20px;
        }

        .post-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-dark);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 50px;
        }

        .post-excerpt {
            font-size: 14px;
            color: var(--secondary-color);
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 60px;
        }

        .post-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: var(--secondary-color);
        }

        .post-date {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .post-views {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 12px 25px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .create-post-container {
            margin-top: 30px;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }

            .sidebar .nav-link p,
            .sidebar .logo-text,
            .sidebar .doctor-profile {
                display: none;
            }

            .sidebar .nav-link {
                justify-content: center;
            }

            .sidebar .nav-link i {
                margin-right: 0;
            }

            .profile-photo-container {
                grid-column: span 1;
            }
        }

        @media (max-width: 768px) {
            .main-panel {
                padding: 20px;
            }

            .doctor-info-card {
                grid-template-columns: 1fr;
            }

            .profile-photo-container {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                {{-- <div class="logo">
                    <i class="fas fa-stethoscope logo-icon"></i>
                    <span class="logo-text">MedPortal</span>
                </div> --}}
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#info-personal" data-toggle="tab">
                            <i class="fas fa-user-md"></i>
                            <p>Thông tin cá nhân</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#posts" data-toggle="tab">
                            <i class="fas fa-newspaper"></i>
                            <p>Bài viết</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#marketing-products" data-toggle="tab">
                            <i class="fas fa-shopping-cart"></i>
                            <p>Sản phẩm tiếp thị</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#income" data-toggle="tab">
                            <i class="fas fa-chart-line"></i>
                            <p>Thu nhập</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#statistics" data-toggle="tab">
                            <i class="fas fa-chart-pie"></i>
                            <p>Thống kê báo cáo</p>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="doctor-profile">
                <img src="{{ $doctor->photo }}" alt="Doctor" class="profile-img">
                <div class="profile-info">
                    <h4 class="profile-name">{{ $doctor->name }}</h4>
                    <p class="profile-role">{{ $doctor->specialization }}</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-panel">
            <div class="page-header">
                <h1 class="page-title">Tổng Quan</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#" class="breadcrumb-link">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active">Tổng Quan</li>
                </ul>
            </div>

            <div class="content">
                <div class="tab-content">
                    <!-- Thông tin cá nhân bác sĩ -->
                    <div class="tab-pane active" id="info-personal">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Thông tin cá nhân</h2>
                                <div class="card-header-actions">
                                    <button class="btn-icon" title="Chỉnh sửa thông tin">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-icon" title="Làm mới">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="doctor-info-card">
                                    <div class="profile-photo-container">
                                        <img src="{{ $doctor->photo }}" alt="Doctor" class="profile-photo">
                                        <div class="profile-details">
                                            <h3 class="profile-name-large">{{ $doctor->name }}</h3>
                                            <p class="profile-specialty">{{ $doctor->specialization }}</p>
                                            <div class="rating-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $doctor->rating)
                                                        <i class="fas fa-star"></i>
                                                    @elseif ($i - 0.5 <= $doctor->rating)
                                                        <i class="fas fa-star-half-alt"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                                <span class="rating-value">{{ $doctor->rating }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-label">Số điện thoại</div>
                                            <p class="info-value">{{ $doctor->phone }}</p>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-label">Email</div>
                                            <p class="info-value">{{ $doctor->email }}</p>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-label">Địa chỉ làm việc</div>
                                            <p class="info-value">{{ $doctor->workplace }}</p>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-label">Người theo dõi</div>
                                            <p class="info-value">{{ number_format($doctor->followers_count) }}</p>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="fas fa-award"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-label">Điểm tiếp thị</div>
                                            <p class="info-value">{{ number_format($doctor->points) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bài viết -->
                    <div class="tab-pane" id="posts">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Bài viết của bạn</h2>
                                <div class="card-header-actions">
                                    <button class="btn-icon" title="Lọc bài viết">
                                        <i class="fas fa-filter"></i>
                                    </button>
                                    <button class="btn-icon" title="Sắp xếp">
                                        <i class="fas fa-sort"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($posts->isEmpty())
                                    <div class="py-5 text-center">
                                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                        <h3 class="text-muted">Chưa có bài viết nào</h3>
                                        <p class="text-secondary mb-4">Hãy bắt đầu chia sẻ kiến thức của bạn với cộng đồng
                                        </p>
                                    </div>
                                @else
                                    <div class="post-list">
                                        @foreach ($posts as $post)
                                            <div class="post-card">
                                                <img src="https://via.placeholder.com/300x180" alt="Thumbnail"
                                                    class="post-image">
                                                <div class="post-content">
                                                    <h3 class="post-title">{{ $post->title }}</h3>
                                                    <p class="post-excerpt">Lorem ipsum dolor sit amet, consectetur
                                                        adipiscing elit. Sed do eiusmod tempor incididunt ut labore et
                                                        dolore magna aliqua.</p>
                                                    <div class="post-meta">
                                                        <div class="post-date">
                                                            <i class="far fa-calendar-alt"></i>
                                                            <span>15/02/2025</span>
                                                        </div>
                                                        <div class="post-views">
                                                            <i class="far fa-eye"></i>
                                                            <span>254</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="create-post-container">
                                    <a href="" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                        Tạo bài viết mới
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sản phẩm tiếp thị -->
                    <div class="tab-pane" id="marketing-products">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Sản phẩm tiếp thị</h2>
                                <div class="card-header-actions">
                                    <button class="btn-icon" title="Thêm sản phẩm">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="py-5 text-center">
                                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                    <h3 class="text-muted">Chưa có sản phẩm tiếp thị</h3>
                                    <p class="text-secondary mb-4">Thêm sản phẩm để bắt đầu kiếm thêm thu nhập</p>
                                    <button class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                        Thêm sản phẩm mới
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thu nhập -->
                    <div class="tab-pane" id="income">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Thu nhập của bạn</h2>
                                <div class="card-header-actions">
                                    <button class="btn-icon" title="Xuất báo cáo">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="py-5 text-center">
                                    <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                                    <h3 class="text-muted">Chưa có dữ liệu thu nhập</h3>
                                    <p class="text-secondary">Dữ liệu thu nhập sẽ hiển thị khi bạn bắt đầu có doanh thu từ
                                        nền tảng</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thống kê báo cáo -->
                    <div class="tab-pane" id="statistics">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Thống kê báo cáo</h2>
                                <div class="card-header-actions">
                                    <button class="btn-icon" title="Tùy chỉnh báo cáo">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="py-5 text-center">
                                    <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                                    <h3 class="text-muted">Chưa có dữ liệu thống kê</h3>
                                    <p class="text-secondary">Các báo cáo thống kê sẽ hiển thị khi có đủ dữ liệu từ hoạt
                                        động của bạn</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.nav-item');
            const tabPanes = document.querySelectorAll('.tab-pane');

            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.querySelector('.nav-link').getAttribute('href').substring(
                        1);

                    // Remove active class
                    navItems.forEach(nav => nav.classList.remove('active'));
                    tabPanes.forEach(tab => tab.classList.remove('active'));

                    // Add active class
                    this.classList.add('active');
                    document.getElementById(target).classList.add('active');
                });
            });
        });
    </script>
@endsection
