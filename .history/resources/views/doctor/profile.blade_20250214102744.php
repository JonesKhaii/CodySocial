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
            color: #fff;
            padding-top: 20px;
            position: fixed;
            height: 100%;
            left: 0;
        }

        .sidebar .nav {
            padding-left: 0;
            list-style-type: none;
        }

        .sidebar .nav-item {
            padding: 15px;
        }

        .sidebar .nav-link {
            color: #fff;
            display: block;
            text-decoration: none;
            padding: 10px;
        }

        .sidebar .nav-link:hover {
            background-color: #575757;
        }

        .sidebar .nav-item.active .nav-link {
            background-color: #007bff;
        }

        .sidebar .material-icons {
            margin-right: 10px;
        }

        /* Main Content */
        .main-panel {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
            overflow-y: auto;
        }

        .tab-content {
            margin-top: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        /* Adjusting the look for cards inside the tab */
        .nav-tabs .nav-item {
            margin-bottom: 15px;
        }
    </style>

    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <a href="javascript:void(0);" class="simple-text logo-normal">
                    Tubagora
                </a>
            </div>
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
                                    <img src="{{ $doctor->photo }}" alt="Ảnh Bác Sĩ" class="img-thumbnail"
                                        style="width: 150px;">
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
                                    <a href="" class="btn btn-primary">+ Tạo bài viết mới</a>
                                </div>
                            </div>
                        </div>

                        <!-- Sản phẩm tiếp thị -->
                        <div class="tab-pane" id="marketing-products">
                            <div class="card">
                                <div class="card-header">Sản phẩm tiếp thị</div>
                                {{-- <div class="card-body">
                                <ul>
                                    @foreach ($products as $product)
                                        <li>{{ $product->name }} - {{ $product->category }} - {{ $product->price }} USD</li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('doctor.add-product') }}" class="btn btn-primary">+ Thêm sản phẩm tiếp thị</a>
                            </div> --}}
                            </div>
                        </div>

                        <!-- Thu nhập -->
                        <div class="tab-pane" id="income">
                            <div class="card">
                                <div class="card-header">Thu nhập của bác sĩ</div>
                                {{-- <div class="card-body">
                                <p><strong>Tổng thu nhập:</strong> {{ $doctor->income }} USD</p>
                                <p><strong>Thu nhập từ bài viết:</strong> {{ $doctor->earnings_from_posts }} USD</p>
                                <p><strong>Thu nhập từ sản phẩm tiếp thị:</strong> {{ $doctor->earnings_from_products }} USD</p>
                            </div> --}}
                            </div>
                        </div>

                        <!-- Thống kê báo cáo -->
                        <div class="tab-pane" id="statistics">
                            <div class="card">
                                <div class="card-header">Thống kê báo cáo</div>
                                {{-- <div class="card-body">
                                <ul>
                                    <li>Tổng số bài viết: {{ $posts->count() }}</li>
                                    <li>Tổng số sản phẩm tiếp thị: {{ $products->count() }}</li>
                                    <li>Tổng số lượt xem bài viết: {{ $doctor->total_post_views }}</li>
                                    <li>Tổng số lượt mua sản phẩm: {{ $doctor->total_product_sales }}</li>
                                </ul>
                            </div> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
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
            color: #fff;
            padding-top: 20px;
            position: fixed;
            height: 100%;
            left: 0;
        }

        .sidebar .nav {
            padding-left: 0;
            list-style-type: none;
        }

        .sidebar .nav-item {
            padding: 15px;
        }

        .sidebar .nav-link {
            color: #fff;
            display: block;
            text-decoration: none;
            padding: 10px;
        }

        .sidebar .nav-link:hover {
            background-color: #575757;
        }

        .sidebar .nav-item.active .nav-link {
            background-color: #007bff;
        }

        .sidebar .material-icons {
            margin-right: 10px;
        }

        /* Main Content */
        .main-panel {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
            overflow-y: auto;
        }

        .tab-content {
            margin-top: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        /* Adjusting the look for cards inside the tab */
        .nav-tabs .nav-item {
            margin-bottom: 15px;
        }
    </style>

    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <a href="javascript:void(0);" class="simple-text logo-normal">
                    Tubagora
                </a>
            </div>
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
                                    <img src="{{ $doctor->photo }}" alt="Ảnh Bác Sĩ" class="img-thumbnail"
                                        style="width: 150px;">
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
                                    <a href="{{ route('doctor.create-post') }}" class="btn btn-primary">+ Tạo bài viết
                                        mới</a>
                                </div>
                            </div>
                        </div>

                        <!-- Sản phẩm tiếp thị -->
                        <div class="tab-pane" id="marketing-products">
                            <div class="card">
                                <div class="card-header">Sản phẩm tiếp thị</div>
                                <div class="card-body">
                                    <ul>
                                        @foreach ($products as $product)
                                            <li>{{ $product->name }} - {{ $product->category }} - {{ $product->price }}
                                                USD</li>
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('doctor.add-product') }}" class="btn btn-primary">+ Thêm sản phẩm
                                        tiếp thị</a>
                                </div>
                            </div>
                        </div>

                        <!-- Thu nhập -->
                        <div class="tab-pane" id="income">
                            <div class="card">
                                <div class="card-header">Thu nhập của bác sĩ</div>
                                <div class="card-body">
                                    <p><strong>Tổng thu nhập:</strong> {{ $doctor->income }} USD</p>
                                    <p><strong>Thu nhập từ bài viết:</strong> {{ $doctor->earnings_from_posts }} USD</p>
                                    <p><strong>Thu nhập từ sản phẩm tiếp thị:</strong>
                                        {{ $doctor->earnings_from_products }} USD</p>
                                </div>
                            </div>
                        </div>

                        <!-- Thống kê báo cáo -->
                        <div class="tab-pane" id="statistics">
                            <div class="card">
                                <div class="card-header">Thống kê báo cáo</div>
                                <div class="card-body">
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
        </div>
    </div>

@endsection
