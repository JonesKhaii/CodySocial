@extends('layouts.master')

@section('title', 'Trang Tổng Quan Bác Sĩ')

@section('main-content')

    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
            <!-- Logo -->
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    Tubagora
                </a>
            </div>
            <!-- Sidebar Menu -->
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <!-- Thông tin cá nhân bác sĩ -->
                    <li class="nav-item">
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
                            <h3>Thông tin cá nhân bác sĩ</h3>
                            <p><strong>Tên bác sĩ:</strong> {{ $doctor->name }}</p>
                            <p><strong>Chuyên Khoa:</strong> {{ $doctor->specialization }}</p>
                            <p><strong>Số điện thoại:</strong> {{ $doctor->phone }}</p>
                            <p><strong>Email:</strong> {{ $doctor->email }}</p>
                            <p><strong>Địa chỉ làm việc:</strong> {{ $doctor->workplace }}</p>
                            <p><strong>Đánh giá:</strong> {{ $doctor->rating }} ⭐</p>
                            <p><strong>Điểm tiếp thị:</strong> {{ $doctor->points }}</p>
                            <p><strong>Số người theo dõi:</strong> {{ $doctor->followers_count }}</p>
                            <img src="{{ $doctor->photo }}" alt="Ảnh Bác Sĩ" class="img-thumbnail" style="width: 150px;">
                        </div>

                        <!-- Bài viết -->
                        <div class="tab-pane" id="posts">
                            <h3>Bài viết của bác sĩ</h3>
                            @if ($posts->isEmpty())
                                <p>Chưa có bài viết nào.</p>
                            @else
                                <ul>
                                    @foreach ($posts as $post)
                                        <li><strong>{{ $post->title }}</strong></li>
                                    @endforeach
                                </ul>
                            @endif
                            <a href="{{ route('doctor.create-post') }}" class="btn btn-primary">+ Tạo bài viết mới</a>
                        </div>

                        <!-- Sản phẩm tiếp thị -->
                        <div class="tab-pane" id="marketing-products">
                            <h3>Sản phẩm tiếp thị</h3>
                            <ul>
                                @foreach ($products as $product)
                                    <li>{{ $product->name }} - {{ $product->category }} - {{ $product->price }} USD</li>
                                @endforeach
                            </ul>
                            <a href="{{ route('doctor.add-product') }}" class="btn btn-primary">+ Thêm sản phẩm tiếp
                                thị</a>
                        </div>

                        <!-- Thu nhập -->
                        <div class="tab-pane" id="income">
                            <h3>Thu nhập của bác sĩ</h3>
                            <p><strong>Tổng thu nhập:</strong> {{ $doctor->income }} USD</p>
                            <p><strong>Thu nhập từ bài viết:</strong> {{ $doctor->earnings_from_posts }} USD</p>
                            <p><strong>Thu nhập từ sản phẩm tiếp thị:</strong> {{ $doctor->earnings_from_products }} USD
                            </p>
                        </div>

                        <!-- Thống kê báo cáo -->
                        <div class="tab-pane" id="statistics">
                            <h3>Thống kê báo cáo</h3>
                            <ul>
                                <li>Tổng số bài viết: {{ $posts->count() }}</li>
                                <li>Tổng số sản phẩm tiếp thị: {{ $products->count() }}</li>
                                <li>Tổng số lượt xem bài viết: {{ $doctor->total_post_views }}</li>
                                <li>Tổng số lượt mua sản phẩm: {{ $doctor->total_product_sales }}</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
