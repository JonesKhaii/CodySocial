@extends('layouts.master')

@section('title', 'Trang Tổng Quan Bác Sĩ')

@section('main-content')

    <style>
        /* Bố cục chung */
        .wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            /* Màu nền tối */
            color: #fff;
            padding-top: 20px;
            height: 100%;
            position: relative;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            /* Thêm bóng đổ */
            transition: all 0.3s ease;
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .logo a {
            font-size: 1.5em;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            letter-spacing: 1px;
        }

        .sidebar .logo a:hover {
            color: #007bff;
        }

        .sidebar .sidebar-wrapper {
            padding: 0;
        }

        .sidebar .nav {
            padding-left: 0;
            list-style-type: none;
        }

        .sidebar .nav-item {
            padding: 10px 20px;
            position: relative;
            transition: background-color 0.3s ease;
        }

        .sidebar .nav-item:hover {
            background-color: #495057;
            /* Màu nền hover */
        }

        .sidebar .nav-item.active .nav-link {
            background-color: #007bff;
            /* Màu nền khi active */
            font-weight: bold;
            border-radius: 5px;
        }

        .sidebar .nav-link {
            color: #fff;
            display: flex;
            align-items: center;
            text-decoration: none;
            padding: 10px;
            transition: color 0.3s ease;
        }

        .sidebar .nav-link:hover {
            color: #007bff;
            /* Màu chữ khi hover */
        }

        .sidebar .material-icons {
            margin-right: 10px;
            font-size: 1.2em;
        }

        .sidebar .nav-item.active .material-icons {
            color: #fff;
            /* Màu icon khi active */
        }

        .sidebar .nav-item .nav-link {
            font-size: 1em;
        }

        /* Main Content */
        .main-panel {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            overflow-y: auto;
        }

        .tab-content {
            margin-top: 20px;
        }

        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f1f1f1;
            font-weight: bold;
            font-size: 1.2em;
            padding: 15px;
        }

        .card-body {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
        }

        /* Thêm hiệu ứng chuyển động cho Sidebar */
        .sidebar:hover {
            width: 280px;
            /* Khi hover vào sidebar sẽ mở rộng */
        }

        .sidebar .nav-item .nav-link i {
            font-size: 1.2em;
        }

        /* Sidebar Toggler */
        .text-center button {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #343a40;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .text-center button:hover {
            background-color: #007bff;
        }
    </style>


    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">

            <div class="sidebar-wrapper">
                <ul class="nav">
                    <!-- Thông tin cá nhân bác sĩ -->
                    <li class="nav-item active">
                        <a class="nav-link" href="#info-personal" data-toggle="tab">
                            <i class="material-icons">person</i>
                            <p>Thông tin cá nhân bác sĩ</p>
                        </a>
                    </li>
                    <!-- Bài viết -->
                    <li class="nav-item">
                        <a class="nav-link" href="#posts" data-toggle="tab">
                            <i class="material-icons">library_books</i>
                            <p>Bài viết</p>
                        </a>
                    </li>
                    <!-- Sản phẩm tiếp thị -->
                    <li class="nav-item">
                        <a class="nav-link" href="#marketing-products" data-toggle="tab">
                            <i class="material-icons">store</i>
                            <p>Sản phẩm tiếp thị</p>
                        </a>
                    </li>
                    <!-- Thu nhập -->
                    <li class="nav-item">
                        <a class="nav-link" href="#income" data-toggle="tab">
                            <i class="material-icons">attach_money</i>
                            <p>Thu nhập</p>
                        </a>
                    </li>
                    <!-- Thống kê báo cáo -->
                    <li class="nav-item">
                        <a class="nav-link" href="#statistics" data-toggle="tab">
                            <i class="material-icons">assessment</i>
                            <p>Thống kê báo cáo</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-panel">
            <!-- Tab Content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="tab-content">

                        <!-- Thông tin cá nhân bác sĩ -->
                        <div class="tab-pane active" id="info-personal">
                            <div class="card">
                                <div class="card-header">Thông tin cá nhân bác sĩ</div>
                                <div class="card-body">
                                    <p><strong>Tên bác sĩ:</strong> {{ $doctor->name }}</p>
                                    <p><strong>Chuyên Khoa:</strong> {{ $doctor->specialization }}</p>
                                    <p><strong>Số điện thoại:</strong> {{ $doctor->phone }}</p>
                                    <p><strong>Email:</strong> {{ $doctor->email }}</p>
                                    <p><strong>Địa chỉ làm việc:</strong> {{ $doctor->workplace }}</p>
                                    <p><strong>Đánh giá:</strong> {{ $doctor->rating }} ⭐</p>
                                    <p><strong>Điểm tiếp thị:</strong> {{ $doctor->points }}</p>
                                    <p><strong>Số người theo dõi:</strong> {{ $doctor->followers_count }}</p>
                                    <p><strong>Ảnh đại diện: <img src="{{ $doctor->photo }}" alt="Ảnh Bác Sĩ"
                                                class="img-thumbnail"
                                                style="width: 150px;"></strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- Bài viết -->
                        <div class="tab-pane" id="posts">
                            <div class="card">
                                <div class="card-header">Bài viết của bác sĩ</div>
                                <div class="card-body">
                                    @if ($posts->isEmpty())
                                        <p>Chưa có bài viết nào.</p>
                                    @else
                                        <ul>
                                            @foreach ($posts as $post)
                                                <li><strong>{{ $post->title }}</strong></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <a href="" class="btn btn-primary">+ Tạo bài viết
                                        mới</a>
                                </div>
                            </div>
                        </div>

                        <!-- Sản phẩm tiếp thị -->
                        <div class="tab-pane" id="marketing-products">
                            <div class="card">
                                <div class="card-header">Sản phẩm tiếp thị</div>
                            </div>
                        </div>

                        <!-- Thu nhập -->
                        <div class="tab-pane" id="income">
                            <div class="card">
                                <div class="card-header">Thu nhập của bác sĩ</div>
                            </div>
                        </div>

                        <!-- Thống kê báo cáo -->
                        <div class="tab-pane" id="statistics">
                            <div class="card">
                                <div class="card-header">Thống kê báo cáo</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
